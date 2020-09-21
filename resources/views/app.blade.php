<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <meta name="description" content="">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/img/favicon.ico")}}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/slicknav.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/flaticon.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/themify-icons.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/slick.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/nice-select.css")}}">
    <link rel="stylesheet" href="{{asset("assets/libs/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/libs/summernote/css/summernote-lite.css")}}">

    <link rel="stylesheet" href="{{asset("assets/css/material-bootstrap-wizard.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/wizard.css")}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">


</head>

<body>
<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{asset("assets/img/logo/loder.jpg")}}" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->

<div id="app">

</div>
<!-- Scroll Up -->
<div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>


<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="{{asset("assets/js/vendor/modernizr-3.5.0.min.js")}}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{asset("assets/js/vendor/jquery-1.12.4.min.js")}}"></script>
<script src="{{asset("assets/js/popper.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{asset("assets/js/jquery.slicknav.min.js")}}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{asset("assets/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("assets/js/slick.min.js")}}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{asset("assets/js/wow.min.js")}}"></script>
<script src="{{asset("assets/js/animated.headline.js")}}"></script>
<script src="{{asset("assets/js/jquery.magnific-popup.js")}}"></script>

<!-- Nice-select, sticky -->
<script src="{{asset("assets/js/jquery.nice-select.min.js")}}"></script>
<script src="{{asset("assets/js/jquery.sticky.js")}}"></script>

<!-- contact js -->
<script src="{{asset("assets/js/contact.js")}}"></script>
<script src="{{asset("assets/js/jquery.form.js")}}"></script>
<script src="{{asset("assets/js/jquery.validate.min.js")}}"></script>
<script src="{{asset("assets/js/mail-script.js")}}"></script>
<script src="{{asset("assets/js/jquery.ajaxchimp.min.js")}}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{asset("assets/js/plugins.js")}}"></script>
<script src="{{asset("assets/js/jquery.bootstrap-wizard.js")}}"></script>
<script src="{{asset("assets/js/material-bootstrap-wizard.js")}}"></script>
<script src="{{asset("assets/js/main.js")}}"></script>
<script src="{{asset("assets/libs/summernote/js/summernote-lite.js")}}"></script>
<script src="{{asset("assets/libs/select2/js/select2.min.js")}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
<script>
    const user = {!! json_encode($user->toArray()) !!};
    const printdate = "{!! \Carbon\Carbon::now()->format('d/m/Y H:i:s', 'GST+0') !!}";
</script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
