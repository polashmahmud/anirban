<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="fixed-navbar">
<div class="page-wrapper">
    <!-- START HEADER-->
    @include('layouts.header')
    <!-- END HEADER-->
    <!-- START SIDEBAR-->
    @include('layouts.sidebar')
    <!-- END SIDEBAR-->
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
            @include('error')
            @yield('content')
        </div>
        <!-- END PAGE CONTENT-->
        @include('layouts.footer')
    </div>
</div>
<!-- BEGIN THEME CONFIG PANEL-->
@include('layouts.theme-config')
<!-- END THEME CONFIG PANEL-->
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS-->
@include('layouts.footer-script')
<!-- PAGE LEVEL SCRIPTS-->
</body>

</html>