<!doctype html>
<html lang="zxx" dir="rtl" class="theme-light">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/bootstrap.rtl.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/animate.min.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/meanmenu.css">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/boxicons.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/owl.carousel.min.css">
    <!-- Owl Carousel Default CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/owl.theme.default.min.css">
    <!-- Odometer CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/odometer.min.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/magnific-popup.min.css">
    <!-- Imagelightbox CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/imagelightbox.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/style.css">
    <!-- Dark CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/dark.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/responsive.css">
    <!-- RTL CSS -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/rtl.css">

    <script src="{{asset('')}}/assets/js/sweetalert2@11.js"></script>
    <title>Quiz</title>

    <link rel="icon" type="image/png" href="{{asset('')}}/assets/img/img/logo.jpg">
</head>

<style>
    #datetime{
        font-size: 16px;
        font-weight: bold;
        border: 2px solid #1d7629;
        padding: 5px;
        border-radius: 10px;
        color: #ec6606;
    }
</style>
<body>

<!-- Start Preloader Area -->
<div class="preloader">
    <div class="loader">
        <div class="wrapper">
            <div class="circle circle-1"></div>
            <div class="circle circle-1a"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
    </div>
</div>
<!-- End Preloader Area -->

<!-- Start Navbar Area -->
<div class="navbar-area">
    <div class="main-responsive-nav">
        <div class="container">
            <div class="main-responsive-menu">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('')}}/assets/img/img/logo.png" class="black-logo" alt="image">
                        <img src="{{asset('')}}/assets/img/img/logo.png" class="white-logo" alt="image">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-navbar">
        <div class="container" style="max-width: 1240px">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img src="{{asset('')}}/assets/img/img/logo.png" class="black-logo" alt="image" style="width: 100px;">
                    <img src="{{asset('')}}/assets/img/img/logo.png" class="white-logo" alt="image" style="width: 100px;">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav" >
                        <li class="nav-item ">
                            <a href="{{route('home')}}" class="nav-link active">
                                الرئيسية
                            </a>
                        </li>

                        <li class="nav-item  d-flex align-items-center">
                            <a id="datetime" class="nav-link"></a>
                        </li>
                    </ul>
                </div>
                @if (auth()->guard('student')->check())
                    <a class="navbar-brand mx-3" href="#" style="color: #1d7629 ; font-size: 15px" > الملف الشخصي</a>
                    <a class="navbar-brand mx-3" href="#" style="color: #1d7629; font-size: 15px"> {{auth()->guard('student')->user()->name}} </a>
                    <a class="navbar-brand mx-3" href="{{route('userLogout')}}" style="color: #1d7629; font-size: 15px">خروج </a>

                @endif

            </nav>
        </div>
    </div>

    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>



            </div>
        </div>
    </div>
</div>
<!-- End Navbar Area -->

@include('layouts.front.partials._sessions')


@yield('content')


<!-- Start Footer Area -->
<section class="footer-area" style="padding: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-footer-widget">
                    <div class="logo">
                        <h2>
                            <a href="{{route('home')}}">

                            </a>
                        </h2>
                    </div>
                    <p></p>
                    <ul class="social" style="text-align: center">

                        <li>
                            <a href="https://twitter.com/abtdaeh?t=o-TJRnjpewyMlBbEGY9X5A&s=08" target="_blank">
                                <i class='bx bxl-twitter'></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- End Footer Area -->

<!-- Start Go Top Area -->
<div class="go-top">
    <i class='bx bx-up-arrow-alt'></i>
</div>
<!-- End Go Top Area -->

{{--<!-- dark version -->--}}
{{--<div class="dark-version">--}}
{{--  --}}
{{--</div>--}}
{{--<!-- dark version -->--}}

<!-- Jquery Slim JS -->
<script src="{{asset('')}}/assets/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="{{asset('')}}/assets/js/bootstrap.bundle.min.js"></script>
<!-- Meanmenu JS -->
<script src="{{asset('')}}/assets/js/jquery.meanmenu.js"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('')}}/assets/js/owl.carousel.min.js"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('')}}/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Imagelightbox JS -->
<script src="{{asset('')}}/assets/js/imagelightbox.min.js"></script>
<!-- Odometer JS -->
<script src="{{asset('')}}/assets/js/odometer.min.js"></script>
<!-- Jquery Appear JS -->
<script src="{{asset('')}}/assets/js/jquery.appear.min.js"></script>
<!-- Ajaxchimp JS -->
<script src="{{asset('')}}/assets/js/jquery.ajaxchimp.min.js"></script>
<!-- Form Validator JS -->
<script src="{{asset('')}}/assets/js/form-validator.min.js"></script>
<!-- Contact JS -->
<script src="{{asset('')}}/assets/js/contact-form-script.js"></script>

<script src="{{asset('')}}/assets/js/student-registration-form-script.js"></script>
<!-- Custom JS -->
<script src="{{asset('')}}/assets/js/playerjs.js"></script>
<script src="{{asset('')}}/assets/js/main.js"></script>

@yield('script')


<script>
    $(document).ready(function() {
        function updateDateTime() {
            var currentDateTime = new Date();
            var dateTimeString = currentDateTime.toLocaleString();
            $('#datetime').text(dateTimeString);
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);
    });
</script>


</body>

<!-- Mirrored from templates.envytheme.com/ketan/rtl/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 27 Jan 2023 14:55:25 GMT -->
</html>
