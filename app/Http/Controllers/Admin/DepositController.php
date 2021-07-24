<?php

namespace App\Http\Controllers\Admin;

use App\Deposit;
use App\GeneralSetting;
use App\Trx;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{



    
    public function deposit()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No deposit history available.';
        $page="list";
        $deposits = Deposit::where('status', '!=', 0)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        // return $deposits;
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits','page'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        // return $request;
        if (empty($search)) return back();
        $page_title = '';
        $empty_message = 'No search result was found.';

        $deposits = Deposit::with(['user', 'gateway'])->where(function ($q) use ($search) {
            $q->where('trx', $search)->orWhereHas('user', function ($user) use ($search) {
                $user->where('username', $search);
            });
        });
        switch ($scope) {
            case 'pending':
                $page_title .= 'Pending Deposits Search';
                $deposits = $deposits
                // ->where('method_code', '>=', 1000)
                ->where('status', 3);
                break;
            case 'approved':
                $page_title .= 'Approved Deposits Search';
                $deposits = $deposits
                // ->where('method_code', '>=', 1000)
                ->where('status', 1);
                break;
            case 'rejected':
                $page_title .= 'Rejected Deposits Search';
                $deposits = $deposits
                // ->where('method_code', '>=', 1000)
                ->where('status', 3);
                break;
            case 'list':
                $page_title .= 'Deposits History Search';
                break;
        }
        $page="list";
        $deposits = $deposits->paginate(config('constants.table.defult'));
        $page_title .= ' - ' . $search;

        return view('admin.deposit_list', compact('page_title', 'search', 'scope', 'empty_message', 'deposits','page'));
    }

    public function pending()
    {
        $page_title = 'Pending Deposits';
        $empty_message = 'No pending deposits.';
         $page = 'pending';
        $deposits = Deposit::
        // where('method_code', '>=', 1000)->
        where('status', 2)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits','page'));
    }



    public function depositDate(Request $request)
    {
        // return $request;

     $page=$request->page;
        $date=$request->current_date;
        $page_title="Withdrawal";
        $deposits="";
        $empty_message="No withdrawal ";
$col="  `id`, `user_id`, `method_code`, `method_currency`, `amount`, `rate`, `charge`, `final_amo`, `btc_amo`, `btc_wallet`, `trx`, `try`, `detail`, `verify_image`, `status`,  date_format(created_at,'%Y-%m-%d') as created_at, `updated_at`";

 $deposits = Deposit::selectRaw($col)->where('status', '!=', 0)->with(['user', 'gateway'])
->where('created_at', 'like',"%$request->current_date%"  )
 ->latest()->paginate(config('constants.table.default'));

      // return $deposits;


        switch($page){

           case "list":
       $page_title = 'Deposit History of '.$date;
        $page = 'list';
        // $withdrawals = Withdrawal::where('status', '!=', 0)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No Deposit history';
       $deposits = Deposit::selectRaw($col)
        ->where('status', '!=', 0)
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->with(['user', 'gateway'])
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "pending":
       $page_title = 'Pending Deposit of '.$date;
        $page = 'pending';
        $empty_message = 'No Pending Deposit ';
       $deposits = Deposit::selectRaw($col)
        ->where('status', '=', 2)
        ->where('created_at', 'like',"%$request->current_date%"  )
        // ->where('method_code', '>=', 1000)
        ->with(['user', 'gateway'])
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "approved":
       $page_title = 'Approved Deposit of '.$date;
        $page = 'approved';
        $empty_message = 'No Approved withdrawal ';
       $deposits = Deposit::selectRaw($col)
        ->where('status', '=', 1)
        ->where('created_at', 'like',"%$request->current_date%"  )
        // ->where('method_code', '>=', 1000)
        ->with(['user', 'gateway'])
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "rejected":
       $page_title = 'Rejected Deposit of '.$date;
        $page = 'rejected';
        $empty_message = 'No Rejected Deposit ';
       $deposits = Deposit::selectRaw($col)
        ->where('status', '=', 3)
        ->where('created_at', 'like',"%$request->current_date%"  )
        // ->where('method_code', '>=', 1000)
        ->with(['user', 'gateway'])
        ->latest()->paginate(config('constants.table.default')); 
        }

        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits','page'));
    }


    public function approved()
    {
        $page_title = 'Approved Deposits';
        $empty_message = 'No approved deposits.';
          $page = 'approved';
        $deposits = Deposit::
        // where('method_code', '>=', 1000)->
        where('status', 1)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits','page'));
    }

    public function rejected()
    {
        $page_title = 'Rejected Deposits';
        $empty_message = 'No rejected deposits.';
          $page = 'rejected';
        $deposits = Deposit::
        // where('method_code', '>=', 1000)->
        where('status', 3)->with(['user', 'gateway'])->latest()->paginate(config('constants.table.default'));
        return view('admin.deposit_list', compact('page_title', 'empty_message', 'deposits','page'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::
        // where('method_code', '>=', 1000)->
        findOrFail($request->id);

        $user = User::find($deposit->user_id);
        $user->balance += $deposit->amount;
        $user->save();


        $deposit->update(['status' => 1]);

        $deposit->user->transactions()->save(new Trx([
            'amount' => $deposit->amount,
            'main_amo' => $deposit->amount+$deposit->charge,
            'charge' => $deposit->charge,
            'type' => 'deposit',
            'title' => 'Deposit Via ' . $deposit->gateway->name,
            'trx' => $deposit->trx,
            'balance' => $user->balance,
        ]));


        $general = GeneralSetting::first(['cur_sym']);

        send_email($deposit->user, 'DEPOSIT_APPROVE', [
            'trx' => $deposit->trx,
            'amount' => $general->cur_sym . formatter_money($deposit->amount),
            'receive_amount' => $general->cur_sym . formatter_money($deposit->amount),
            'charge' => $general->cur_sym . formatter_money($deposit->charge),
            'method' => $deposit->gateway->name,
        ]);

        send_sms($deposit->user, 'DEPOSIT_APPROVE', [
            'trx' => $deposit->trx,
            'amount' => $general->cur_sym . formatter_money($deposit->amount),
            'receive_amount' => $general->cur_sym . formatter_money($deposit->amount),
            'charge' => $general->cur_sym . formatter_money($deposit->charge),
            'method' => $deposit->gateway->name,
        ]);


        $notify[] = ['success', 'Deposit has been approved.'];
        return back()->withNotify($notify);
    }

    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $deposit = Deposit::
        // where('method_code', '>=', 1000)->
        findOrFail($request->id);

        $deposit->update(['status' => 3]);

        $general = GeneralSetting::first(['cur_sym']);

        send_email($deposit->user, 'DEPOSIT_REJECT', [
            'trx' => $deposit->trx,
            'amount' => $general->cur_sym . formatter_money($deposit->amount),
            'method' => $deposit->gateway->name,
        ]);

        send_sms($deposit->user, 'DEPOSIT_REJECT', [
            'trx' => $deposit->trx,
            'amount' => $general->cur_sym . formatter_money($deposit->amount),
            'method' => $deposit->gateway->name,
        ]);

        $notify[] = ['success', 'Deposit has been rejected.'];
        return back()->withNotify($notify);
    }
}
