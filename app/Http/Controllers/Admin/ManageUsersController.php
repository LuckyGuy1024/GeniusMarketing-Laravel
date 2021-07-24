<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Plan;
use App\User;
use App\UserLogin;
use App\KYC;
use Illuminate\Http\Request;
use DB;

class ManageUsersController extends Controller
{
    public function allUsers()
    {
        $page_title = 'Manage Users';
        $empty_message = 'No user found';
        $users = User::orderBy('firstname')->orderBy('lastname')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }

    public function allKYCs()
    {
        $page_title = 'Manage KYCs';
        $empty_message = 'No KYC found';
        // $kyc= = DB::select( DB::raw(""));

        $users = KYC::orderBy('user_id')->paginate(config('constants.table.default'));
        return view('admin.users.kycs', compact('page_title', 'empty_message', 'users'));
    }
    public function activeUsers()
    {
        $page_title = 'Manage Active Users';
        $empty_message = 'No active user found';
        $users = User::active()->orderBy('firstname')->orderBy('lastname')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function bannedUsers()
    {
        $page_title = 'Manage Banned Users';
        $empty_message = 'No banned user found';
        $users = User::banned()->orderBy('firstname')->orderBy('lastname')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function emailUnverifiedUsers()
    {
        $page_title = 'Manage Email Unverified Users';
        $empty_message = 'No email unverified user found';
        $users = User::emailUnverified()->orderBy('firstname')->orderBy('lastname')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }
    public function smsUnverifiedUsers()
    {
        $page_title = 'Manage SMS Unverified Users';
        $empty_message = 'No sms unverified user found';
        $users = User::smsUnverified()->orderBy('firstname')->orderBy('lastname')->paginate(config('constants.table.default'));
        return view('admin.users.users', compact('page_title', 'empty_message', 'users'));
    }

    public function detail($id){
    


        $user = User::findOrFail($id);
        $withdrawals = $user->withdrawals()->selectRaw('SUM(withdrawals.amount * withdrawals.rate) as total')->first();
        $deposits = $user->deposits()->selectRaw('SUM(deposits.amount * deposits.rate) as total')->first();
        $transactions = $user->transactions()->count();
        $page_title = 'User Detail';
        $refer = User::where('id', $user->ref_id)->first();
        $plan = Plan::where('id', $user->plan_id)->first();
        $kyc=KYC::all()->where("user_id","=",$id)->last();
// custom plan query
        // select * from plans as p , purchase_plans as ps where p.id=ps.plan_id and ps.user_id=7 
// custom plan query
        // select * from plans as p , purchase_plans as ps where p.id=ps.plan_id and ps.user_id=7 
\DB::statement("SET SQL_MODE=''");
$plans = DB::select( DB::raw("select * from plans as p , purchase_plans as ps where p.id=ps.plan_id  and ps.user_id=:user_id  "), array(
      'user_id' => $user->id
 ));
$planText="";
$index=1;
foreach($plans as $p){
$planText=$planText."<br>".'<b>'.$index.'.  '.$p->name.'</b>';
$index++;
}

// return $planText;
// ends here
// ends here
        return view('admin.users.detail', compact('page_title', 'user', 'withdrawals', 'deposits', 'transactions', 'refer', 'plan','kyc','planText'));
    }

    public function search(Request $request, $scope)
    {
        $search = $request->search;
        if (empty($search)) return back();
        $users =  User::where(function ($user) use ($search) {
            $user->where('username', $search)->orWhere('email', $search);
        });
        $page_title = '';
        switch ($scope) {
            case 'active':
                $page_title .= 'Active ';
                $users = $users->where('status', 1);
                break;
            case 'banned':
                $page_title .= 'Banned';
                $users = $users->where('status', 0);
                break;
            case 'emailUnverified':
                $page_title .= 'Email Unerified ';
                $users = $users->where('ev', 0);
                break;
            case 'smsUnverified':
                $page_title .= 'SMS Unverified ';
                $users = $users->where('sv', 0);
                break;
        }
        $users = $users->paginate(config('constants.table.default'));
        $page_title .= 'User Search - ' . $search;
        $empty_message = 'No search result found';
        return view('admin.users.users', compact('page_title', 'search', 'scope', 'empty_message', 'users'));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
            'email' => 'required|email|max:160|unique:users,email,' . $user->id,
        ]);


        if ($request->email != $user->email && User::whereEmail($request->email)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }

        if ($request->mobile != $user->mobile && User::where('mobile', $request->mobile)->whereId('!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Phone number already exists.'];
            return back()->withNotify($notify);
        }

// user updating
 $status=$request->status;

 $lastRow=KYC::all()->where("user_id","=",$id)->last();
  if($lastRow){
 $kyc=KYC::find($lastRow->id);
 $kyc->status   =$status ;
 $kyc->save();
}


         // user update ends here
        $user->update([
            'mobile'    => $request->mobile,
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'mobile'    => $request->mobile,
            'address'   => [
                'address'   => $request->address,
                'city'      => $request->city,
                'state'     => $request->state,
                'zip'       => $request->zip,
                'country'   => $request->country,
            ],
            'status'    => $request->status ? 1 : 0,
            'ev'        => $request->ev ? 1 : 0,
            'sv'        => $request->sv ? 1 : 0,
            'ts'        => $request->ts ? 1 : 0,
            'tv'        => $request->tv ? 1 : 0,
        ]);

        $notify[] = ['success', 'User detail has been updated'];
        return redirect()->route('admin.users.detail', $user->id)->withNotify($notify);
    }

