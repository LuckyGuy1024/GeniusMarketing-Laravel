<?php

namespace App\Http\Controllers\Admin;

use App\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{
    public function blogIndex()
    {
        $page_title = 'Blog Post';
        $empty_message = 'No blog post yet.';

        $titles = Frontend::where('key', 'blog.title')->first();

        $blog_posts = Frontend::where('key', 'blog.post')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.blog.index', compact('page_title', 'empty_message', 'blog_posts', 'titles'));
    }

    public function blogNew()
    {
        $page_title = 'New Post';
        return view('admin.frontend.blog.new', compact('page_title'));
    }

    public function blogEdit($id)
    {
        $page_title = 'Edit Post';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.blog.edit', compact('page_title', 'post'));
    }

    public function faqIndex()
    {
        $page_title = 'Faq Post';
        $empty_message = 'No faq post yet.';
        $blog_posts = Frontend::where('key', 'faq.post')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.faq.index', compact('page_title', 'empty_message', 'blog_posts'));
    }

    public function faqNew()
    {
        $page_title = 'New Post';
        return view('admin.frontend.faq.new', compact('page_title'));
    }

    public function faqEdit($id)
    {
        $page_title = 'Edit Post';
        $post = Frontend::findOrFail($id);
        return view('admin.frontend.faq.edit', compact('page_title', 'post'));
    }


    public function seoEdit()
    {
        $page_title = 'SEO Configuration';
        $seo = Frontend::where('key', 'seo')->first();
        if (!$seo) {
            $notify[] = ['error', 'Something went wrong or not functioning properly, contact developer.'];
            return back()->withNotify($notify);
        }
        return view('admin.frontend.seo.edit', compact('page_title', 'seo'));
    }


    public function testimonialIndex()
    {
        $page_title = 'Testimonials';
        $empty_message = 'No testimonials';
        $titles = Frontend::where('key', 'testimonial.title')->first();
        $testimonials = Frontend::where('key', 'testimonial')->latest()->paginate(config('constants.table.default'));
        return view('admin.frontend.testimonial.index', compact('page_title','titles', 'empty_message', 'testimonials'));
    }

    public function testimonialNew()
    {
        $page_title = 'New Testimonial';
        return view('admin.frontend.testimonial.new', compact('page_title'));
    }

    public function testimonialEdit($id)
    {
        $page_title = 'Edit Testimonial';
        $testi = Frontend::findOrFail($id);
        return view('admin.frontend.testimonial.edit', compact('page_title', 'testi'));
    }


    public function bannerIndex()
    {
        $page_title = 'Banners';
        $empty_message = 'No banner';
        $banners = Frontend::where('key', 'banner')->latest()->paginate(config('constants.table.default'));

        return view('admin.frontend.banner.index', compact('page_title', 'empty_message', 'banners'));
    }

    public function bannerNew()
    {
        $page_title = 'New banner';
        return view('admin.frontend.banner.new', compact('page_title'));
    }

    public function bannerEdit($id)
    {
        $page_title = 'Edit banner';
        $banner = Frontend::findOrFail($id);
        return view('admin.frontend.banner.edit', compact('page_title', 'banner'));
    }


    public function socialIndex()
    {
        $page_title = 'Social Icons';
        $empty_message = 'No social icons';
        $socials = Frontend::where('key', 'social.item')->paginate(config('constants.table.default'));
        return view('admin.frontend.social.index', compact('page_title', 'empty_message', 'socials'));
    }

    public function store(Request $request)
    {

        $validation_rule = ['key' => 'required'];

        foreach ($request->except('_token') as $input_field => $val) {
            if ($input_field == 'has_image') {
                $validation_rule['image_input'] = ['required', 'image', new FileTypeValidate('jpeg', 'jpg', 'png')];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
          $request->validate($validation_rule, [], ['image_input' => 'image']);

        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($request->key, $request->image_input)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }

        Frontend::create([
            'key' => $request->key,
            'value' => $request->except('_token', 'key', 'image_input'),
        ]);

        $notify[] = ['success', 'Content has been added.'];
        return back()->withNotify($notify);
    }

    public function update(Request $request, $id)
    {
        foreach ($request->except('_token') as $input_field => $val) {
            if ($request->image_input) {
                $validation_rule['image_input'] = ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])];
                continue;
            }
            $validation_rule[$input_field] = 'required';
        }
        $request->validate($validation_rule, [], ['image_input' => 'image']);

        $content = Frontend::findOrFail($request->id);
        if ($request->hasFile('image_input')) {
            try {
                $request->merge(['image' => $this->store_image($content->key, $request->image_input, $content->value->image)]);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        } else if (isset($content->value->image)) {
            $request->merge(['image' => $content->value->image]);
        }

        $content->update(['value' => $request->except('_token', 'image_input', 'key')]);
        $notify[] = ['success', 'Content has been updated.'];
        return back()->withNotify($notify);
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required']);
        $frontend = Frontend::findOrFail($request->id);
        if (isset($frontend->value->image)) {
            remove_file(config('constants.frontend.team.path') . '/' . $frontend->value->image);
        }
        $frontend->delete();
        $notify[] = ['success', 'Content has been removed.'];
        return back()->withNotify($notify);
    }

    protected function store_image($key, $image, $old_image = null)
    {
        $path = config('constants.frontend.' . $key . '.path');
        $size = config('constants.frontend.' . $key . '.size');
        $thumb = config('constants.frontend.' . $key . '.thumb');
        return upload_image($image, $path, $size, $old_image, $thumb);
    }





    public function serviceIndex()
    {
        $page_title = 'Why Choose us';
        $titles = Frontend::where('key', 'service.title')->first();
        $empty_message = 'No data post yet';
        $services = Frontend::where('key', 'service.item')->paginate(config('constants.table.default'));
        return view('admin.frontend.service.index', compact('page_title', 'empty_message', 'services', 'titles'));
    }

    public function planIndex()
    {
        $page_title = 'Plan Section Title Subtitle';
        $titles = Frontend::where('key', 'plan.title')->first();
        return view('admin.frontend.plan_title', compact('page_title',  'titles'));
    }

    public function howWorkIndex()
    {
        $page_title = 'How It Work';
        $titles = Frontend::where('key', 'howWork.title')->first();
        $empty_message = 'No data post yet';
        $services = Frontend::where('key', 'howWork.item')->paginate(config('constants.table.default'));
        return view('admin.frontend.howWork.index', compact('page_title', 'empty_message', 'services', 'titles'));
    }

    public function footerSection()
    {
        $page_title = 'Footer';
        $titles = Frontend::where('key', 'footer.title')->first();

        return view('admin.frontend.footer_section', compact('page_title', 'titles'));

    }

    public function aboutSection()
    {
        $page_title = 'About';
        $titles = Frontend::where('key', 'about.title')->first();

        return view('admin.frontend.about', compact('page_title', 'titles'));

    }

    public function videoSection()
    {
        $page_title = 'Video Section';

        $video = Frontend::where('key', 'vid.post')->first();

        return view('admin.frontend.video_section', compact('page_title', 'video'));

    }




}
