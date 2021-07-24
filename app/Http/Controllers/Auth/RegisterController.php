<?php

namespace App\Http\Controllers\Auth;

use App\GeneralSetting;
use App\User;
use App\KYC;
use App\Trx;
use App\Http\Controllers\Controller;
use App\WithdrawMethod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Validator;
use App\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware(['guest']);
        $this->middleware('regStatus')->except('registrationNotAllowed');
    }

    public function showRegistrationForm($ref = null)
    {
        $page_title = "Sign Up";
        return view(activeTemplate() . 'user.auth.register', compact('page_title'));
    }



    public function showRegistrationFormRef($username){

  $ref_user = User::where('ref_link', $username)->first();
   $user_id=$ref_user->id;

        if (isset($ref_user)){
            $page_title = "Sign Up";
            // if ($ref_user->plan_id == 0){

            //     $notify[] = ['error', $ref_user->username.' did not in subscribed in any plan'];
            //     return redirect()->route('user.register')->withNotify($notify);


            // }
            return view(activeTemplate().'.user.auth.register',compact('page_title', 'ref_user'));
        }else{
            return redirect()->route('user.register');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:60',
            'lastname' => 'required|string|max:60',
            'country' => 'required|string|max:80',
            'email' => 'required|string|email|max:160|unique:users',
            'nic' => 'required|string|max:50|unique:users',
            'mobile' => 'required|string|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|unique:users|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gnl = GeneralSetting::first();


if($data['ref_id']>0 ){
// change referral link
 $user=User::find($data['ref_id']);
 if($user){
        $user->ref_link=$user->username."-".rand(1000000,9999999);
        //  $user->balance=$user->balance+$totalAmount;
        $user->save();
// check subsribed packages
 \DB::statement("SET SQL_MODE=''");
$plans = DB::select( DB::raw("select * from plans as p , purchase_plans as ps where p.id=ps.plan_id  and ps.user_id=:user_id  "), array(
      'user_id' => $user->id
 ));
$totalAmount=0;
$totalPlanPrice=0;
foreach($plans as $p){
//Convert our percentage value into a decimal.
$percentInDecimal = $p->ref_bonus / 100;
//Get the result.
$percent = $percentInDecimal * $p->price;
// echo $percent."   ";
$totalAmount=$totalAmount+$percent;
$totalPlanPrice=$totalPlanPrice+$p->price;
}
// check if already subsribed plan

if($totalAmount>0 && $totalPlanPrice >0){

      $trx = new Trx();
        $trx->user_id =$user->id;
        $trx->amount = $totalAmount;
        $trx->charge ="0";
        $trx->main_amo = "0";
        $trx->balance = $totalPlanPrice;
        $trx->trx = getTrx();
        $trx->type = "4";
        $trx->title = ' Promo of signup ';
        $trx->save();

// user account
         $user->ref_link=$user->username."-".rand(1000000,9999999);
         $user->balance=$user->balance+$totalAmount;
        $user->save();
       // referral ends here

}

}//check user exists ends

}
// sending welcome email
  $general = GeneralSetting::first();
        $config = $general->mail_config;
        // $receiver_name = explode('@', $request->email)[0];
        $subject = 'Dear '. $data['firstname']." ". $data['lastname'].",";
        $message = 'Welcome to 3Genius Group Business Program! You’ve successfully signed up for a Business Account! , now ready for use.
        Your account credentials are: <br>';
        $message.="CIN : ".$data['nic']." <br> ";
        $message.="Full Name : ". $data['firstname']." ". $data['lastname']." <br> ";
          $message.="Cell : ".$data['mobile']." <br> ";
          $message.="Email : ".$data['email']." <br> ";
          $message.="User Name : ".$data['username']." <br> ";
          $message.="Password : ".$data['password']." <br> ";
          $message.="Date & Time  : ". date('Y/m/d H:i:s')." <br> ";
           $message.=" Thanks & Regards, <br> ";
           $message.=" 3Genius Group E-Registration System Administrator, <br> ";
           $message.=" Please do not print this e-mail unless it is absolutely necessary. <br><br> ";
           $message.="This message (including any attachments) is confidential and may be privileged. If you have received it by mistake please notify the sender by return email and delete this message from your system. Any unauthorized use or dissemination of this message in whole or in part is strictly prohibited. Please note that emails are susceptible to change.3Genius shall not be liable for the improper or incomplete transmission of the information contained in this communication nor for any delay in its receipt or damage to your system.3Genius neither guarantee that the integrity of this communication has been maintained nor that this communication is free of viruses,interceptions or interference. <br> <br>";
             $message.="Please do not reply to this message via e-mail. This address is automated, unattended, and cannot help with questions or requests. <br> ";
        try {
            send_general_email($data['email'], $subject, $message,$data['firstname']." ". $data['lastname']);
        } catch (\Exception $exp) {

        }
// email ends here

        return User::create([
            'ref_id' => $data['ref_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'username' => $data['username'],
            'ref_link' => $data['username']."-".rand(1000000,9999999),
            'mobile' => $data['mobile'],
            'nic' => $data['nic'],
            'address' => [
                'address' => '',
                'state' => '',
                'zip' => '',
                'country' => '',
                'city' => '',
            ],
            'status' => 1,
            'ev' =>  $gnl->ev ? 0 : 1,
            'sv' =>  $gnl->sv ? 0 : 1,
            'ts' => 0,
            'tv' => 1,
        ]);



    }



       public function sendTestMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $general = GeneralSetting::first();
        $config = $general->mail_config;
        $receiver_name = explode('@', $request->email)[0];
        $subject = 'Testing ' . strtoupper($config->name) . ' Mail';
        $message = 'This is a test email, please ignore if you are not meant to be get this email.';

        try {
            send_general_email($request->email, $subject, $message, $receiver_name);
        } catch (\Exception $exp) {
            $notify[] = ['error', strtoupper($config->name) . ' Mail configuration is invalid.'];
            return back()->withNotify($notify);
        }

        $notify[] = ['success', 'You sould receive a test mail at ' . $request->email . ' shortly.'];
        return back()->withNotify($notify);
    }

    public function registered()
    {
        return redirect()->route('user.home');
    }

    function getTrx()
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 12; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
}
