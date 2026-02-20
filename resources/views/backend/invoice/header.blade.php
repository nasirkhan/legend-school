<style>
    @media print {
        img.logo{
            left: 240px !important;
        }
    }
</style>

<header>
    <div class="row">
        <div class="col-12 mb-1 mb-lg-0 text-center">
{{--            <img class="logo" src="{{ asset('assets/images/logo.svg') }}" style="height: 100px; width: auto;  position: absolute; left: 450px; " alt="" />--}}
{{--            <img class="logo" src="{{ asset('assets/images/mizan-logo.jpeg') }}" style="height: 100px; width: auto;  position: absolute; left: 450px; " alt="" />--}}
{{--            <img class="logo" src="{{ asset('assets/images/companies/img-4.png') }}" style="height: 100px; width: auto;  position: absolute; left: 450px; " alt="" />--}}
            <div class="h1 text-dark text-center mb-0" style="font-size: 30px">{{ siteInfo('name') }}</div>
{{--            <span class="text-dark com-name">{{ 'Branch Name' }}{{ 'Branch Title' }}</span><br>--}}
            <span class="text-dark">{{ siteInfo('address') }}</span><br>
            <span class="text-dark">Mobile: {{ siteInfo('mobile') }}</span>
        </div>
        <div class="col-12 text-center">
            <span class="text-dark font-weight-700 d-inline-block border border-black p-1 pl-2 pr-2 rounded">@yield('title')</span>
        </div>
    </div>
    <hr class="mb-2 mt-2 border-black">
</header>
