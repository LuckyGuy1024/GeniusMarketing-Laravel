<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use App\MatrixLevel;
use App\Http\Controllers\Controller;
use App\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    function index()
    {
        $page_title = "Manage Plan";
        $plan = Plan::with('plan_level')->get();
        return view('admin.plan.index', compact('page_title', 'plan'));
    }

    function create()
    {
        $page_title = "Create Plan";
        return view('admin.plan.create', compact('page_title'));
    }

    function edit(Plan $plan)
    {
        $page_title = __($plan->name);
        return view('admin.plan.edit', compact('page_title', 'plan'));
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'ref_bonus' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',
            'name' => 'required|string|max:191',
            'amount.*' => 'required|numeric|min:0',
            'days' => 'required|numeric|min:0',
            'roi' => 'required|min:0',
        ]);
        $plan = Plan::create([
            'name' => $request->name,
            'price' => $request->price,
            'ref_bonus' => $request->ref_bonus,
            'days' => $request->days,
            'days' => $request->days,
            'roi' => $request->roi,
            'status' => 1,
        ]);
        $this->insertIntoMatrix($request->amount, $plan->id);

        $notify[] = ['success', 'Create Successfully'];
        return back()->withNotify($notify);

    }

    function update(Request $request, Plan $plan)
    {
        $this->validate($request, [
            'ref_bonus' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',
            'name' => 'required|string|max:191',
            'amount.*' => 'required|numeric|min:0',
             'days' => 'required|numeric|min:0',
            'roi' => 'required|min:0',
        ]);
        $plan->plan_level->each->delete();
        $plan->update([
            'name' => $request->name,
            'price' => $request->price,
            'ref_bonus' => $request->ref_bonus,
             'days' => $request->days,
            'roi' => $request->roi,
            'status' => $request->status,
        ]);
        $this->insertIntoMatrix($request->amount, $plan->id);

        $notify[] = ['success', 'Update Successfully'];

        return back()->withNotify($notify);


    }

    function insertIntoMatrix($amount, $id)
    {
        foreach ($amount as $key => $data) {
            MatrixLevel::create([
                'plan_id' => $id,
                'amount' => $data,
                'level' => $key + 1,
            ]);
        }
    }

}
