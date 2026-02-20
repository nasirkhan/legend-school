<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
@include('front.includes.head-tag')
<body>
@include('sweetalert::alert')
<div class="page-loader">
    <div class="brand-name">
        <img src="{{ asset(siteInfo('logo')) }}" alt="">
{{--        <img src="{{ asset('front') }}/legend/Legend-Logo.png" alt="">--}}
    </div>
    <div class="page-loader-body">
        <div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
</div>
<div class="page text-center">
    @include('front.includes.header.header')

    @yield('page-header')

    @yield('content')

    @include('front.includes.footer-top')
    @include('front.includes.footer.footer')
</div>
<div class="snackbars" id="form-output-global"></div>
<script async src="https://www.youtube.com/iframe_api"></script>
<script src="{{ asset('front/js/core.min.js') }}"></script>
<script src="{{ asset('front/js/script.js') }}"></script>
</body>
</html>
