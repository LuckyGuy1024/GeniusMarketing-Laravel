@extends('admin.layouts.master')

@section('content')
    <div class="main-container">
        <div class="container-fluid main-body-wrapper">

            @include('admin.partials.sidenav')

            <div class="main-panel-wrapper">

                @include('admin.partials.topnav')

                @include('admin.partials.breadcrumb')

                <div class="content-wrapper">
                    <div class="container-fluid p-0">

                        @yield('panel')

                    </div>
                </div>
                <footer class="footer"></footer>
            </div>
        </div>
    </div>
@endsection