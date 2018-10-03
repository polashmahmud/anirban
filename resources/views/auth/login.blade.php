<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>অনির্বাণ সমিতি | প্রবেশ</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href={{ asset("assets/vendors/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href={{ asset("assets/css/main.css")}} rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href={{ asset("assets/css/pages/auth-light.css")}} rel="stylesheet" />
</head>

<body class="bg-silver-300">
<div class="content">
    <div class="brand">
        <a class="link" href="index.html">অনির্বাণ সমিতি</a>
    </div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <h2 class="login-title">প্রবেশ</h2>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-envelope"></i></div>
                <input class="form-control" id="phone" type="text" name="phone" placeholder="ফোন নম্বর" value="{{ old('phone') }}" required>
                @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="input-group-icon right">
                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="পাসওয়ার্ড">

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        {{--<div class="form-group d-flex justify-content-between">--}}
        {{--<label class="ui-checkbox ui-checkbox-info">--}}
        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>--}}
        {{--<span class="input-span"></span>{{ __('Remember Me') }}</label>--}}
        {{--<a href="{{ route('password.request') }}">--}}
        {{--{{ __('Forgot Your Password?') }}--}}
        {{--</a>--}}
        {{--</div>--}}
        <div class="form-group">
            <button class="btn btn-info btn-block" type="submit">প্রবেশ</button>
        </div>
    </form>
</div>
<!-- BEGIN PAGA BACKDROPS-->
<div class="sidenav-backdrop backdrop"></div>
<div class="preloader-backdrop">
    <div class="page-preloader">Loading</div>
</div>
<!-- END PAGA BACKDROPS-->
<!-- CORE PLUGINS -->
<script src={{ asset("assets/vendors/jquery/dist/jquery.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/popper.js/dist/umd/popper.min.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/bootstrap/dist/js/bootstrap.min.js") }} type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS -->
<script src={{ asset("assets/vendors/jquery-validation/dist/jquery.validate.min.js") }} type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src={{ asset("assets/js/app.js") }} type="text/javascript"></script>
<script src={{ asset("assets/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js") }} type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#phone').mask('880 9999 999 999');
    })
</script>
<!-- PAGE LEVEL SCRIPTS-->
</body>

</html>
