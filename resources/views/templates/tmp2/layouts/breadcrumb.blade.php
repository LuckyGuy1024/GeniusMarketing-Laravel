@if ($page_title = "Dashboard")
    bab
@else
   <!-- Bootstrap core JavaScript-->
<script src="{{ asset(activeTemplate(true)) . '/users/js/jquery.min.js'}}"></script>
<script src="{{ asset(activeTemplate(true)) . '/users/js/popper.min.js'}}"></script>
<script src="{{ asset(activeTemplate(true)) . '/users/js/bootstrap.min.js'}}"></script>
<!-- simplebar js -->
<script src="{{ asset(activeTemplate(true)) . '/users/plugins/simplebar/js/simplebar.js'}}"></script>
<!-- sidebar-menu js -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/sidebar-menu.js'}}"></script>
<!-- loader scripts -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/jquery.loading-indicator.js'}}"></script>
<!-- Custom scripts -->
<script src="{{ asset(activeTemplate(true)) . '/users/js/app-script.js'}}"></script>
<!-- Chart js -->

<script src="{{ asset(activeTemplate(true)) . '/users/plugins/Chart.js/Chart.min.js'}}"></script> 
@endif
