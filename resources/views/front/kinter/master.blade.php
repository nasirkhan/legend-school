<!doctype html>
<html lang="en-US">

@include('front.kinter.includes.header.head-tag')

<body>
@include('sweetalert::alert')

<!-- body wrap start -->
<div class="body_wrap">

    @include('front.kinter.includes.preloader')

    @include('front.kinter.includes.back-to-top')

    @include('front.kinter.includes.header')

    <main>
        @yield('hero')
        @yield('content')
    </main>

    @include('front.kinter.includes.footer')

</div>
<!-- body wrap end -->

@include('front.kinter.includes.footer.scripts')
</body>
</html>
