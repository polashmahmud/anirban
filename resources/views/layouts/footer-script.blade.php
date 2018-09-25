<script src={{ asset("assets/vendors/jquery/dist/jquery.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/popper.js/dist/umd/popper.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/bootstrap/dist/js/bootstrap.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/metisMenu/dist/metisMenu.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js") }} type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS-->
<script src={{ asset("assets/vendors/chart.js/dist/Chart.min.js") }} type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src={{ asset("assets/js/app.min.js") }} type="text/javascript"></script>

<script>
    @if(session()->has('success'))
    $(function() {
        toastr.success('{!! Session::get('success') !!}', 'Success')
    });
    @endif

    @if(session()->has('info'))
    $(function() {
        toastr.info('{!! Session::get('info') !!}', 'Information')
    });
    @endif

    @if(session()->has('warning'))
    $(function() {
        toastr.warning('{!! Session::get('warning') !!}', 'Warning')
    });
    @endif

    @if(session()->has('error'))
    $(function() {
        toastr.error('{!! Session::get('error') !!}', 'Error!')
    });
    @endif
</script>

@stack('footer-script')