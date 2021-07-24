<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $general->sitename(__($page_title) ?? '') }}</title>
    <link rel="shortcut icon" type="image/png"
        href="{{ get_image(config('constants.logoIcon.path') . '/favicon.png') }}" />
    <!-- loader-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/pace.min.css'}}"/>
    <script src="{{ asset(activeTemplate(true)) . '/users/js/pace.min.js'}}"></script>
    <!-- Vector CSS -->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/plugins/vectormap/jquery-jvectormap-2.0.2.css'}}"/>
    <!-- simplebar CSS-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/plugins/simplebar/css/simplebar.css'}}"/>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/bootstrap.min.css'}}"/>
    <!-- animate CSS-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/animate.css'}}" type="text/css"/>
    <!-- Icons CSS-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/icons.css'}}" type="text/css"/>
    <!-- Sidebar CSS-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/sidebar-menu.css'}}"/>
    <!-- Custom Style-->
    <link rel="stylesheet" href="{{ asset(activeTemplate(true)) . '/users/css/app-style.css'}}"/>


    {{-- <!-- date picker css -->
    <link rel="stylesheet" href="{{ asset('assets/datepicker/css/datepicker.css') }}">
    <!-- date picker ends here -->
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    <!-- <link href='datepicker/css/datepicker.css' rel='stylesheet'> --> --}}
   
    
</head>

<body class="bg-theme bg-theme3">
    @yield('panel')


@if (Request::is('*/dashboard'))
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

@stack('script-lib')

<!-- Load toast -->
@include('partials.notify')

<script src="{{asset(activeTemplate(true) .'users/js/nicEdit.js')}}"></script>
{{-- LOAD NIC EDIT --}}
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        $(".nicEdit").each(function (index) {
            $(this).attr("id", "nicEditor" + index);
            new nicEditor({fullPanel: true}).panelInstance('nicEditor' + index, {hasPanel: true});
        });
    });
</script>

<script>$('[data-toggle=tooltip]').tooltip();</script>

<!-- date picker start here -->
<script src="{{asset('assets/datepicker/js/bootstrap-datepicker2.js')}}"></script>
     <script type="text/javascript">
            $(document).ready(function (e) {
                //$('[data-toggle=confirmation]').confirmation();
                $.fn.datepicker.defaults.format = "yyyy-mm-dd";

                var today = new Date();

                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();

                if (day < 10) {
                    day = "0" + day;
                }

                if (month < 10) {
                    month = "0" + month;
                }

                var current_date = year + "-" + month + "-" + day;

                $("#current_date").val(current_date);

            });

            $(function () {
                $('#current_date').datepicker({

                    autoclose: true,

                });
            });


        </script>
<!-- date picker ends here -->

@stack('script')
@stack('js')
</body>
</html>
