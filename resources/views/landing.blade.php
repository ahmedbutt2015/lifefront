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

    {{--    <link rel="stylesheet" href="{{asset("assets/css/material-bootstrap-wizard.css")}}">--}}
    {{--    <link rel="stylesheet" href="{{asset("assets/css/wizard.css")}}">--}}

    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">
    {{--    <link rel="stylesheet" href="{{asset("css/app.css")}}">--}}
    <style>
        .alert {
            position: fixed;
            bottom:   0;
            z-index:  99;
            width: 100%;
            margin: 0;
            font-size: 1.4rem;
        }
    </style>

</head>

<body>


@if(session()->has('msg'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-1 col-md-1">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        @guest
                                            <li><a href="/login">Login</a></li>@endguest

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <a href="{{ auth()->check() ? "/account" : "/register" }}" class="btn header-btn">
                                    {{auth()->check() ? "Account" : "Register"}}
                                </a>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>

    <!-- Slider Area Start-->
    <div class="slider-area slider-bg ">
        <div class="slider-active dot-style">
            <div class="single-slider d-flex align-items-center slider-height ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-9 ">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".3s">Live the life you have always wished for </h1>
                                <p data-animation="fadeInLeft" data-delay=".6s">The simulation life game made for everyone and enjoy a virtual life</p>
                                <!-- Slider btn -->
                                <div class="slider-btns">
                                    <!-- Hero-btn -->
                                    <a data-animation="fadeInLeft" data-delay="1s" href="industries.html" class="btn radius-btn">get started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero__img d-none d-lg-block f-right">
                                <img src="assets/img/hero/hero_right.png" alt="" data-animation="fadeInRight" data-delay="1s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="single-slider d-flex align-items-center slider-height ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-9 ">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".3s">Hosting digital technology web solution! </h1>
                                <p data-animation="fadeInLeft" data-delay=".6s">Automated Control Panel with Up to 50% Off Hosting Starting from $2.50/Month.</p>
                                <!-- Slider btn -->
                                <div class="slider-btns">
                                    <!-- Hero-btn -->
                                    <a data-animation="fadeInLeft" data-delay="1s" href="industries.html" class="btn radius-btn">get started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero__img d-none d-lg-block f-right">
                                <img src="assets/img/hero/hero_right.png" alt="" data-animation="fadeInRight" data-delay="1.5s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider d-flex align-items-center slider-height ">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-9 ">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".3s">Hosting digital technology web solution! </h1>
                                <p data-animation="fadeInLeft" data-delay=".6s">Automated Control Panel with Up to 50% Off Hosting Starting from $2.50/Month.</p>
                                <!-- Slider btn -->
                                <div class="slider-btns">
                                    <!-- Hero-btn -->
                                    <a data-animation="fadeInLeft" data-delay="1s" href="/register" class="btn radius-btn">get started</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="hero__img d-none d-lg-block f-right">
                                <img src="assets/img/hero/hero_right.png" alt="" data-animation="fadeInRight" data-delay="1.5s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Shape -->
        <div class="slider-shape d-none d-lg-block">
            <img class="slider-shape1" src="assets/img/hero/top-left-shape.png" alt="">
            <img class="slider-shape2" src="assets/img/hero/right-top-shape.png" alt="">
            <img class="slider-shape3" src="assets/img/hero/left-botom-shape.png" alt="">
        </div>
        <!-- slider Social -->
        <div class="slider-social d-none d-md-block">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fas fa-globe"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>

    </div>
    <!-- Slider Area End -->
    <!--Services Area Start -->
    {{--<div class="services-area section-padding30 fix">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-100">
                        <span>Oue Best Services</span>
                        <h2>What we have for you</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-wrapper mb-50">
                        <div class="single-services">
                            <div class="services-icon">
                                <span class="flaticon-server"></span>
                            </div>
                            <div class="services-cap">
                                <h3><a href="services.html">Shared Hosting</a></h3>
                                <p>Hunky dory barney fannaround up the duff no biggie loo cup of tea jolly good ruddy!</p>
                                <a href="services.html" class="get-btn"><i class="ti-arrow-right"></i> get started</a>
                            </div>
                        </div>
                        <div class="services-shape">
                            <span>.01</span>
                            <img src="assets/img/gallery/shape-services.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-wrapper mb-50">
                        <div class="single-services">
                            <div class="services-icon">
                                <span class="flaticon-green"></span>
                            </div>
                            <div class="services-cap">
                                <h3><a href="services.html">Reseller Hosting</a></h3>
                                <p>Hunky dory barney fannaround up the duff no biggie loo cup of tea jolly good ruddy!</p>
                                <a href="services.html" class="get-btn"><i class="ti-arrow-right"></i> get started</a>
                            </div>
                        </div>
                        <div class="services-shape">
                            <span>.02</span>
                            <img src="assets/img/gallery/shape-services.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="services-wrapper mb-50">
                        <div class="single-services">
                            <div class="services-icon">
                                <span class="flaticon-servers"></span>
                            </div>
                            <div class="services-cap">
                                <h3><a href="services.html">Cloud Hosting</a></h3>
                                <p>Hunky dory barney fannaround up the duff no biggie loo cup of tea jolly good ruddy!</p>
                                <a href="services.html" class="get-btn"><i class="ti-arrow-right"></i> get started</a>
                            </div>
                        </div>
                        <div class="services-shape">
                            <span>.03</span>
                            <img src="assets/img/gallery/shape-services.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services Area End -->
    <!-- Search domain Start -->
    <section class="search-domain-area section-bg pt-140 pb-140" data-background="assets/img/gallery/section_bg02.jpg">
        <div class="container">
            <div class="row align-items-end mb-80">
                <div class="col-xl-4">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2">
                        <span>Get your domain</span>
                        <h2>Search domain you want</h2>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Search Box -->
                    <form action="#" class="search-box">
                        <div class="input-form">
                            <input type="text" placeholder="Search your domain name here">
                        </div>
                        <div class="select-form">
                            <div class="select-itms">
                                <select name="select" id="select1">
                                    <option value="">.com</option>
                                    <option value="">.bd</option>
                                    <option value="">.edu</option>
                                    <option value="">.gov</option>
                                    <option value="">.us</option>
                                    <option value="">.uk</option>
                                    <option value="">.pk</option>
                                    <option value="">.org</option>
                                    <option value="">.live</option>
                                    <option value="">.net</option>
                                </select>
                            </div>
                        </div>
                        <div class="search-form">
                            <a href="#">search now</a>
                        </div>
                    </form>
                    <!-- Search Box End-->
                </div>
            </div>
            <!-- Domain List -->
            <div class="row">
                <div class="domain-list">
                    <div class="single-domain">
                        <span>.com</span>
                        <p>$3.99/Year</p>
                    </div>
                    <div class="single-domain">
                        <span>.net</span>
                        <p>$2.99/Year</p>
                    </div>
                    <div class="single-domain">
                        <span>.com</span>
                        <p>$3.99/Year</p>
                    </div>
                    <div class="single-domain">
                        <span>.co</span>
                        <p>$5.99/Year</p>
                    </div>
                    <div class="single-domain">
                        <span>.org</span>
                        <p>$2.99/Year</p>
                    </div>
                    <div class="single-domain">
                        <span>.live</span>
                        <p>$1.99/Year</p>
                    </div>
                </div>
            </div>
            <!-- Domain List  End-->
        </div>
    </section>
    <!-- Search domain End -->
    <!--All startups Start -->
    <section class="all-starups-area section-padding2">
        <!-- left Contents -->
        <div class="starups">
            <div class="starups-details">
                <!-- Section Tittle -->
                <div class="section-tittle section-tittle3">
                    <span>Get your domain</span>
                    <h2>We are with you every step of the way</h2>
                </div>
                <!-- details caption -->
                <div class="details-caption">
                    <p>Cnsectetur adipisicing cvbelit, sxced dbeo eiucdsmod tempor incididunt ut labore egsfgt dolore magna aliqua. Ut encim ad minim veniam, quis nostrud exercitation ulclamco laboris nisi ufgut aliquip edgx ebrha.</p>
                    <p>Cnsectetur adipisicing cvbelit, sxced dbeo eiucdsmod tempor incididunt ut labore egsfgt folorem.</p>
                </div>
                <a href="#" class="btn">get started</a>
            </div>
        </div>
        <!--Right Contents  -->
        <div class="starups-img">
            <img src="assets/img/gallery/visit_bg.jpg" alt="">
        </div>
    </section>
    <!--All startups End -->
    <!-- work company Start-->
    <section class="work-company">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle3">
                        <span>Get your domain</span>
                        <h2>We are with you every step of the way</h2>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="logo-area">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand2.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand3.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand4.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand5.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo">
                                    <img src="assets/img/gallery/cisco_brand6.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- work company End-->
    <!-- Our pricing Start -->
    <div class="our-pricing-area section-padding30 fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- First Tab -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="single-pricing mb-30">
                                <div class="pricing-caption text-center">
                                    <div class="procing-logo">
                                        <img src="assets/img/icon/roket.png" alt="">
                                    </div>
                                    <span>$ 05.00</span>
                                    <div class="pricing-listing">
                                        <ul>
                                            <li>Increase traffic 50%</li>
                                            <li>Social Media Marketing</li>
                                            <li>10 Free Optimization</li>
                                            <li>24/7 support</li>
                                        </ul>
                                    </div>
                                    <a href="#" class="btn white-btn">Get the plan</a>
                                </div>
                                <!-- pricing Shape -->
                                <div class="pricing-shape">
                                    <img class="pricing1" src="assets/img/gallery/procing-shape1.png" alt="">
                                    <img class="pricing2" src="assets/img/gallery/procing-shape2.png" alt="">
                                </div>
                            </div>
                        </div>
                        <!-- Second Tab -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="single-pricing  mb-30">
                                <div class="pricing-caption text-center">
                                    <div class="procing-logo">
                                        <img src="assets/img/icon/roket.png" alt="">
                                    </div>
                                    <span>$ 05.00</span>
                                    <div class="pricing-listing">
                                        <ul>
                                            <li>Increase traffic 50%</li>
                                            <li>Social Media Marketing</li>
                                            <li>10 Free Optimization</li>
                                            <li>24/7 support</li>
                                        </ul>
                                    </div>
                                    <a href="#" class="btn white-btn">Get the plan</a>
                                </div>
                                <!-- pricing Shape -->
                                <div class="pricing-shape">
                                    <img class="pricing1" src="assets/img/gallery/procing-shape1.png" alt="">
                                    <img class="pricing2" src="assets/img/gallery/procing-shape2.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pricing-caption -->
                <div class="col-lg-6 col-md-6">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle3">
                        <span>Oue Best Services</span>
                        <h2>Our pricing</h2>
                        <p class="pt-20 pb-40">Cnsectetur adipisicing cvbelit, sxced dbeo eiucdsmod tempor incididunt ut labore egsfgt dolore magna aliqua. Ut encim ad minim veniam, quis nostrud exercitation ulclamco laboris nisi ufgut aliquip edgx ebrha.</p>
                    </div>
                    <!-- Tab Button -->
                    <div class="pricing-button">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Monthly</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Yearly</a>
                            </div>
                        </nav>
                    </div>
                    <!-- End Tab Button -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our pricing End -->
    <!-- Testimonial Start -->
    <div class="testimonial-area testimonial-padding">
        <div class="container ">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-7">
                    <div class="h1-testimonial-active">
                        <!-- Single Testimonial -->
                        <div class="single-testimonial">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <!-- founder -->
                                <div class="testimonial-founder d-flex align-items-center mb-30">
                                    <div class="founder-img">
                                        <img src="assets/img/testmonial/Homepage_testi.png" alt="">
                                    </div>
                                    <div class="founder-text">
                                        <span>Jahon Ann</span>
                                        <p>CEO, Colorlib</p>
                                    </div>
                                </div>
                                <div class="testimonial-top-cap">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrice.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Testimonial -->
                        <div class="single-testimonial">
                            <!-- Testimonial Content -->
                            <div class="testimonial-caption ">
                                <!-- founder -->
                                <div class="testimonial-founder d-flex align-items-center mb-30">
                                    <div class="founder-img">
                                        <img src="assets/img/testmonial/Homepage_testi.png" alt="">
                                    </div>
                                    <div class="founder-text">
                                        <span>Jahon Ann</span>
                                        <p>CEO, Colorlib</p>
                                    </div>
                                </div>
                                <div class="testimonial-top-cap">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrice.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="testimonial-banner">
                        <img src="assets/img/gallery/testimonail.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Shape -->
        <img src="assets/img/testmonial/shape-testimonial.png" class="testimonial-shape d-none d-lg-block" alt="">
    </div>
    <!-- Testimonial End -->
    <!-- Support Area Start -->
    <section class="support-area section-bg pt-150 pb-150" data-background="assets/img/gallery/section_bg03.jpg">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5">
                    <div class="support-caption">
                        <!-- Section Tittle -->
                        <div class="section-tittle section-tittle5">
                            <span>Get your domain</span>
                            <h2>24/7 Expert Support</h2>
                            <p class="support-details">Our expert team is always on hand to help answer your questions, get you started, and grow your presence online. You can call, chat or email us any time!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="support-number">
                        <!-- Single contact -->
                        <div class="single-contact text-center">
                            <div class="contact-icon">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="contact-number">
                                <span>+1 514 648</span>
                            </div>
                        </div>
                        <!-- Single contact -->
                        <div class="single-contact text-center">
                            <div class="contact-icon">
                                <i class="far fa-comment"></i>
                            </div>
                            <div class="contact-number">
                                <span>Text Us</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Support Area End -->
    <!-- Blog Area Start -->
    <section class="blogs-area section-padding30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-80">
                        <span>Our Blog</span>
                        <h2>Our latest news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-blogs mb-100">
                        <div class="blog-img">
                            <img src="assets/img/gallery/blog1.png" alt="">
                        </div>
                        <div class="blog-cap">
                            <span class="color1">23 Dec, 2020</span>
                            <h4><a href="#">Addiction When Gambling Becomes</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blogs mb-100">
                        <div class="blog-img">
                            <img src="assets/img/gallery/blog2.png" alt="">
                        </div>
                        <div class="blog-cap">
                            <span class="color1">23 Dec, 2020</span>
                            <h4><a href="#">Addiction When Gambling Becomes</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blogs mb-100">
                        <div class="blog-img">
                            <img src="assets/img/gallery/blog3.png" alt="">
                        </div>
                        <div class="blog-cap">
                            <span class="color1">23 Dec, 2020</span>
                            <h4><a href="#">Addiction When Gambling Becomes</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
--}}
</main>
<footer>
    <!-- Footer Start-->
    <div class="footer-area">
        <div class="container">
            <div class="footer-top footer-padding">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>All packages</h4>
                                <ul>
                                    <li><a href="#">Package-1</a></li>
                                    <li><a href="#">Package-2</a></li>
                                    <li><a href="#">Package-3</a></li>
                                    <li><a href="#">Custome</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Link</h4>
                                <ul>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">News & Articles</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>+1 514 648 256</h4>
                                <ul>
                                    <li><a href="#">youremail@gmail.com</a></li>
                                </ul>
                                <p>123 East 26th Street, Fifth Floor, New York, NY 10011</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-xl-9 col-lg-9 ">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                                All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3">
                        <!-- Footer Social -->
                        <div class="footer-social f-right">
                            <a href="https://www.facebook.com/MogalysOnline"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://discord.com/invite/rp7QuKu"><i class="fab fa-discord"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>
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
{{--<script>--}}
{{--    const user = {!! json_encode($user->toArray()) !!};--}}
{{--</script>--}}
{{--<script src="{{asset('js/app.js')}}"></script>--}}
</body>
</html>
