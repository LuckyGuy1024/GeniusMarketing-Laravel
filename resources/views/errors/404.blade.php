@extends('admin.layouts.master')

@section('content')
<section class="error-section">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 content text-center">
        <img src="{{ asset('assets/images/error-404.png') }}" alt="error-image">
        <h2 class="font-large title">404</h2>
        <span class="sub-title">Page not found</span>
        <a href="{{url('/')}}" class="btn btn-primary btn-lg mt-3">Got back to home</a>
    </div>
</section>
@endsection