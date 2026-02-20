<div class="navbar-brand-box">
    <a href="{{ route('dashboard') }}" class="logo logo-dark">
        <span class="logo-sm"><img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22"></span>
        <span class="logo-lg"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17"></span>
    </a>

    <a href="{{ route('dashboard') }}" class="logo logo-light">
        <span class="logo-sm"><img src="{{ asset(siteInfo('favicon')) }}" class="rounded" alt="" height="22"></span>
        <span class="logo-lg">
{{--            <h3 class="pt-3 text-light">{{ siteInfo('short_name') }}</h3>--}}
{{--            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">--}}
            <img src="{{ asset(siteInfo('logo')) }}" alt="" style="height: 60px; width: auto; border-radius: 3px" class="">
        </span>
{{--        <span class="logo-lg"><img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19"></span>--}}
    </a>
</div>
