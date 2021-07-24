<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GeneralSetting;
use Illuminate\Support\Facades\Validator;
use Image;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $general_setting = GeneralSetting::first();
        $page_title = 'General Settings';
        return view('admin.setting.general_setting', compact('page_title', 'general_setting'));
    }

    public function update(Request $request)
    {
        $validation_rule = [
            'bclr' => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],
            'sclr' => ['nullable', 'regex:/^[a-f0-9]{6}$/i'],

        ];

        $custom_attribute = [
            'bclr' => 'Base color',
            'sclr' => 'Secondary Color',

        ];

        $request->validate([
            'bal_trans_fixed_charge' => 'numeric|min:0',
            'bal_trans_per_charge' => 'numeric|min:0',
        ]);


        $validator = Validator::make($request->all(), $validation_rule, [], $custom_attribute);
        $validator->validate();



        $general_setting = GeneralSetting::first();
        $request->merge(['ev' => isset($request->ev) ? 1 : 0]);
        $request->merge(['en' => isset($request->en) ? 1 : 0]);
        $request->merge(['sv' => isset($request->sv) ? 1 : 0]);
        $request->merge(['sn' => isset($request->sn) ? 1 : 0]);
        $request->merge(['reg' => isset($request->reg) ? 1 : 0]);


        $general_setting->update($request->only(['sitename', 'cur_text', 'cur_sym', 'ev', 'en', 'sv', 'sn', 'reg', 'alert', 'bclr', 'sclr', 'bal_trans_fixed_charge', 'bal_trans_per_charge']));
        $notify[] = ['success', 'General Setting has been updated.'];
        return back()->withNotify($notify);
    }

    public function logoIcon()
    {
        $page_title = 'Logo & Icon';
        return view('admin.setting.logo_icon', compact('page_title'));
    }

    public function logoIconUpdate(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png',
            'favicon' => 'image|mimes:png',
        ]);

        if ($request->hasFile('logo')) {
            try {
                $path = config('constants.logoIcon.path');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                Image::make($request->logo)->save($path . '/logo.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Logo could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('favicon')) {
            try {
                $path = config('constants.logoIcon.path');
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                $size = explode('x', config('constants.favicon.size'));
                Image::make($request->favicon)->resize($size[0], $size[1])->save($path . '/favicon.png');
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Favicon could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $notify[] = ['success', 'Logo Icons has been updated.'];
        return back()->withNotify($notify);
    }



    public function contact()
    {
        $page_title = 'Contact Settings';
        $data = GeneralSetting::first();

        return view('admin.setting.contact', compact('page_title',   'data'));

    }

    public function contactUpdate(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $general_setting = GeneralSetting::first();
        $general_setting-> contact_email = $request->email;
        $general_setting-> contact_phone = $request->phone;
        $general_setting-> contact_address = $request->address;
        $general_setting->save();

        $notify[] = ['success', 'Contact Setting has been updated.'];
        return back()->withNotify($notify);
    }


    public function matrix(Request $request)
    {
        $this->validate($request,[
            'matrix_height' => 'required|numeric|min:1',
            'matrix_width' => 'required|numeric|min:1'
        ]);



        $gnl = GeneralSetting::first();
        $gnl->matrix_height = $request->matrix_height;
        $gnl->matrix_width = $request->matrix_width;
        $gnl->save();

        $notify[] = ['success', 'Successfully updated'];
        return back()->withNotify($notify);

    }
}
