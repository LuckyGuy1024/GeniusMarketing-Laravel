@extends('admin.layouts.master')

@section('content')
    <div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
            <div class="col-xl-4 col-md-6 col-sm-8">
                <div class="login-area">
                <div class="login-header-wrapper text-center">
                    <img class="logo" src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image">
                    <p class="text-center admin-brand-text">Reset Password</p>
                </div>
                <form action="{{ route('admin.password.change') }}" method="POST" class="login-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="login-inner-block">
                    <div class="frm-grp">
                        <label>New Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="frm-grp">
                        <label>Retype New Password</label>
                        <input type="password" name="password_confirmation" required> 
                    </div>
                    </div>
                    <div class="btn-area">
                        <button type="submit" class="submit-btn">Reset Password</button>
                    </div>
                    <div class="d-flex mt-5 justify-content-center">
                        <a href="{{ route('admin.login') }}" class="forget-pass">Login Here</a>
                    </div>
                </form>
                </div>
            </div>
            
            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/signin.css') }}">
@endpush