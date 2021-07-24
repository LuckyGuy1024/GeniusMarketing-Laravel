<?php

use App\GeneralSetting;

function get_image($image, $clean = '')
{
    return file_exists($image) && is_file($image) ? asset($image) . $clean : asset(config('constants.image.default'));
}


function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}


function description_shortener($string, $length = null)
{
    if (empty($length)) $length = config('constants.stringLimit.default');
    return Illuminate\Support\Str::limit($string, $length);
}


function sidenav_active($routename, $class = 'active open')
{
    if (is_array($routename)) {
        foreach ($routename as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routename)) {
        return $class;
    }
}


function show_datetime($date, $format = 'd M, Y h:ia')
{

    return \Carbon\Carbon::parse($date)->format($format);
}


function shortcode_replacer($shortcode, $replace_with, $template_string)
{

    return str_replace($shortcode, $replace_with, $template_string);
}


if (!function_exists('month_arr')) {

    function month_arr() {
        return [
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        ];
    }

}





function verification_code($length)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }
    return random_int($min, $max);
}


function site_precision()
{
    return config('constants.currency.precision.' . strtolower(config('constants.currency.base')));
}

function formatter_money($money, $currency = null)
{
    if (!$currency) $currency = config('constants.currency.base');
    $money = round($money, config('constants.currency.precision.' . strtolower($currency)));
    return $money;
}


function upload_image($file, $location, $size = null, $old = null, $thumb = null)
{
    $path = make_directory($location);
    if (!$path) throw new Exception('File could not been created.');

    if (!empty($old)) {
        remove_file($location . '/' . $old);
        remove_file($location . '/thumb_' . $old);
    }

    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();

    $image = Image::make($file);
    if (!empty($size)) {
        $size = explode('x', $size);
        $image->resize($size[0], $size[1]);
    }
    $image->save($location . '/' . $filename);

    if (!empty($thumb)) {

        $thumb = explode('x', $thumb);
        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
    }

    return $filename;
}


function make_directory($path)
{
    if (file_exists($path)) return true;
    return mkdir($path, 0755, true);
}


function remove_file($path)
{
    return file_exists($path) && is_file($path) ? @unlink($path) : false;
}

function send_general_email($email, $subject, $message, $receiver_name = '')
{
    $general = GeneralSetting::first();

    if ($general->en != 1 || !$general->efrom) {
        return;
    }

    $message = shortcode_replacer("{{message}}", $message, $general->etemp);
    $message = shortcode_replacer("{{name}}", $receiver_name, $message);
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($email, $receiver_name, $general->efrom, $subject, $message);
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $email, $receiver_name, $general->efrom, $general->sitetitle, $subject, $message);
    }
}

function send_email($user, $type, $shortcodes = [])
{
    $general = GeneralSetting::first();
    $email_template = \App\EmailTemplate::where('act', $type)->where('email_status', 1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }

    $message = shortcode_replacer("{{name}}", $user->username, $general->etemp);
    $message = shortcode_replacer("{{message}}", $email_template->email_body, $message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortcodes as $code => $value) {
        $message = shortcode_replacer('{{' . $code . '}}', $value, $message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($user->email, $user->username, $general->efrom, $email_template->subj, $message);
    } else if ($config->name == 'smtp') {
        send_smtp_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'sendgrid') {
        send_sendgrid_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    } else if ($config->name == 'mailjet') {
        send_mailjet_mail($config, $user->email, $user->username, $general->efrom, $general->sitetitle, $email_template->subj, $message);
    }
}

function send_php_mail($receiver_email, $receiver_name, $sender_email, $subject, $message)
{
    $general = GeneralSetting::first();
    $headers = "From: $general->sitename <$sender_email> \r\n";
    $headers .= "Reply-To: $receiver_name <$receiver_email> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email, $subject, $message, $headers);
}

function send_smtp_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    $f = fsockopen($config->host, $config->port);
    if ($f !== false) {
        $res = fread($f, 1024);
        if (strlen($res) > 0 && strpos($res, '220') === 0) {
            $mail_val = [
                'send_to_name' => $receiver_name,
                'send_to' => $receiver_email,
                'email_from' => $sender_email,
                'email_from_name' => $sender_name,
                'subject' => $subject,
            ];
            Config::set('mail.driver', $config->driver);
            Config::set('mail.from', $config->username);
            Config::set('mail.name', $sender_name);
            Config::set('mail.host', $config->host);
            Config::set('mail.port', $config->port);
            Config::set('mail.username', $config->username);
            Config::set('mail.password', $config->password);
            Config::set('mail.encryption', $config->enc);
            $xx = Mail::send('partials.email', ['body' => $message], function ($send) use ($mail_val) {
                $send->from($mail_val['email_from'], $mail_val['email_from_name']);
                $send->replyto($mail_val['email_from'], $mail_val['email_from_name']);
                $send->to($mail_val['send_to'], $mail_val['send_to_name'])->subject($mail_val['subject']);
            });
        }
    }
}

