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
                        <h2>{{ 'Our Latest New' }}</h2>
                        <div class="breadcrumb-list text-left">
                            <ul>
                                <li><a href="{{ route('/') }}">Home</a></li>
                                <li>Our Latest News</li>
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
                        <h2 class="title">Our Latest News</h2>
{{--                        <p>Here is what you can expect from a house cleaning from a Handy professional. Download the app--}}
{{--                            to share further cleaning details and instructions!</p>--}}
                    </div>
                </div>
            </div>

            <div class="row ">
                @foreach($blogs as $blog)
{{--                    <div class="col-xl-4 col-lg-4 col-md-6">--}}
{{--                        <div class="class-item mb-30">--}}
{{--                            <div class="class-img">--}}
{{--                                <img src="{{ asset($blog->thumbnail)}}" alt="class image">--}}
{{--                            </div>--}}
{{--                            <div class="class-content">--}}
{{--                                <h4 class="title"><a href="{{ route('latest-blog',['id'=>$blog->id]) }}">{{ $blog->title }}</a></h4>--}}

{{--                                <p class="text-justify">{{ Str::words(strip_tags($blog->content), 25, '. . .') }}</p>--}}

{{--                                <a class="blog-btn" href="{{ route('latest-blog',['id'=>$blog->id]) }}">READ MORE</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-xl-4 col-lg-4 col-md-6" style="box-shadow: 1px 1px 0 rgba(0,0,0,0.2);">
                        <div class="blog-item mb-30">
                            <div class="blog-image">
                                <a href="{{ route('latest-blog',['id'=>$blog->id]) }}"><img src="{{ asset($blog->thumbnail)}}" alt="blog image"></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-meta ul_li">
                                    <span><i class="far fa-user"></i>by <a href="#!">{{ $blog->author }}</a></span>
                                    <span><i class="far fa-calendar-alt"></i>{{ dateFormat($blog->updated_at,'jS M Y') }}</span>
                                </div>
                                <h4 class="blog-title"><a href="{{ route('latest-blog',['id'=>$blog->id]) }}">{{ $blog->title }}</a></h4>
                                <a class="blog-btn" href="{{ route('latest-blog',['id'=>$blog->id]) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- portfolio area end -->
@endsection
