<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
<div id="app"></div>
<script src="https://code.jquery.com/jquery-3.5.0.slim.min.js" integrity="sha256-MlusDLJIP1GRgLrOflUQtshyP0TwT/RHXsI1wWGnQhs=" crossorigin="anonymous"></script>
<script src="{{asset('js/logins.js')}}"></script>

{{--<script src="https://colorlib.com/etc/regform/colorlib-regform-26/js/jquery-3.3.1.min.js" type="cbf824f79e7c9882f50f63ba-text/javascript"></script>--}}
{{--<script src="https://colorlib.com/etc/regform/colorlib-regform-26/js/main.js" type="cbf824f79e7c9882f50f63ba-text/javascript"></script>--}}


<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="cbf824f79e7c9882f50f63ba-text/javascript"></script>
<script type="cbf824f79e7c9882f50f63ba-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onSubmit(token) {
        document.getElementById("register-form").submit();
    }
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="cbf824f79e7c9882f50f63ba-|49" defer=""></script></body>
</html>
