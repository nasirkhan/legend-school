@extends('front.kinter.master')
@section('hero')
    <!-- page title start -->
{{--    <div class="page-title-area section-notch pt-170 pb-170" data-background="{{ asset('kinter/assets/img/bg/page-title-bg.jpg') }}">--}}
        <div class="page-title-area section-notch pb-30 pt-30" data-background="{{ asset('kinter/assets/img/bg/bg-img.jpg') }}">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title">
                        <h2>{{ 'Our School Gallery' }}</h2>
                        <div class="breadcrumb-list text-left">
                            <ul>
                                <li><a href="#">Gallery</a></li>
                                <li>Photo Gallery</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title end -->
@endsection

@section('content')
    <!-- portfolio area start -->
    <div class="portfolio-area pt-110 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="section-title text-center mb-50">
                        <h2 class="title">Our School Gallery</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the app--}}
{{--                            to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>
{{--            <div class="row text-center">--}}
{{--                <div class="col-12">--}}
{{--                    <ul class="portfolio-menu">--}}
{{--                        <li class="active" data-filter="*">see all</li>--}}
{{--                        <li data-filter=".cat1">Branding</li>--}}
{{--                        <li data-filter=".cat2">Creative</li>--}}
{{--                        <li data-filter=".cat3">Illustration</li>--}}
{{--                        <li data-filter=".cat4">Photoshgop</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="row grid text-center">
                @foreach($images as $image)
                    <div class="col-xl-4 col-lg-4 col-md-6 grid-item mb-30 cat3 cat4 cat2">
                        <div class="portfolio-item">
                            <div class="fortfolio-thumb">
                                <img src="{{ asset($image->url) }}" alt="">
                            </div>
                            <div class="portfolio-content">
                                <div class="content-view">
                                    <a class="popup-image" href="{{ asset($image->url) }}"><i class="icon fal fa-plus"></i></a>
                                </div>
                                <a href="#!"><h3>{{ $image->title }}</h3></a>
                                <span>{{ $image->description }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- portfolio area end -->
@endsection
