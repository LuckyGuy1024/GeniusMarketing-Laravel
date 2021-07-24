@extends(activeTemplate().'layouts.user-master')

@section('panel')


    <div class="signin-section pt-5" style="background-image: url('./assets/images/login.png');">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-4 col-md-6 col-sm-8">
                    <div class="login-area">
                        <div class="login-header-wrapper text-center">
                        <a href="{{url('/')}}">

                         <img class="logo" src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="image">  </a>

                            <p class="text-center admin-brand-text">{{ $page_title }}</p>
                        </div>
                        <form action="{{ route('user.password.verify-code') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="login-inner-block">

                                <div class="frm-grp">
                                    <h5 class="col-md-12 mb-3 text-center">@lang('Verification Code')</h5>
                                    <input type="text" id="pincode-input" name="code">
                                </div>

                                <div class="btn-area text-center">
                                    <button type="submit" class="submit-btn">@lang('Verify Code')</button>
                                </div>
                                <div class="d-flex mt-5 justify-content-center">
                                    <a href="{{ route('user.password.request') }}" class="forget-pass">@lang('Try to send again')</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection



@push('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/signin.css')}}"/>
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/bootstrap-pincode-input.css')}}"/>
@endpush

@push('script-lib')
    <script src="{{asset(activeTemplate(true) .'users/js/bootstrap-pincode-input.js')}}"></script>
@endpush

@push('style')
    <style>

        .pincode-input-container{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .pincode-input-container .pincode-input-text {
            margin-left: 5px;
            text-align: center;
            font-weight: 600;
            font-size: 18px;
            background: #00000030;
            border: 1px solid #6670ec;
            color: #d4d4d4;
        }
        .login-area .login-form .frm-grp input {
            padding:inherit;

        }
        .pincode-input-text, .form-control.pincode-input-text {
            width: 50px;
            height: 60px !important;
        }
    </style>
@endpush

@push('script')
    <script>
        $('#pincode-input').pincodeInput({
            inputs:6,
            placeholder:"- - - - - -",
            hidedigits:false
        });
    </script>
@endpush
