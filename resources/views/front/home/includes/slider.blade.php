<section class="section">
    <div class="swiper-bg-wrap swiper-style-1">
        <div class="swiper-container swiper-slider swiper-bg" data-autoplay="6500" data-slide-effect="fade">
            <div class="swiper-wrapper">
                @foreach(activeSlides() as $slide)
                    <div class="swiper-slide" data-slide-bg="{{ asset($slide->url) }}">
                        <div class="container text-left">
                            <div class="swiper-slide-caption" data-speed="0.5">
                                <div class="jumbotron-custom jumbotron-custom-variant-1 context-dark custom-slide">
                                    @if($slide->title!=null)
                                        <hr class="divider-sm divider-left divider-success" data-caption-animate="fadeInLeftSmall" data-caption-delay="50">
                                        <h1 class="width-100 fadeInLeftSmall animated" data-caption-animate="fadeInLeftSmall" data-caption-delay="150"><span data-novi-id="3">{{ $slide->title }}</span></h1>
                                    @endif
                                    @if($slide->description!=null)
                                        <p class="subtitle-variant-3 width-100 fadeInLeftSmall animated" data-caption-animate="fadeInLeftSmall" data-caption-delay="350"><span data-novi-id="4">{{ $slide->description }}</span></p>
                                    @endif
                                    @if($slide->page_link!=null)
                                        <div class="width-100 mar-top-5"><a class="btn btn-primary btn-lg btn-aqil btn-aqil--mod-1" href="{{ $slide->page_link }}" data-caption-animate="fadeInLeftSmall" data-caption-delay="550"><span>See Details</span></a></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"><span>Prev</span></div>
            <div class="swiper-button-next"><span>Next</span></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
