<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposit;
use App\GeneralSetting;
use App\Lib\GoogleAuthenticator;
use App\Rules\FileTypeValidate;
use App\SupportTicket;
use App\Trx;
use App\UserLogin;
use App\Withdrawal;
use App\WithdrawMethod;
use App\KYC;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KYCController extends Controller
{
      public function home()
    {
        $page_title = 'Dashboard';


        $user = Auth::user();
        $data['page_title'] = "Dashboard";
        $data['total_deposit'] = Deposit::whereUserId($user->id)->whereStatus(1)->sum('amount');
        $data['total_withdraw'] = Withdrawal::whereUserId($user->id)->whereStatus(1)->sum('amount');


        $data['ref_com'] = Trx::whereUserId($user->id)->whereType(11)->sum('amount');
        $data['level_com'] = Trx::whereUserId($user->id)->whereType(4)->sum('amount');
        $data['total_epin_recharge'] = Trx::whereUserId($user->id)->whereType(9)->sum('amount');
        $data['total_epin_generate'] = Trx::whereUserId($user->id)->whereType(10)->sum('amount');
        $data['total_bal_transfer'] = Trx::whereUserId($user->id)->whereType(8)->sum('amount');

        $data['total_direct_ref'] = User::where('ref_id', $user->id)->count();

        $data['total_paid_width'] = User::where('position_id', $user->id)->count();


        if (\auth()->user()->ref_id != 0) {
            $data['ref_user'] = User::find(\auth()->user()->ref_id);
        }

        return view(activeTemplate() . 'user.dashboard', compact('page_title'), $data);
    }






    function KYCIndex()
    {
        $data['page_title'] = "KYC Settings";
         // $lastRow=KYC::all()->last();
         $lastRow=KYC::all()->where("user_id","=",auth()->user()->id)->last();
if($lastRow==null || $lastRow==""){
$kyc=new KYC;
$kyc->user_id   =Auth::user()->id ;
$kyc->occupation   ="private_job";
$kyc->nic   =Auth::user()->nic ;
$kyc->remarks   ="0" ;
$kyc->e_pin   ="0";
$kyc->nic_image   ="" ;
$kyc->image   ="" ;
$kyc->status   ="0" ;
$kyc->save();
}

         // return $lastRow;
        return view(activeTemplate() . '.user.kyc', $data)->with([
"kyc"=>$lastRow,
        ]);
    }

function KYCAdd(Request $request){

 $validation = $this->validate($request,
  [
    'nic' => 'required|unique:k_y_c_s',
     'nic_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
     'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
    'remarks' => 'required',
    'e_pin' => 'required',
    'occupation' => 'required',
]);

$image="";
$nic_image="";
         if($request->hasFile('picture')){
         $image=$request->picture->store("public/documents");
         }

         if($request->hasFile('nic_image')){
         $nic_image=$request->nic_image->store("public/documents");
         }
         

$kyc=new KYC;
$kyc->user_id   =Auth::user()->id ;
$kyc->occupation   =$request->occupation ;
$kyc->nic   =$request->nic ;
$kyc->remarks   =$request->remarks ;
$kyc->e_pin   =$request->e_pin ;
$kyc->nic_image   =$nic_image ;
$kyc->image   =$image ;
$kyc->status   ="0" ;
if ($kyc->save())
        {
             session()
                ->flash('success', "KYC Add !");
                  $notify[] = ['success', 'KYC Added .'];
                return back()->withNotify($notify);
 // return redirect()->route('user.kyc');
        }
        else{
           return redirect()->route('user.kyc');
  
        }
    }


function KYCUpdate(Request $request){
// return $request;
 $validation = $this->validate($request,
  [
    'nic' => 'required',
     // 'nic_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
     // 'picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
    'remarks' => 'required',
    'e_pin' => 'required',
    'occupation' => 'required',
]);

$image="";
$nic_image="";

         $lastRow=KYC::all()->where("user_id","=",auth()->user()->id)->last();
         $kyc=KYC::find($lastRow->id);

        $image=$lastRow->image;
       $nic_image=$lastRow->nic_image;
         
// $kyc=new KYC;

        //  if ($request->hasFile('picture')) {
        //     try {
        //         $old = $lastRow->image ?: null;
        //         $kyc->image = upload_image($request->picture, config('constants.admin.profile.path'), config('contants.admin.profile.size'), $old);
        //     } catch (\Exception $exp) {
        //         $notify[] = ['error', 'Image could not be uploaded.'];
        //         // return back()->withNotify($notify);
        //     }
        // }
          if($request->hasFile('picture')){
         $image=$request->picture->store("public/documents");
        $image= str_replace('public', '', $image);
         }

         if($request->hasFile('nic_image')){
         $nic_image=$request->nic_image->store("public/documents");
          $nic_image= str_replace('public', '', $nic_image);
         }

$kyc->user_id   =Auth::user()->id ;
$kyc->occupation   =$request->occupation ;
$kyc->nic   =$request->nic ;
$kyc->remarks   =$request->remarks ;
$kyc->e_pin   =$request->e_pin ;
$kyc->nic_image   =$nic_image ;
$kyc->image   =$image ;

if ($kyc->save())
        {
            
                $notify[] = ['success', 'KYC Updated .'];
                return back()->withNotify($notify);
 // return redirect()->route('user.kyc');
        }
        else{
           return redirect()->route('user.kyc');
  
        }
    }
    // return $request;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'occupation' => 'required|string|max:60',
            'picture' => 'required|string|max:255',
            'nic_image' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
            'nic' => 'required|string|max:50|unique:users',
            'e_pin' => 'required|string|max:255'
            
        ]);
    }

    function passwordUpdate(Request $request)
    {


        $this->validate($request, [
            'current' => 'required|max:191',
            'password' => 'required|confirmed|max:191',
            'password_confirmation' => 'required|max:191'
        ]);
        $user = User::find(Auth::id());
        if (!Hash::check($request->current, $user->password)) {
            $notify[] = ['error', 'Current password does not match'];
            return back()->withNotify($notify);

        }
        if ($request->current == $request->password) {
            $notify[] = ['error', 'Current password and new password should not same'];
            return back()->withNotify($notify);

        }
        $user->password = Hash::make($request->password);
        $user->save();
        $notify[] = ['success', 'Password update successful'];
        return back()->withNotify($notify);


    }


    public function profile()
    {
        $page_title = 'Profile';
        return view(activeTemplate() . 'user.profile', compact('page_title'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:160',
            'lastname' => 'required|max:160',
            'address' => 'nullable|max:160',
            'city' => 'nullable|max:160',
            'state' => 'nullable|max:160',
            'zip' => 'nullable|max:160',
            'country' => 'nullable|max:160',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        $filename = auth()->user()->image;
        if ($request->hasFile('image')) {
            try {
                $path = config('constants.user.profile.path');
                $size = config('constants.user.profile.size');
                $filename = upload_image($request->image, $path, $size, $filename);
            } catch (\Exception $exp) {
                $notify[] = ['success', 'Image could not be uploaded'];
                return back()->withNotify($notify);
            }
        }

        auth()->user()->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'image' => $filename,
            'address' => [
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
            ]
        ]);
        $notify[] = ['success', 'Your profile has been updated'];
        return back()->withNotify($notify);
    }

    public function passwordChange()
    {
        $page_title = 'Password Change';
        return view(activeTemplate() . 'user.password', compact('page_title'));
    }



}
