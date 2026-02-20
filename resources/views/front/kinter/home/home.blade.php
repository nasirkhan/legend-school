@extends('front.kinter.master')

@section('hero')
    <!-- hero start -->
    <section class="hero-slider hero-style-1 section-notch">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach(activeSlides() as $slide)
                    <div class="swiper-slide">
                        <div class="slide-inner slide-overlay slide-bg-image" data-background="{{ asset($slide->url) }}">
                            <div class="container">
{{--                                <div data-swiper-parallax="200" class="slide-span">--}}
{{--                                    <span>{{ siteInfo('name') }}</span>--}}
{{--                                </div>--}}
                                <div data-swiper-parallax="300" class="slide-title">
                                    <h2>{{ $slide->title }}</h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text">
                                    <p>{{ $slide->description }}</p>
                                </div>
                                @if($slide->page_link!=null)
                                    <div class="clearfix"></div>
                                    <div class="slider-btn">
                                        <a data-swiper-parallax="500" class="thm-btn thm-btn-2" target="_blank" href="{{ $slide->page_link }}">View Details</a>
                                        <a data-swiper-parallax="550" class="thm-btn" href="#">Admission Now</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            <div class="container">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <!-- hero end -->
@endsection

@section('content')
    <!-- feature area start -->
    <section class="feature-area pt-110 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="section-title text-center mb-60">
                        <h2 class="title">Welcome to <br>{{ siteInfo('name') }}</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the app--}}
{{--                            to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-xl-3 col-lg-6 col-md-6">--}}
{{--                    <div class="feature-item text-center mb-30">--}}
{{--                        <div class="feature-shape">--}}
{{--                            <img src="{{ asset('kinter/assets/img/icon/f-icon-1.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="feature-title">--}}
{{--                                <h3>Active Learning</h3>--}}
{{--                            </div>--}}
{{--                            <p>Since have been visonary relable sofware engnern partne have been and visionary--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-6 col-md-6">--}}
{{--                    <div class="feature-item text-center mb-30">--}}
{{--                        <div class="feature-shape feature-shape-2">--}}
{{--                            <img src="{{ asset('kinter/assets/img/icon/f-icon-2.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="feature-title feature-title-2">--}}
{{--                                <h3>Expert Teachers</h3>--}}
{{--                            </div>--}}
{{--                            <p>Since have been visonary relable sofware engnern partne have been and visionary--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-6 col-md-6">--}}
{{--                    <div class="feature-item text-center mb-30">--}}
{{--                        <div class="feature-shape feature-shape-3">--}}
{{--                            <img src="{{ asset('kinter/assets/img/icon/f-icon-3.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="feature-title feature-title-3">--}}
{{--                                <h3>Parents Day</h3>--}}
{{--                            </div>--}}
{{--                            <p>Since have been visonary relable sofware engnern partne have been and visionary--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-6 col-md-6">--}}
{{--                    <div class="feature-item text-center mb-30">--}}
{{--                        <div class="feature-shape feature-shape-4">--}}
{{--                            <img src="{{ asset('kinter/assets/img/icon/f-icon-4.png')}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="feature-content">--}}
{{--                            <div class="feature-title feature-title-4">--}}
{{--                                <h3>Music Lessons</h3>--}}
{{--                            </div>--}}
{{--                            <p>Since have been visonary relable sofware engnern partne have been and visionary--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <!-- feature area end -->

    <!-- about area start -->
    <section class="about-area section-bg-one section-notch">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-9 d-flex align-items-center">
                    <div class="about-content pt-100 pb-100">
                        <div class="section-title section-title-white mb-30">
                            <h2 class="title">About <br> {{ siteInfo('name') }}</h2>
                            {!! siteInfo('home_about') !!}

                        </div>
                        <div class="about-btn">
                            <a class="thm-btn thm-btn-2" href="{{ route('contact-us') }}">admission now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3">
                    <div class="about-img d-none d-lg-block f-right pt-100">
                        @if(siteInfo('home_about_photo')=='undefined' or siteInfo('home_about_photo')=='' or siteInfo('home_about_photo')==null)
                            <img src="{{ asset('kinter/assets/img/about/about.png')}}" alt="">
                        @else
                            <img src="{{ asset(siteInfo('home_about_photo'))}}" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->

    <!-- class area start -->
    <section class="class-area pt-110 pb-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="section-title text-center mb-60">
                        <h2 class="title">Our Key Facilities</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the app to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
{{--                <div class="col-xl-4 col-lg-4 col-md-6">--}}
{{--                    <div class="class-item mb-30">--}}
{{--                        <div class="class-img">--}}
{{--                            <img src="{{ asset('kinter/assets/img/class/class-1.jpg')}}" alt="class image">--}}
{{--                        </div>--}}
{{--                        <div class="class-content">--}}
{{--                            <h4 class="title"><a href="class-single.html">Imagination Classes</a></h4>--}}
{{--                            <p>Class Time : 08:00 am - 10:00 am</p>--}}
{{--                            <p>Draticaly novate fuly rarched an plications awesome theme education</p>--}}
{{--                        </div>--}}
{{--                        <ul class="schedule">--}}
{{--                            <li>--}}
{{--                                <span>Class Size</span>--}}
{{--                                <span class="class-size">30 - 40</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <span>Years Old</span>--}}
{{--                                <span class="class-size class-size-2">06 - 09</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <span>Tution Fee</span>--}}
{{--                                <span class="class-size">$320.00</span>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}

                @foreach($popularECAs as $popularECA)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="class-item mb-30  pb-20">
                            <div class="class-img">
                                <img src="{{ asset($popularECA->thumbnail)}}" alt="class image">
                            </div>
                            <div class="class-content">
                                <h4 class="title"><a href="{{ route('popular-eca',['id'=>$popularECA->id]) }}">{{ $popularECA->title }}</a></h4>
{{--                                {!! $popularECA->content !!}--}}

                                <p class="text-justify">{{ Str::words(strip_tags($popularECA->content), 23, '. . .') }}</p>

                                <a class="blog-btn" href="{{ route('popular-eca',['id'=>$popularECA->id]) }}">READ MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="view-class text-center mt-30">
                        <a class="thm-btn" href="{{ route('all-popular-ecas') }}">See More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- class area start -->



    <!-- counter area start -->
    <section class="counter-area section-bg-two section-notch pt-130 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-counter text-center pb-30">
                        <img src="{{ asset('kinter/assets/img/icon/c-icon1.png')}}" alt="">
                        <h3><span class="odometer" data-count="{{ siteInfo('student_enrolled') }}">00</span><span class="plus">+</span></h3>
                        <p>Students Enrolled</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-counter text-center pb-30">
                        <img src="{{ asset('kinter/assets/img/icon/c-icon2.png')}}" alt="">
                        <h3><span class="odometer" data-count="{{ siteInfo('best_award_won') }}">00</span><span class="plus">+</span></h3>
                        <p>Best Awards Won</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-counter text-center pb-30">
                        <img src="{{ asset('kinter/assets/img/icon/c-icon3.png')}}" alt="">
                        <h3><span class="odometer" data-count="{{ siteInfo('graduation_completed') }}">00</span><span class="plus">+</span></h3>
                        <p>Graduation Completed</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="single-counter text-center pb-30">
                        <img src="{{ asset('kinter/assets/img/icon/c-icon4.png')}}" alt="">
                        <h3><span class="odometer" data-count="{{ siteInfo('total_faculty') }}">00</span><span class="plus">+</span></h3>
                        <p>Our Total Faculty</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- counter area end -->

    <!-- portfolio area start -->
    <div class="portfolio-area pt-110 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="section-title text-center mb-50">
                        <h2 class="title">Our Latest Photos</h2>
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
                                <a class="popup-image" href="{{ asset($image->url) }}"><i
                                        class="icon fal fa-plus"></i></a>
                            </div>
                            <a href="#!">
                                <h3>{{ $image->title }}</h3>
                            </a>
                            <span>{{ $image->description }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- portfolio area end -->

    <!-- blog area start -->
    <section class="blog-area section-bg-three section-notch pt-120 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-9">
                    <div class="section-title section-title-white text-center mb-55">
                        <h2 class="title">Our Latest News</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the--}}
{{--                            app to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($latestNews as $news)
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="blog-item mb-30">
                            <div class="blog-image">
                                <a href="{{ route('latest-blog',['id'=>$news->id]) }}"><img src="{{ asset($news->thumbnail)}}" alt="blog image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta ul_li">
                                    <span><i class="far fa-user"></i>by <a href="#!">{{ $news->author }}</a></span>
                                    <span><i class="far fa-calendar-alt"></i>{{ dateFormat($news->updated_at,'jS M Y') }}</span>
                                </div>
                                <h4 class="blog-title"><a href="{{ route('latest-blog',['id'=>$news->id]) }}">{{ $news->title }}</a></h4>
                                <a class="blog-btn" href="{{ route('latest-blog',['id'=>$news->id]) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="view-class text-center mt-30">
                        <a class="thm-btn" href="{{ route('all-blogs') }}">See More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog area end -->

    <!-- brand area start -->
    <section class="brand-area pt-110 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="brand-active owl-carousel">
                        @foreach(partners() as $partner)
                            <div class="single-brand">
                                <img style="height: 60px; width: auto" src="{{ asset($partner->thumbnail)}}" alt="{{ $partner->name }}">
                            </div>
                        @endforeach
{{--                            <div class="single-brand">--}}
{{--                                <img src="{{ asset('kinter/assets/img/brand/brand-01.jpg')}}" alt="brand image">--}}
{{--                            </div>--}}
{{--                        <div class="single-brand">--}}
{{--                            <img src="{{ asset('kinter/assets/img/brand/brand-02.jpg')}}" alt="brand image">--}}
{{--                        </div>--}}
{{--                        <div class="single-brand">--}}
{{--                            <img src="{{ asset('kinter/assets/img/brand/brand-03.jpg')}}" alt="brand image">--}}
{{--                        </div>--}}
{{--                        <div class="single-brand">--}}
{{--                            <img src="{{ asset('kinter/assets/img/brand/brand-04.jpg')}}" alt="brand image">--}}
{{--                        </div>--}}
{{--                        <div class="single-brand">--}}
{{--                            <img src="{{ asset('kinter/assets/img/brand/brand-05.jpg')}}" alt="brand image">--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- brand area end -->
@endsection
