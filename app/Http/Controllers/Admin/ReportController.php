<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Trx;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transaction()
    {
        $page_title = 'Transaction Logs';
        $transactions = Trx::with('user')->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Transactions Search - ' . $search;
        $empty_message = 'No transactions.';
        $transactions = Trx::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('username', $search);
        })->orWhere('trx', $search)->paginate(config('constants.table.default'));
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }


    public function purchasedPlan()
    {
        $page_title = 'Purchased Plan';
        $transactions = Trx::where('type', 7)->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $empty_message = 'No data found.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));

    }

    public function RefCom()
    {
        $page_title = 'Referral Commission';
        $transactions = Trx::where('type', 11)->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $empty_message = 'No data found.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));

    }

    public function e_pinRecharge()
    {
        $page_title = 'E-PIN Recharge';
        $transactions = Trx::where('type', 9)->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $empty_message = 'No data found.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));

    }
    public function Ref_bonus()
    {
        $page_title = 'Referral Bonus';
        $transactions = Trx::where('type', 11)->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $empty_message = 'No data found.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));

    }
}
