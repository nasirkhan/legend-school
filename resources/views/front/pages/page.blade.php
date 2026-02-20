@extends('front.master')

@section('page-header')
    <section>
        <div class="bg-image novi-background page-title page-title-custom" style="">
{{--        <div class="bg-image novi-background page-title page-title-custom" style="background-image: url({{ asset('front/_images/slide-28-1-2.html') }});">--}}
            <div class="page-title-text">{{ $page->menu_txt }}</div>
        </div>
        <ul class="breadcrumbs-custom novi-background">
            <li><a href="#" target="">{{ $page->menu->name }}</a></li>
            <li class="active">{{ $page->menu_txt }}</li>
        </ul>
    </section>
@endsection

@section('content')
    <section class="section section-lg bg-white novi-background bg-image" style="padding-top: 30px !important;">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-lg-3 {{ $page->thumbnail != null ? '' : 'd-none' }}"><img src="{{ $page->thumbnail != null ? asset($page->thumbnail) : '' }}" alt="" class="img-responsive"></div>
                <div class="col-sm-10 col-lg-{{ $page->thumbnail != null ? 9 : 12 }}">
                    <div class="feature-box-3">
{{--                        <h5>Welcome to LEGENDS International School</h5>--}}
                        <h3>{{ $page->title }}</h3>
                        <p style="text-align: justify">{!! $page->content !!}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
