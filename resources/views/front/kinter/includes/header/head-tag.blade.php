<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ siteInfo('short_name') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(siteInfo('favicon')) }}">

    <!-- css include -->

    <link rel="stylesheet" href="{{ asset('kinter/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/uikit.min.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('kinter/assets/css/responsive.css') }}">

    <style>
        .submenu li{
            position: relative;
        }
        .sub-dropdown{
            position: absolute;
            left: -9999px;
            /*left: 250px;*/
            background: white;
            top: 0px;
            min-width: 250px;
            border-radius: 3px;
            box-shadow: 0px 0px 3px 1px navy;
        }

        .submenu li:hover .sub-dropdown{
            left: 250px;
        }

        .mobile-sub-dropdown{

        }
        @media only screen and (max-width: 992px) {
            .sub-dropdown {
                left: 0px !important;
                /*height: 400px;*/
                /*overflow: auto;*/
                z-index: 99;
                top: 100%;
                /*background: transparent;*/
            }
        }

        .header-top{
            background-color: #2F3B93 ;
        }

        .header-top .left li{
            border-left: 1px solid #dddddd;
        }
        .header-top .right li{
            border-right: 1px solid #dddddd;
        }

        .header-top .right li:first-child {
            border-left: 1px solid #dddddd;
        }

        /*Menu Color*/
        /*.main-menu ul li:hover > a, .main-menu ul .active > a {*/
        /*    color: #FF5C0B;*/
        /*}*/
        .page-title{
            text-shadow: 2px 2px 10px #000000;
        }

        .slide-inner .slide-title h2{
            text-shadow: 2px 2px 10px #000000;
        }
    </style>
</head>
