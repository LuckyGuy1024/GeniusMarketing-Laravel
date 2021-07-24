@extends(activeTemplate().'layouts.user-master')

@section('panel')

    <div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-4 col-md-6 col-sm-8">
                    <div class="login-area">
                        <div class="login-header-wrapper text-center">
                            <a href="{{url('/')}}">

                                <img class="logo" src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image">  </a>  <p class="text-center admin-brand-text">Reset Password</p>
                        </div>
                        <form action="{{ route('user.password.updates') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="login-inner-block">
                                <div class="frm-grp">
                                    <label>@lang('New Password')</label>
                                    <input type="password" name="password" required>
                                </div>
                                <div class="frm-grp">
                                    <label>@lang('Retype New Password')</label>
                                    <input type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="btn-area">
                                <button type="submit" class="submit-btn">@lang('Reset Password')</button>
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
