@extends('admin.layouts.master')

@section('content')
<div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
        <div class="col-xl-4 col-md-6 col-sm-8">
            <div class="login-area">
                <div class="login-header-wrapper text-center">
                   <a href="{{url('/')}}"> <img class="logo" src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image"> </a>
                    <p class="text-center admin-brand-text">Admin Pannel</p>
                </div>
                <form action="{{ route('admin.login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="login-inner-block">
                        <div class="frm-grp">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter your username">
                        </div>
                        <div class="frm-grp">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter your password">
                        </div>
                    </div>
                    <div class="d-flex mt-3 justify-content-between">
                        <div class="frm-group">
                            <input type="checkbox" name="remember" id="checkbox">
                            <label for="checkbox">Remember Me</label>
                        </div>
                        <a href="{{ route('admin.password.reset') }}" class="forget-pass">Forget password?</a>
                    </div>
                    <div class="btn-area text-center">
                    <button type="submit" class="submit-btn">Login now</button>
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