<?php

namespace App\Http\Controllers\Gateway;

use App\GeneralSetting;
use App\Trx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GatewayCurrency;
use App\Deposit;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Gateway;
use App\Rules\FileTypeValidate;

class PaymentController extends Controller
{
    public function deposit()
    {

        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->get();
        $page_title = 'Deposit Methods';
        return view(activeTemplate() . 'payment.deposit', compact('gatewayCurrency', 'page_title'));
    }

    public function depositInsert(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required|numeric|min:1',
            'method_code' => 'required',
            'currency' => 'required',
        ]);
        $gate = GatewayCurrency::where('method_code', $request->method_code)->where('currency', $request->currency)->first();
        if (!$gate) {
            $notify[] = ['error', 'Invalid Gateway'];
            return back()->withNotify($notify);
        }
        if ($gate->min_amount > $request->amount || $gate->max_amount < $request->amount) {
            $notify[] = ['error', 'Please Follow Deposit Limit'];
            return back()->withNotify($notify);
        }


        $charge = formatter_money($gate->fixed_charge + ($request->amount * $gate->percent_charge / 100));
        $withCharge = $request->amount + $charge;
        $final_amo = formatter_money($withCharge * $gate->rate);

        $depo['user_id'] = Auth::id();
        $depo['method_code'] = $gate->method_code;
        $depo['method_currency'] = strtoupper($gate->currency);
        $depo['amount'] = formatter_money($request->amount);
        $depo['charge'] = $charge;
        $depo['rate'] = $gate->rate;
        $depo['final_amo'] = $final_amo;
        $depo['btc_amo'] = 0;
        $depo['btc_wallet'] = "";
        $depo['trx'] = getTrx();
        $depo['try'] = 0;
        $depo['status'] = 0;
        Deposit::create($depo);
        Session::put('Track', $depo['trx']);
        return redirect()->route('user.deposit.preview');
    }


    public function depositPreview()
    {
        $track = Session::get('Track');


        $data = Deposit::with('gateway')->where('status', 0)->where('trx', $track)->first();
        if (!$data) {
            return redirect()->route('user.deposit');
        }
        $page_title = "Deposit Preview";
        return view(activeTemplate() . 'payment.preview', compact('data', 'page_title'));
    }


    public function depositConfirm()
    {
        $track = Session::get('Track');
        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        if (is_null($deposit)) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if ($deposit->status != 0) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        if ($deposit->method_code >= 1000) {
            return redirect()->route('user.manualDeposit.confirm');
        }

        $xx = 'g' . $deposit->method_code;
        $new = __NAMESPACE__ . '\\' . $xx . '\\ProcessController';

        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return redirect()->route('user.deposit')->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }
        $page_title = 'Payment Confirm';

        return view(activeTemplate() . $data->view, compact('data', 'deposit', 'page_title'));
    }


    public static function userDataUpdate($data)
    {

        if ($data->status == 0) {
            $data['status'] = 1;
            $data->update();

            $user = User::find($data->user_id);
            $user->balance += $data->amount;
            $user->save();
            $gateway = $data->gateway;
            Trx::create([
                'user_id' => $data->user_id,
                'amount' => $data->amount,
                'main_amo' => $data->amount + $data->charge,
                'charge' => $data->charge,
                'type' => 'deposit',
                'title' => 'Deposit Via ' . $gateway->name,
                'trx' => $data->trx,
                'balance' => $user->balance,
            ]);

            $general = GeneralSetting::first(['cur_sym']);

            $amount = $general->cur_sym . ' ' . formatter_money($data->amount, $gateway->crypto());
            send_email($user, 'DEPOSIT_SUCCESS', [
                'amount' => $amount,
                'method' => $gateway->name,
            ]);
            send_sms($user, 'DEPOSIT_SUCCESS', [
                'amount' => $amount,
                'method' => $gateway->name,
            ]);
            $deposit = $data;
            send_email($user, 'DEPOSIT_APPROVE', [
                'trx' => $deposit->trx,
                'amount' => $general->cur_sym . formatter_money($deposit->amount),
                'receive_amount' => $amount,
                'charge' => $general->cur_sym . formatter_money($deposit->charge),
                'method' => $deposit->gateway->name,
            ]);

            send_sms($user, 'DEPOSIT_APPROVE', [
                'trx' => $deposit->trx,
                'amount' => $general->cur_sym . formatter_money($deposit->amount),
                'receive_amount' => $amount,
                'charge' => $general->cur_sym . formatter_money($deposit->charge),
                'method' => $deposit->gateway->name,
            ]);
        }
    }


    public function manualDepositConfirm(Request $request)
    {
        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $page_title = 'Deposit Confirm';
        return view(activeTemplate() . 'payment.manual_confirm', compact('page_title', 'data'));
    }

    public function manualDepositUpdate(Request $request)
    {


        $track = Session::get('Track');
        $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();

        if ($data->status != 0 || !$data) {
            $notify[] = ['error', 'Invalid Deposit Request'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        if ($request->hasFile('verify_image')) {
            try {
                $filename = upload_image($request->verify_image, config('constants.deposit.verify.path'));
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload your verification image'];
                return back()->withNotify($notify);
            }
        }

        $data->detail = $request->ud;
        $data->verify_image = $filename;
        $data->status = 2;
        $data->save();

        $general = GeneralSetting::first();


        send_email(auth()->user(), 'DEPOSIT_PENDING', [
            'trx' => $data->trx,
            'amount' => $general->cur_sym . ' ' . formatter_money($request->amount),
            'method' => $data->gateway_currency()->name,
            'charge' => $general->cur_sym . ' ' . $data->charge,
        ]);

        send_sms(auth()->user(), 'DEPOSIT_PENDING', [
            'trx' => $data->trx,
            'amount' => $general->cur_sym . ' ' . formatter_money($request->amount),
            'method' => $data->gateway_currency()->name,
            'charge' => $general->cur_sym . ' ' . $data->charge,
        ]);

        $notify[] = ['success', 'You have deposit request has been taken.'];
        return redirect()->route('user.deposit.history')->withNotify($notify);
    }
}