function send_sendgrid_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    require 'core/app/Http/Helpers/Lib/Sendgrid/vendor/autoload.php';

    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom($sender_email, $sender_name);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email, $receiver_name);
    $sendgridMail->addContent("text/html", $message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        // echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}

function send_mailjet_mail($config, $receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    require 'core/app/Http/Helpers/Lib/Mailjet/vendor/autoload.php';
    $mj = new \Mailjet\Client($config->public_key, $config->secret_key, true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $sender_email,
                    'Name' => $sender_name,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
}


function send_sms($user, $type, $shortcodes = [])
{
    $general = GeneralSetting::first(['sn', 'smsapi']);
    $sms_template = \App\SmsTemplate::where('act', $type)->where('sms_status', 1)->first();
    if ($general->sn == 1 && $sms_template) {
        $template = $sms_template->sms_body;
        foreach ($shortcodes as $code => $value) {
            $template = shortcode_replacer('{{' . $code . '}}', $value, $template);
        }
        $template = urlencode($template);
        $message = shortcode_replacer("{{number}}", $user->mobile, $general->smsapi);
        $message = shortcode_replacer("{{message}}", $template, $message);
        $result = @file_get_contents($message);
    }
}

function activeTemplate($asset = false)
{
    $template = '';
    if (session()->has('active_template')) {
        $template = session('active_template');
    } else {
        $gs = GeneralSetting::first(['active_template']);
        $template = $gs->active_template;
        session()->put(['active_template' => $template]);
    }
    if ($asset) return 'assets/templates/' . $template . '/';
    return 'templates.' . $template . '.';
}

function removeSessions()
{
    session()->forget('active_template');
}

function recaptcha()
{
    $recaptcha = \App\Plugin::where('act', 'google-recaptcha3')->where('status', 1)->first();
    return $recaptcha ? $recaptcha->generateScript() : '';
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


function remove_element($array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function cryptoQR($wallet, $amount, $crypto = null)
{

    $varb = $wallet . "?amount=" . $amount;
    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
}


function curlContent($url)
{

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);

    return $result;
}


if (!function_exists('last_visited_url')) {
    function last_visited_url($url)
    {
        $a = explode('/', $url);
        $count = count($a);
        if (isset($a[$count - 1])) {
            if ($a[$count - 1] == "") {
                return "index";
            } else {
                if (is_numeric($a[$count - 1])) {
                    return "index";
                }
                return $a[$count - 1];
            }
        } else {
            return "index";
        }
    }
}

function showBelow($id)
{
    $arr = array();
    $under_ref = \App\User::where('position_id', $id)->get();
    foreach ($under_ref as $u) {
        array_push($arr, $u->id);
    }
    return $arr;
}


function showUserLevel($id, $level)
{

    $gnl = GeneralSetting::first();

     $myref = showBelow($id);
     // print_r(  $myref);
    $nxt = $myref;
    for ($i = 1; $i < $level; $i++) {
        $nxt = array();
        foreach ($myref as $uu) {
            $n = showBelow($uu);
            $nxt = array_merge($nxt, $n);
        }
        $myref = $nxt;
    }
$totalAmount=0;
 // print_r ($myref);
    foreach ($nxt as $uu) {

        $data = \App\User::where('id', $uu)->first();
        $pos = \App\User::where('id', $data->position_id)->first();
        $ref = \App\User::where('id', $data->ref_id)->first();
        // return $ref;
        echo " <tr>";
        echo " <td>$data->username</td>";
        echo '<td>' . $pos->username . '</td>';
        if($ref){
        echo '<td>' . $ref->username . '</td>';
             }
    $totalAmount=$totalAmount+ round($data->balance, 4);

        echo '<td>' . $gnl->cur_sym . ' ' . round($data->balance, 4) . '</td>';
        echo "</tr>";
    }
                echo "<tr><td colspan='4'>Total Amount : <b>".$totalAmount."</b></td></tr>";

}

function showUserLevelDate($id,$level,$date)
{
    // return $date."  ".$id  ;

    $gnl = GeneralSetting::first();

     $myref = showBelow($id);
     // print_r(  $myref);
     // $level=5;
    $nxt = $myref;
    for ($i = 1; $i < $level; $i++) {
        $nxt = array();
        foreach ($myref as $uu) {
            $n = showBelow($uu);
            $nxt = array_merge($nxt, $n);
        }
        $myref = $nxt;
    }

    // return $myref;

 // print_r ($myref);
    $col="`id`, `ref_id`, `plan_id`, `position`, `position_id`, `firstname`, `lastname`, `username`, `ref_link`, `email`, `mobile`, `balance`, `password`, `image`, `address`, `country`, `status`, `ev`, `sv`, `ver_code`, `ver_code_send_at`, `ts`, `tv`, `tsc`, `bank_ac_name`, `bank_ac_no`, `bank_ac`, `ctm`, `nic`, `remember_token`, date_format(created_at,'%Y-%m-%d') as created_at, `updated_at`";
    $totalAmount=0;
    foreach ($nxt as $uu) {

        $data = \App\User::selectRaw($col)
        ->where('id', $uu)
        ->where('created_at', 'like',"%$date%")
        ->first();
$pos ="";
$ref ="";
if($data){
        $pos = \App\User::selectRaw($col)
        ->where('id', $data->position_id)
        ->first();

          $ref = \App\User::selectRaw($col)
        ->where('id', $data->ref_id)
        ->first();

      

        // return $ref;
        echo " <tr>";
        echo " <td>$data->username</td>";
           if($pos){
        echo '<td>' . $pos->username . '</td>';
              }
        if($ref){
        echo '<td>' . $ref->username . '</td>';
             }
             $totalAmount=$totalAmount+ round($data->balance, 4);
        echo '<td>' . $gnl->cur_sym . ' ' . round($data->balance, 4) . '</td>';
        echo "</tr>";
        }

    }
            echo "<tr><td colspan='4'>Total Amount : <b>".$totalAmount."</b></td></tr>";


}