    public function loginHistory(Request $request)
    {

        if ($request->search) {
            $search = $request->search;
            $page_title = 'User Login History Search - ' . $search;
            $empty_message = 'No search result found.';
            $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
                $query->where('username', $search);
            })->latest()->paginate(config('constants.table.default'));
            return view('admin.users.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
        }
        $page_title = 'User Login History';
        $empty_message = 'No users login found.';
        $login_logs = UserLogin::latest()->paginate(config('constants.table.default'));
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function userLoginHistory($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'User Login History - ' . $user->username;
        $empty_message = 'No users login found.';
        $login_logs = $user->login_logs()->latest()->paginate(config('constants.table.default'));
        return view('admin.users.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function addSubBalance(Request $request, $id)
    {
        $request->validate(['amount' => 'required|numeric|gt:0']);

        $user = User::findOrFail($id);
        $amount = formatter_money($request->amount);
        $general = GeneralSetting::first(['cur_sym']);


        if ($request->act) {
            $user->balance = bcadd($user->balance, $amount, site_precision());
            $notify[] = ['success', $general->cur_sym . $amount . ' has been added to ' . $user->username . ' balance'];
        } else {
            if ($amount > $user->balance) {
                $notify[] = ['error', $user->username . ' has insufficient balance.'];
                return back()->withNotify($notify);
            }
            $user->balance = bcsub($user->balance, $amount, site_precision());
            $notify[] = ['success', $general->cur_sym . $amount . ' has been subtracted from ' . $user->username . ' balance'];
        }
        $user->save();
        return back()->withNotify($notify);
    }

    public function showEmailAllForm()
    {
        $page_title = 'Send Email To All Users';
        return view('admin.users.email_all', compact('page_title'));
    }

    public function sendEmailAll(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        foreach (User::where('status', 1)->cursor() as $user) {
            send_general_email($user->email, $request->subject, $request->message, $user->username);
        }

        $notify[] = ['success', 'All users will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function showEmailSingleForm($id)
    {
        $user = User::findOrFail($id);
        $page_title = 'Send Email To: ' . $user->username;

        return view('admin.users.email_single', compact('page_title', 'user'));
    }

    public function sendEmailSingle(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:65000',
            'subject' => 'required|string|max:190',
        ]);

        $user = User::findOrFail($id);
        send_general_email($user->email, $request->subject, $request->message, $user->username);

        $notify[] = ['success', $user->username . ' will receive an email shortly.'];
        return back()->withNotify($notify);
    }

    public function withdrawals(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Withdrawals : ' . $user->username;
            $withdrawals = $user->withdrawals()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No withdrawals';
            return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'search', 'withdrawals', 'empty_message'));
        }
        $page_title = 'User Withdrawals : ' . $user->username;
        $withdrawals = $user->withdrawals()->latest()->paginate(config('table.default'));
        $empty_message = 'No withdrawals';
        return view('admin.withdraw.withdrawals', compact('page_title', 'user', 'withdrawals', 'empty_message'));
    }

    public function deposits(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Deposits : ' . $user->username;
            $deposits = $user->deposits()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No deposits';
            return view('admin.deposit_list', compact('page_title', 'search', 'user', 'deposits', 'empty_message'));
        }

        $page_title = 'User Deposit : ' . $user->username;
        $deposits = $user->deposits()->latest()->paginate(config('table.default'));
        $empty_message = 'No deposits';
        return view('admin.deposit_list', compact('page_title', 'user', 'deposits', 'empty_message'));
    }

    public function transactions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Search User Transactions : ' . $user->username;
            $transactions = $user->transactions()->where('trx', $search)->latest()->paginate(config('table.default'));
            $empty_message = 'No transactions';
            return view('admin.reports.transactions', compact('page_title', 'search', 'user', 'transactions', 'empty_message'));
        }
        $page_title = 'User Transactions : ' . $user->username;
        $transactions = $user->transactions()->orderBy('id', 'DESC')->paginate(config('table.default'));
        $empty_message = 'No transactions';
        return view('admin.reports.transactions', compact('page_title', 'user', 'transactions', 'empty_message'));
    }


    public function refSingle($id)
    {
        $user = User::findOrFail($id);

        $data['referrals'] = User::where('ref_id', $id)->paginate(config('constants.table.default'));
        $data['page_title'] =  $user->username.' Referrers';
        $data['empty_message'] = 'No referral found';
        return view('admin.users.ref_history', $data);
    }


    function matrixSingle($lv_no, $id)
    {
        $data['user'] = User::findOrFail($id);


        $gnl = GeneralSetting::first();
        if (1 > $gnl->matrix_height) {

            $notify[] = ['error', 'No Level Found.'];

            return redirect()->route('home')->withNotify($notify);
        }
        $data['page_title'] = $data['user']->username. " Level " . $lv_no . " Referrer";
        $data['lv_no'] = $lv_no;
        $data['referral'] = User::where('position_id', $id)->get();
        return view('admin.users.matrix_level', $data);
    }


}
