@extends(activeTemplate().'layouts.user-master')

@section('panel')

    <div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-4 col-md-6 col-sm-8">
                    <div class="login-area">
                        <div class="login-header-wrapper text-center">
                            <a href="{{url('/')}}">

                                <img class="logo" src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image">  </a><p class="text-center admin-brand-text">{{ $page_title }}</p>
                        </div>
                        <form action="{{ route('user.password.email') }}" method="POST" class="login-form">
                            @csrf
                            <div class="login-inner-block">
                                <div class="frm-grp">
                                    <label>@lang('Enter Your Email')</label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                                </div>
                            </div>


                            <div class="btn-area text-center">
                                <button type="submit" class="submit-btn">@lang('Send Reset Code')</button>
                            </div>
                            <div class="d-flex mt-5 justify-content-center">
                                <a href="{{ route('user.login') }}" class="forget-pass">@lang('Login Here')</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/signin.css')}}">
@endpush

