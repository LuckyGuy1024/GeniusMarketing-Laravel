@extends(activeTemplate().'layouts.user-master')

@section('panel')
<div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<a href="{{url('/')}}"><img src="{{ get_image(config('constants.logoIcon.path') .'/logo.png') }}" alt="logo icon"></a>
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>

		    <form action="{{ route('user.login') }}" method="POST" class="login-form" id="recaptchaForm">
                @csrf
			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
                <input type="text" class="form-control input-shadow" name="username" @keyup="checkPassword"  value="{{ old('username') }}" placeholder="@lang('Enter your username')">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
                <input class="form-control input-shadow" type="password" name="password" @keyup="checkPassword" placeholder="@lang('Enter your password')">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <div class="form-group col-6">
			   <div class="icheck-material-white">
                <input type="checkbox" name="remember" id="checkbox">
                <label for="user-checkbox">Remember me</label>
			  </div>
			 </div>
			 <div class="form-group col-6 text-right">
			  <a href="reset-password.html">Reset Password</a>
			 </div>
			</div>
			 <button type="submit" id="recaptcha" class="btn btn-light btn-block">Sign In</button>
			  <div class="text-center mt-3">Sign In With</div>
			  
			 <div class="form-row mt-4">
			  <div class="form-group mb-0 col-6">
			   <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
			 </div>
			 <div class="form-group mb-0 col-6 text-right">
			  <button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
			 </div>
			</div>
			 
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
            <a href="{{ route('user.password.request') }}" class="forget-pass">@lang('Forget password?')</a>
		    <p class="text-warning mb-0">Do not have an account? <a href="{{route('user.register')}}" class="forget-pass">@lang('Sign Up')</a></p>
		  </div>
	     </div>
         <script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
         @php echo recaptcha() @endphp

@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset(activeTemplate(true) .'users/css/signin.css')}}">
@endpush
