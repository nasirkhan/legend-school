@extends('front.kinter.master')
@section('hero')
    <!-- page title start -->
{{--    <div class="page-title-area section-notch pt-170 pb-170" data-background="{{ asset('kinter/assets/img/bg/page-title-bg.jpg') }}">--}}
    <div class="page-title-area section-notch pb-30 pt-30" data-background="{{ asset('kinter/assets/img/bg/bg-img.jpg') }}">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-title" style="">
                        <h2 >{{ $blog->title }}</h2>
                        <div class="breadcrumb-list text-left">
                            <ul>
{{--                                <li>{{ 'Home' }}</li>--}}
                                <li><a href="{{ route('all-popular-ecas') }}">{{ 'Latest News' }}</a></li>
                                <li>{{ $blog->title }}</li>
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
    <style>
        p img {
            padding: 10px !important;
        }
    </style>
    <!-- blog start -->
    <section class="blog-content-area pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-wrapper mb-30">
                        <article class="post-item format-standard mb-30">
                            @if( $blog->thumbnail != null)
                            <div class="post-thumb">
                                <a href="#"><img src="{{ $blog->thumbnail != null? asset($blog->thumbnail) : '' }}" alt="blog"></a>
                            </div>
                            @endif

                            <div class="post-content">
                                <div class="post-meta mb-20">
                                    <span><a href="#"><i class="far fa-calendar-alt"></i> {{ dateFormat($blog->updated_at,'d M Y') }}</a></span>
                                    <span><a href="{{ route('/') }}"><i class="far fa-user"></i> {{ siteInfo('name') }}</a></span>
{{--                                    <span><a href="#!"><i class="far fa-comments"></i> 24 Comments</a></span>--}}
                                </div>
                                <h4 class="post-title">
                                    {{ $blog->title }}
{{--                                    <a href="blog-details.html">{{ $page->title }}</a>--}}
                                </h4>
                                <div class="post-text">
                                    <p>{!! $blog->content !!}</p>
                                </div>
{{--                                <div class="read-more mt-20">--}}
{{--                                    <a class="thm-btn" href="blog-details.html">Read More</a>--}}
{{--                                </div>--}}
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog end -->
@endsection
