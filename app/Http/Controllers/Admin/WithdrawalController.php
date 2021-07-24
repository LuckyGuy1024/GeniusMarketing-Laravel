<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\Trx;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Withdrawal;

class WithdrawalController extends Controller
{

    public function withdrawalsDate(Request $request)
    {
        // return $request;
        $page=$request->page;
        $date=$request->current_date;
        $page_title="Withdrawal";
        $withdrawals="";
        $empty_message="No withdrawal ";
$col=" `id`, `method_id`, `user_id`, `trx`, `amount`, `charge`, `final_amo`, `delay`, `currency`, `rate`, `detail`, `status`,  date_format(created_at,'%Y-%m-%d') as created_at, `updated_at`";

        switch($page){

           case "log":
       $page_title = 'Withdrawal History of '.$date;
        $page = 'log';
        // $withdrawals = Withdrawal::where('status', '!=', 0)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal history';
       $withdrawals = Withdrawal::selectRaw($col)
        ->where('status', '!=', 0)
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "pending":
       $page_title = 'Pending Withdrawals of '.$date;
        $page = 'pending';
        $empty_message = 'No Pending withdrawal ';
       $withdrawals = Withdrawal::selectRaw($col)
        ->where('status', '=', 2)
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "approved":
       $page_title = 'Approved Withdrawals of '.$date;
        $page = 'approved';
        $empty_message = 'No Approved withdrawal ';
       $withdrawals = Withdrawal::selectRaw($col)
        ->where('status', '=', 1)
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->latest()->paginate(config('constants.table.default')); 
         break;

           case "rejected":
       $page_title = 'Rejected Withdrawals of '.$date;
        $page = 'rejected';
        $empty_message = 'No Rejected withdrawal ';
       $withdrawals = Withdrawal::selectRaw($col)
        ->where('status', '=', 3)
        ->where('created_at', 'like',"%$request->current_date%"  )
        ->latest()->paginate(config('constants.table.default')); 
     


        }




        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','page'));
    }
 
    public function pending()
    {
        $page_title = 'Pending Withdrawals';
        $page = 'pending';
        $withdrawals = Withdrawal::where('status', 2)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is pending';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','page'));
    }

    public function approved()
    {
        $page_title = 'Approved Withdrawals';
        $page = 'approved';
        $withdrawals = Withdrawal::where('status', 1)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is approved';
        // foreach($withdrawals as $w){
        //     echo $w->user_id;
        // }
        // echo "<br>";
        // return $withdrawals;

        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','page'));
    }

    public function rejected()
    {
        $page_title = 'Rejected Withdrawals';
        $page = 'rejected';
        $withdrawals = Withdrawal::where('status', 3)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal is rejected';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','page'));
    }

    public function log()
    {
        $page_title = 'Withdrawal History';
        $page = 'log';
        $withdrawals = Withdrawal::where('status', '!=', 0)->latest()->paginate(config('constants.table.default'));
        $empty_message = 'No withdrawal history';
        return view('admin.withdraw.withdrawals', compact('page_title', 'withdrawals', 'empty_message','page'));
    }

    public function approve(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::findOrFail($request->id);

        $user = User::find($withdraw->user_id);

        $withdraw->update(['status' => 1]);

        $general = GeneralSetting::first(['cur_sym']);

        send_email($withdraw->user, 'WITHDRAW_APPROVE', [
            'trx' => $withdraw->trx,
            'amount' => $general->cur_sym . formatter_money($withdraw->amount),
            'receive_amount' => $general->cur_sym . formatter_money($withdraw->amount - $withdraw->charge),
            'charge' => $general->cur_sym . formatter_money($withdraw->charge),
            'method' => $withdraw->method->name,
        ]);

        send_sms($withdraw->user, 'WITHDRAW_APPROVE', [
            'trx' => $withdraw->trx,
            'amount' => $general->cur_sym . formatter_money($withdraw->amount),
            'receive_amount' => $general->cur_sym . formatter_money($withdraw->amount - $withdraw->charge),
            'charge' => $general->cur_sym . formatter_money($withdraw->charge),
            'method' => $withdraw->method->name,
        ]);


        $notify[] = ['success', 'Withdrawal has been approved.'];
        return redirect()->route('admin.withdraw.pending')->withNotify($notify);
    }

    public function reject(Request $request)
    {
        $request->validate(['id' => 'required|integer']);
        $withdraw = Withdrawal::findOrFail($request->id);


        $user = User::find($withdraw->user_id);
        $user->balance += $withdraw->amount;
        $user->save();

        $withdraw->update(['status' => 3]);

        $withdraw->user->transactions()->save(new Trx([
            'amount' => $withdraw->amount,
            'main_amo' => $withdraw->amount,
            'charge' => 0,
            'type' => 'withdraw',
            'title' => 'withdraw rejected Via  ' . $withdraw->method->name,
            'trx' => $withdraw->trx,
            'balance' => $user->balance,
        ]));


        $general = GeneralSetting::first(['cur_sym']);

        send_email($withdraw->user, 'WITHDRAW_REJECT', [
            'trx' => $withdraw->trx,
            'amount' => $general->cur_sym . formatter_money($withdraw->amount),
            'method' => $withdraw->method->name,
        ]);

        send_sms($withdraw->user, 'WITHDRAW_REJECT', [
            'trx' => $withdraw->trx,
            'amount' => $general->cur_sym . formatter_money($withdraw->amount),
            'method' => $withdraw->method->name,
        ]);


        $notify[] = ['success', 'Withdrawal has been rejected.'];
        return redirect()->route('admin.withdraw.pending')->withNotify($notify);
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        if (empty($search)) return back();
        $page_title = '';
        $empty_message = 'No search result found.';

        $withdrawals = Withdrawal::with(['user', 'method'])->where(function ($q) use ($search) {
            $q->where('trx', $search)->orWhereHas('user', function ($user) use ($search) {
                $user->where('username', $search);
            });
        });
$page="pending";
        switch ($scope) {
            case 'pending':
                $page="pending";
                $page_title .= 'Pending Withdrawal Search';
                $withdrawals = $withdrawals->where('status', 2);
                break;
            case 'approved':
                $page="approved";
                $page_title .= 'Approved Withdrawal Search';
                $withdrawals = $withdrawals->where('status', 1);
                break;
            case 'rejected':
                $page="rejected";
                $page_title .= 'Rejected Withdrawal Search';
                $withdrawals = $withdrawals->where('status', 3);
                break;
            case 'log':
                $page="log";
                $page_title .= 'Withdrawal History Search';
                break;
        }

        $withdrawals = $withdrawals->paginate(config('constants.table.defult'));
        $page_title .= ' - ' . $search;


        return view('admin.withdraw.withdrawals', compact('page_title', 'empty_message', 'search', 'scope', 'withdrawals','page'));
    }
}
