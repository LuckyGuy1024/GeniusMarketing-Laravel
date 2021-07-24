<?php

namespace App\Http\Controllers;

use App\Frontend;
use App\GeneralSetting;
use App\Language;
use App\Plan;
use App\Subscriber;
use App\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {

        $data['page_title'] = "Home";

        $frontend = Frontend::where('key', 'blog.title')->OrWhere('key', 'testimonial.title')
            ->orWhere('key', 'service.title')->orWhere('key', 'howWork.title')
            ->orWhere('key', 'about.title') ->orWhere('key', 'vid.post')->orWhere('key', 'plan.title')->get();


        $data['blog_title'] = $frontend->where('key', 'blog.title')->first() ;
        $data['blogs'] = Frontend::where('key', 'blog.post')->latest()->take(3)->get();
        $data['sliders'] = Frontend::where('key', 'banner')->get();

        $data['testimonial_title'] = $frontend->where('key', 'testimonial.title')->first();
        $data['testimonial'] = Frontend::where('key', 'testimonial')->get();
        $data['service_titles'] = $frontend->where('key', 'service.title')->first();
        $data['service'] = Frontend::where('key', 'service.item')->get();
        $data['about'] = $frontend->where('key', 'about.title')->first();
        $data['plans'] = Plan::where('status', 1)->get();
        $data['plan_title'] = $frontend->where('key', 'plan.title')->first();

        $data['how_it_work_title'] = $frontend->where('key', 'howWork.title')->first();
        $data['video_section'] = $frontend->where('key', 'vid.post')->first();

        $data['how_it_work'] = Frontend::where('key', 'howWork.item')->get();
        return view(activeTemplate() . 'home', $data);



    }

    public function faq()
    {
        $data['page_title'] = "faq";
        $data['faqs'] = Frontend::where('key', 'faq.post')->get();
        return view(activeTemplate() . 'faq', $data);

    }

    public function contact()
    {
        $data['page_title'] = "GET IN TOUCH WITH US";
        return view(activeTemplate() . 'contact', $data);

    }


    function sendEmailContact(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'name' => 'required|',
            'message' => 'required|',
        ]);


        $from = $request->email;
        $name = $request->name;
        $message= $request->message;
        $subject= 'Contact mail from '. $request->name;

        $general = GeneralSetting::first();
        $config = $general->mail_config;
        if ($config->name == 'php') {
            send_php_mail($general->contact_email, $from, $name, $subject, $message);
        } else if ($config->name == 'smtp') {
            send_smtp_mail($config, $general->contact_email, $general->sitetitle, $from, $name, $subject, $message);
        } else if ($config->name == 'sendgrid') {
            send_sendgrid_mail($config, $general->contact_email, $general->sitetitle, $from, $name, $subject, $message);
        } else if ($config->name == 'mailjet') {
            send_mailjet_mail($config, $general->contact_email, $general->sitetitle, $from, $name, $subject, $message);
        }



        $notify[] = ['success', 'Mail Send successfully'];
        return back()->withNotify($notify);

    }


    function validUsername(Request $request)
    {
        $user = User::where('username', $request->username)->count();
        return $user > 0 ? response()->json(['success' => false]) : response()->json(['success' => true]);
    }

    function validEmail(Request $request)
    {
        $user = User::where('email', $request->email)->count();
        return $user > 0 ? response()->json(['success' => false]) : response()->json(['success' => true]);
    }


    public function singleBlog($slug, $id)
    {


        $blog = Frontend::where('id', $id)->where('key', 'blog.post')->first();
        $latestBlogs = Frontend::where('id', '!=',  $id)->where('key', 'blog.post')->take('5')->get();

        if ($blog != NULL)
        {

            $page_title = "Details";
            return view(activeTemplate() . 'singleBlog', compact('page_title', 'blog', 'latestBlogs'));


        }
        return redirect('404');

    }


    public function blog()
    {
        $data['page_title'] = 'Latest News';
        $data['blogs'] = Frontend::where('key', 'blog.post')->latest()->paginate(12);
        return view(activeTemplate() . 'blog', $data);
    }



    function subscriberStore(Request $request)

    {
        $this->validate($request, [
            'email' => 'required',
        ]);


        if (filter_var($request->email, FILTER_VALIDATE_EMAIL) == false){
            $notify[] = ['error', 'Please insert valid email address'];
            return back()->withNotify($notify);
        }

        $subs = Subscriber::where('email', $request->email)->count();
        if ($subs == 0) {
            Subscriber::create([
                'email' =>  $request->email
            ]);


            $notify[] = ['success', 'Successfully Subscribed'];
            return back()->withNotify($notify);


        }else{
            $notify[] = ['error', 'Already Subscribed'];
            return back()->withNotify($notify);

        }
    }


    public function changeLang($lang)
    {


        $language = Language::where('code', $lang)->first();
        if (!$language) $lang = 'en';
        session()->put('lang', strtolower($lang));
        return \redirect()->back();
    }


}
