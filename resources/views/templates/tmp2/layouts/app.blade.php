@extends(activeTemplate().'layouts.user-master')

@section('panel')
<div id="wrapper">
  @include(activeTemplate().'partials.sidenav')
  @include(activeTemplate().'partials.topnav')
  <div class="clearfix"></div>
  <div class="content-wrapper">
  <div class="container-fluid">
          
  @yield('content')
  <!--start overlay-->
  <div class="overlay toggle-menu"></div>
  <!--end overlay-->
  </div>
  <!-- End container-fluid-->

  </div><!--End content-wrapper-->
  <!--Start Back To Top Button-->
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
  <!--End Back To Top Button-->

  <!--Start footer-->
  <footer class="footer"></footer>
  <!--End footer-->
            
</div><!--End wrapper-->
@endsection