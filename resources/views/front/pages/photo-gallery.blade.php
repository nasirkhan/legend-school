<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

@include('front.includes.head-tag')

<body>
<div class="page-loader">
    <div class="brand-name"><img src="{{ asset('front') }}/legend/Legend-Logo.png" alt="" style="height: 70px; width: auto"></div>
    <div class="page-loader-body">
        <div class="cssload-jumping"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
</div>
<div class="page text-center">
    <section class="section">
        @include('front.includes.header.header')
        <section>
            <div class="bg-image novi-background page-title page-title-custom">
                <div class="page-title-text">Photo Gallery</div>
            </div>
            <ul class="breadcrumbs-custom novi-background">
                <li><a href="{{ route('/') }}">Home</a></li>
                <li class="active">Photo Gallery</li>
            </ul>
        </section>
    </section>

    <section class="section section-lg bg-default novi-background bg-image" style="padding-top: 30px !important;">
        <div class="container">
            <div class="isotope-wrap">
                <ul class="isotope-filters-responsive">
                    <li>
                        <p>Choose your category:</p>
                    </li>
                    <li class="block-top-level">
                        <button class="isotope-filters-toggle btn btn-sm btn-primary" data-custom-toggle="#isotope-1" data-custom-toggle-hide-on-blur="true">Filter <span class="caret"></span></button>
                        <div class="isotope-filters" id="isotope-1">
                            <ul class="inline-list">
                                <li><a class="active" data-isotope-filter="*" data-isotope-group="gallery" href="#">{{ siteInfo('name') }}'s Some Special Moments</a></li>
{{--                                <li><a data-isotope-filter="Category 1" data-isotope-group="gallery" href="#">Web Design</a></li>--}}
{{--                                <li><a data-isotope-filter="Category 2" data-isotope-group="gallery" href="#">Creative</a></li>--}}
                            </ul>
                        </div>
                    </li>
                </ul>
                <div class="row isotope" data-isotope-layout="fitRows" data-isotope-group="gallery" data-lightgallery="group">
                    @foreach($images as $image)
                        <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 1">
                            <a class="thumbnail-classic" href="{{ asset($image->url) }}" data-lightgallery="item">
                                <figure><img src="{{ asset($image->url) }}" alt="" class="img-responsive"></figure>
                                <div class="caption">
                                    <p class="caption-title">{{ $image->title }}</p>
                                    <p class="caption-text">{{ $image->description }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach


{{--                    <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 2"><a class="thumbnail-classic" href="{{ asset('front') }}/images/gallery3-2.jpg" data-lightgallery="item">--}}
{{--                            <figure><img src="{{ asset('front') }}/images/gallery-s3-369x280.jpg" alt="" class="img-responsive"></figure>--}}
{{--                            <div class="caption">--}}
{{--                                <p class="caption-title">Photo #2</p>--}}
{{--                                <p class="caption-text"></p>--}}
{{--                            </div>--}}
{{--                        </a></div>--}}
{{--                    <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 1"><a class="thumbnail-classic" href="{{ asset('front') }}/images/gallery6-1.jpg" data-lightgallery="item">--}}
{{--                            <figure><img src="{{ asset('front') }}/images/gallery-s6-370x280.jpg" alt="" class="img-responsive"></figure>--}}
{{--                            <div class="caption">--}}
{{--                                <p class="caption-title">Photo #3</p>--}}
{{--                                <p class="caption-text"></p>--}}
{{--                            </div>--}}
{{--                        </a></div>--}}
{{--                    <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 1"><a class="thumbnail-classic" href="{{ asset('front') }}/images/gallery2-2.jpg" data-lightgallery="item">--}}
{{--                            <figure><img src="{{ asset('front') }}/images/gallery-s2-370x280.jpg" alt="" class="img-responsive"></figure>--}}
{{--                            <div class="caption">--}}
{{--                                <p class="caption-title">Photo #4</p>--}}
{{--                                <p class="caption-text"></p>--}}
{{--                            </div>--}}
{{--                        </a></div>--}}
{{--                    <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 1"><a class="thumbnail-classic" href="{{ asset('front') }}/images/gallery-1-3.jpg" data-lightgallery="item">--}}
{{--                            <figure><img src="{{ asset('front') }}/images/gallery-s-370x280.jpg" alt="" class="img-responsive"></figure>--}}
{{--                            <div class="caption">--}}
{{--                                <p class="caption-title">Photo #5</p>--}}
{{--                                <p class="caption-text"></p>--}}
{{--                            </div>--}}
{{--                        </a></div>--}}
{{--                    <div class="col-xs-12 col-sm-6 col-lg-4 isotope-item" data-filter="Category 2"><a class="thumbnail-classic" href="{{ asset('front') }}/images/gallery5-6.jpg" data-lightgallery="item">--}}
{{--                            <figure><img src="{{ asset('front') }}/images/gallery-s5-370x280.jpg" alt="" class="img-responsive"></figure>--}}
{{--                            <div class="caption">--}}
{{--                                <p class="caption-title">Photo #6</p>--}}
{{--                                <p class="caption-text"></p>--}}
{{--                            </div>--}}
{{--                        </a></div>--}}
                </div>
            </div>
        </div>
    </section>

    @include('front.includes.footer.small-footer')
</div>
<div class="snackbars" id="form-output-global"></div>
<script async src="https://www.youtube.com/iframe_api"></script><script src="{{ asset('front') }}/js/core.min.js"></script><script src="{{ asset('front') }}/js/script.js"></script>
</body>

<!-- Mirrored from uxliner.net/gova/demos/page-gallery.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Sep 2022 12:44:07 GMT -->
</html>
