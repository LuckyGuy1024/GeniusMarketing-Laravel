<?php

namespace App\Http\Controllers;

use App\Epin;
use App\GeneralSetting;
use App\Http\Traits\Matrix;
use App\PaymentProveImage;
use App\Plan;
use App\Trx;
use App\User;
use App\UserLogin;
use App\PurchasePlan;
use App\ROI;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    use Matrix;




    function roi(){
        $page_title = 'All ROI ';
         $page="roi";
        $trans = ROI::where("user_id","=",Auth::user()->id)->latest()->paginate(15);
// return $trans;
        return view(activeTemplate() .'user.roi',compact('page_title', 'trans','page'));
    }

    function roiDate(Request $request){
        // return $request;
        $page_title = 'ROI Of '.$request->current_date;
        // $trans = Epin::latest()->whereStatus(1)->paginate(15);
        $page="roi";
       $trans = ROI::selectRaw(" * ")
       ->where("user_id","=",Auth::user()->id)
   ->where('created_at', 'like',"%$request->current_date%"  )
      ->latest()->paginate(config('constants.table.default'));
        return view(activeTemplate() .'user.roi',compact('page_title', 'trans','page'));
    }





    function planIndex()
    {


        $data['page_title'] = "Plans";

        $data['plans'] = Plan::whereStatus(1)->get();
        $data['purchased_plans'] = PurchasePlan::whereUserId(Auth::user()->id)->get();

$purchasedPlan= $data['purchased_plans'];
// return $purchasedPlan;
        // if (auth()->user()->plan_id != 0) {

        //     $notify[] = ['error', 'Purchase not possible twice.'];
        //     return back()->withNotify($notify);

        // }

        return view(activeTemplate() . '.user.plan', $data)->with([
"purchased_plans"=>$purchasedPlan,
        ]);;
    }

    function planStore(Request $request)
    {


        $this->validate($request, [
            'plan_id' => 'required|integer'
        ]);
        $plan = Plan::find($request->plan_id);
        $gnl = GeneralSetting::first();
        if ($plan) {
            $user = User::find(Auth::id());
            // if ($user->plan_id != 0) {

            //     $notify[] = ['error', 'Purchase not possible twice.'];
            //     return back()->withNotify($notify);
            // }
            if ($user->balance >= $plan->price) {
// saving plan to child table
            $purchasePlan=new PurchasePlan;
            $purchasePlan->plan_id=$plan->id;
            $purchasePlan->user_id=$user->id;
            $purchasePlan->save();
// ends here
                $user->update(['plan_id' => $plan->id, 'balance' => $user->balance - $plan->price,]);

                if ($user) {
                    $user->transactions()->create([
                        'trx' => getTrx(),
                        'user_id' => $user->id,
                        'amount' => $plan->price,
                        'main_amo' => $plan->price,
                        'balance' => $user->balance,
                        'title' => 'Purchased ' . $plan->name,
                        'charge' => 0,
                        'type' => 7,
                    ]);
                    //hit position start
                    $this->get_position($user->id);
                    //hit position end



                    //hit position start
                    $this->give_referral_commission($user->id, $plan->id);
                    //hit position end

                    /// //hit ref level commission start
                    $this->give_level_commission($user->id, $plan->id);
                    //hit ref level commission end



                    send_email($user, 'pan_purchased', [

                        'name' => $plan->name,
                        'price' => $plan->price . ' ' . $gnl->cur_text,
                        'balance_now' => $user->balance,

                    ]);

                    send_sms($user, 'pan_purchased', [

                        'name' => $plan->name,
                        'price' => $plan->price . ' ' . $gnl->cur_text,
                        'balance_now' => $user->balance,
                    ]);

                    $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
                    return redirect()->route('user.home')->withNotify($notify);

                }

                $notify[] = ['error', 'Something Went Wrong'];
                return back()->withNotify($notify);


            }
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);

        }
        $notify[] = ['error', 'Something Went Wrong'];
        return back()->withNotify($notify);
    }




    function matrixIndex($lv_no)
    {

// showUserLevel();
        $gnl = GeneralSetting::first();
        if ($lv_no > $gnl->matrix_height) {

            $notify[] = ['error', 'No Level Found.'];

            return redirect()->route('home')->withNotify($notify);
        }
        $data['page_title'] = "My Level  Referrer";
        $data['lv_no'] = $lv_no;
        $data['referral'] = User::where('position_id', auth()->id())->get();
        // return $data;
        // showUserLevel()
        return view(activeTemplate() . '.user.matrix', $data);
    }



    function matrixIndexDate(Request $request)
    {
// return $request;
        $date=$request->current_date;
// showUserLevel();
        $lv_no=5;
        $gnl = GeneralSetting::first();
        if ($lv_no > $gnl->matrix_height) {

            $notify[] = ['error', 'No Level Found.'];

            return redirect()->route('home')->withNotify($notify);
        }
        $data['page_title'] = " Level Referrer of ".$date;
        $data['lv_no'] = 1;
        $data['date'] = $date;
        $data['referral'] = User::where('position_id', auth()->id())->get();
        // return $data;
        // showUserLevel()
        return view(activeTemplate() . '.user.matrix_date', $data);
    }




    public function referralIndex()
    {
        $data['page_title'] = 'My Referrer';
        $data['referrals'] = User::where('ref_id', auth()->id())->paginate(config('constants.table.default'));

        // echo "<h1>".$data."</h1>";
        return view(activeTemplate() . '.user.referrer', $data);
    }

    public function referralIndexDate(Request $request)
    {
        $data['page_title'] = 'My Referrer Of '.$request->current_date;;
        // $data['referrals'] = User::where('ref_id', auth()->id())->paginate(config('constants.table.default'));
  $data['referrals'] = DB::table('users')
        ->selectRaw("`id`, `ref_id`, `plan_id`, `position`, `position_id`, `firstname`, `lastname`, `username`, `ref_link`, `email`, `mobile`, `balance`, `password`, `image`, `address`, `country`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `bank_ac_name`, `bank_ac_no`, `bank_ac`, `ctm`, `nic`, `remember_token`, date_format(created_at,'%Y-%m-%d') as created_at, `updated_at`")
        ->where('ref_id', '=',  auth()->id())
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->paginate(config('constants.table.default'));


        // echo "<h1>".$data."</h1>";
        return view(activeTemplate() . '.user.referrer', $data);
    }



    function indexTransfer()
    {
        $page_title = 'Balance Transfer';
        return view(activeTemplate() . '.user.balance_transfer', compact('page_title'));
    }

    function balTransfer(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);
        $gnl = GeneralSetting::first();
        $user = User::find(Auth::id());
        $trans_user = User::where('username', $request->username)->orwhere('email', $request->username)->first();
        if ($trans_user == '') {

            $notify[] = ['error', 'Username Not Found'];

            return back()->withNotify($notify);


        }
        if ($trans_user->username == $user->username) {

            $notify[] = ['error', 'Balance Transfer Not Possible In Your Own Account'];

            return back()->withNotify($notify);

        }
        $charge = $gnl->bal_trans_fixed_charge + ($request->amount * $gnl->bal_trans_per_charge) / 100;
        $amount = $request->amount + $charge;
        if ($user->balance >= $amount) {

            $new_balance = $user->balance - $amount;
            $user->balance = $new_balance;
            $user->save();

            $trx = getTrx();

            Trx::create([
                'trx' => $trx,
                'user_id' => $user->id,
                'type' => 8,
                'title' => 'Balance Transferred To ' . $trans_user->fullname,
                'amount' => $request->amount,
                'main_amo' => $amount,
                'balance' => $user->balance,
                'charge' => $charge
            ]);


            send_email($user, 'BAL_SEND', [

                'amount' => $request->amount . '' . $gnl->cur_text,
                'name' => $trans_user->username,
                'charge' => $charge . ' ' . $gnl->cur_text,
                'balance_now' => $new_balance . ' ' . $gnl->cur_text,

            ]);

            send_sms($user, 'BAL_SEND', [
                'amount' => $request->amount . '' . $gnl->cur_text,
                'name' => $trans_user->username,
                'charge' => $charge . ' ' . $gnl->cur_text,
                'balance_now' => $new_balance . ' ' . $gnl->cur_text,
            ]);


            $trans_new_bal = $trans_user->balance + $request->amount;
            $trans_user->balance = $trans_new_bal;
            $trans_user->save();

            Trx::create([
                'trx' => $trx,
                'user_id' => $trans_user->id,
                'type' => 8,
                'title' => 'Balance Transferred From ' . $user->fullname,
                'amount' => $request->amount,
                'main_amo' => $request->amount,
                'balance' => $trans_new_bal,
                'charge' => 0
            ]);


            send_email($trans_user, 'bal_receive', [

                'amount' => $request->amount . '' . $gnl->cur_text,
                'name' => $user->username,
                'charge' => 0 . ' ' . $gnl->cur_text,
                'balance_now' => $trans_new_bal . ' ' . $gnl->cur_text,

            ]);

            send_sms($trans_user, 'bal_receive', [
                'amount' => $request->amount . '' . $gnl->cur_text,
                'name' => $user->username,
                'charge' => 0 . ' ' . $gnl->cur_text,
                'balance_now' => $trans_new_bal . ' ' . $gnl->cur_text,
            ]);


            $notify[] = ['success', 'Balance Transferred Successfully.'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Insufficient Balance.'];
            return back()->withNotify($notify);

        }
    }

    function searchUser(Request $request)
    {
        $trans_user = User::where('id', '!=', Auth::id())->where('username', $request->username)
            ->orwhere('email', $request->username)->count();
        if ($trans_user == 1) {
            return response()->json(['success' => true, 'message' => 'Correct User']);
        } else {
            return response()->json(['success' => false, 'message' => 'User Not Found']);
        }

    }


    function pinRecharge()
    {


        $page_title = 'Recharge Wallet With E-PIN ';
        $epin = Epin::where('created_user_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view(activeTemplate() . '.user.pin_recharge', compact('page_title', 'epin'));
    }


    function pinRechargeDate(Request $request)
    {
        $page_title = 'Recharge Wallet With E-PIN  of '.$request->current_date;
        $epin = Epin::
        where('created_user_id', auth()->id())
        ->where('created_at', 'like',"%$request->current_date%"  )

        ->latest()->paginate(config('constants.table.default'));
        return view(activeTemplate() . '.user.pin_recharge', compact('page_title', 'epin'));
    }


    function EPinRecharge()
    {


        $page_title = 'My E-Pin Recharged';
        $epin = Epin::where('created_user_id', auth()->id())->where('status', 2)->latest()->paginate(config('constants.table.default'));
        return view(activeTemplate() . '.user.my_pin', compact('page_title', 'epin'));
    }

    function EPinGenerated()
    {


        $page_title = 'My E-Pin Generated';
        $epin = Epin::where('created_user_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view(activeTemplate() . '.user.my_pin', compact('page_title', 'epin'));
    }


    function pinRechargePost(Request $request)
    {
        $this->validate($request, [
            'pin' => 'required'
        ]);

        $pin = Epin::where('pin', $request->pin)->first();

        if ($pin == '') {
            $notify[] = ['error', 'Wrong Pin.'];
            return back()->withNotify($notify);
        }
        if ($pin->status == 2) {
            $notify[] = ['error', 'Already Used.'];
            return back()->withNotify($notify);
        }
        if ($pin->status == 1) {
            $pin->status = 2;
            $pin->user_id = Auth::id();
            $pin->save();

            $user = User::find(Auth::id());
            $new_balance = $user->balance + $pin->amount;
            $user->balance = $new_balance;
            $user->save();

            $tlog['type'] = 9;
            $tlog['user_id'] = $user->id;
            $tlog['amount'] = $pin->amount;
            $tlog['main_amo'] = $pin->amount;
            $tlog['balance'] = $user->balance;
            $tlog['charge'] = 0;
            $tlog['title'] = 'E-Pin Recharge';
            $tlog['trx'] = getTrx();
            Trx::create($tlog);

            $notify[] = ['success', 'Balance Added Successfully.'];
            return redirect()->back()->withNotify($notify);

        }

    }

    function pinGenerate(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:0|max:191'
        ]);

        $user = User::find(auth()->id());
        if ($user->balance < $request->amount) {

            $notify[] = ['error', 'Insufficient balance for generate pin'];
            return redirect()->back()->withNotify($notify);

        }

        $new_balance = $user->balance - $request->amount;
        $user->balance = $new_balance;
        $user->save();

        $tlog['type'] = 10;
        $tlog['user_id'] = $user->id;
        $tlog['amount'] = $request->amount;
        $tlog['main_amo'] = $request->amount;
        $tlog['balance'] = $user->balance;
        $tlog['title'] = 'E-Pin Generate';
        $tlog['trx'] = getTrx();
        $tlog['charge'] = 0;
        Trx::create($tlog);

         $pin = rand(10000,99999).'-'.rand(10000,99999);
        Epin::create([
            'created_user_id' => $user->id,
            'user_id' => 0,
            'pin' => $pin,
            'amount' => $request->amount,
            'status' => 1,
        ]);

        $notify[] = ['success', 'Pin generate Successfully'];
        return redirect()->back()->withNotify($notify);

    }
}
