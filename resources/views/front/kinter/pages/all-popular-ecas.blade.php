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
                        <h2>{{ 'Our Key Facilities' }}</h2>
                        <div class="breadcrumb-list text-left">
                            <ul>
                                <li><a href="{{ route('/') }}">Home</a></li>
                                <li>Our Key Facilities</li>
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
                        <h2 class="title">Our Key Facilities</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the app--}}
{{--                            to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>

            <div class="row ">
                @foreach($ecas as $eca)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="class-item mb-30">
                            <div class="class-img">
                                <img src="{{ asset($eca->thumbnail)}}" alt="class image">
                            </div>
                            <div class="class-content">
                                <h4 class="title"><a href="{{ route('popular-eca',['id'=>$eca->id]) }}">{{ $eca->title }}</a></h4>

                                <p class="text-justify">{{ Str::words(strip_tags($eca->content), 25, '. . .') }}</p>

                                <a class="blog-btn" href="{{ route('popular-eca',['id'=>$eca->id]) }}">READ MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- portfolio area end -->
@endsection
