<section class="section pre-footer-default text-center text-sm-left novi-background bg-image-custom">
    <div class="container">
        <div class="row justify-content-sm-center spacing-55">
            <div class="col-md-6 col-lg-4">
                <div class="brand-sm">
                    <a href="#">
                        <img src="{{ asset(siteInfo('logo')) }}" alt="" width="100" height="28">
{{--                        <img src="{{ asset('front') }}/legend/Legend-Logo.png" alt="" width="100" height="28">--}}
{{--                        <img src="{{ asset('front') }}/images/logo-15.png" alt="" width="100" height="28">--}}
                    </a>
                </div>
                <p class="font-weight-bold">Main Campus:</p>
                <p class="mt-0">House#4/9, Block-F,  <br>Jakir Hossain Road Lalmatia <br> Dhaka-1207</p>
                <div class="group-sm group-middle"><span class="big text-primary">Social media</span>
                    <ul class="inline-list-xxs">
                        <li><a class="icon novi-icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-instagram" href="#"></a></li>
                        <li><a class="icon novi-icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-facebook" href="#"></a></li>
                        <li><a class="icon novi-icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-twitter" href="#"></a></li>
                        <li><a class="icon novi-icon icon-xxs icon-circle icon-trout-outline icon-effect-1 fa fa-google-plus" href="#"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <h4>Instagram feed</h4>
                <div class="row spacing-10 instafeed" data-instafeed-user="25025320" data-instafeed-get="tagged" data-instafeed-tagname="tm_business_ui_kit" data-instafeed-sort="most-liked" data-lightgallery="group">
                    @foreach(instagramFeed(6) as $item)
                    <div class="col-4" data-instafeed-item="">
                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset($item->url) }}" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset($item->url) }}" alt="" data-images-standard_resolution-url="src"></a>
                            <div class="caption">
                                <ul class="list-inline inline-list-xxs">
                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>
                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="col-4" data-instafeed-item="">--}}
{{--                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset('front') }}/images/grid-gallery-3-1200x800_original.jpg" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset('front') }}/images/gallery-justify-03-270x300.jpg" alt="" data-images-standard_resolution-url="src"></a>--}}
{{--                            <div class="caption">--}}
{{--                                <ul class="list-inline inline-list-xxs">--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-4" data-instafeed-item="">--}}
{{--                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset('front') }}/images/grid-gallery-4-1200x800_original.jpg" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset('front') }}/images/gallery-justify-04-270x300.jpg" alt="" data-images-standard_resolution-url="src"></a>--}}
{{--                            <div class="caption">--}}
{{--                                <ul class="list-inline inline-list-xxs">--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-4" data-instafeed-item="">--}}
{{--                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset('front') }}/images/grid-gallery-8-1200x800_original.jpg" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset('front') }}/images/gallery-justify-06-270x300.jpg" alt="" data-images-standard_resolution-url="src"></a>--}}
{{--                            <div class="caption">--}}
{{--                                <ul class="list-inline inline-list-xxs">--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-4" data-instafeed-item="">--}}
{{--                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset('front') }}/images/grid-gallery-9-1200x800_original.jpg" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset('front') }}/images/gallery-justify-07-270x300.jpg" alt="" data-images-standard_resolution-url="src"></a>--}}
{{--                            <div class="caption">--}}
{{--                                <ul class="list-inline inline-list-xxs">--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-4" data-instafeed-item="">--}}
{{--                        <div class="thumbnail-instafeed"><a class="instagram-link" data-lightgallery="item" href="{{ asset('front') }}/images/grid-gallery-5-1200x800_original.jpg" data-images-standard_resolution-url="href"><img class="instagram-image" src="{{ asset('front') }}/images/gallery-justify-09-270x300.jpg" alt="" data-images-standard_resolution-url="src"></a>--}}
{{--                            <div class="caption">--}}
{{--                                <ul class="list-inline inline-list-xxs">--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-heart"></span><span data-likes-count="text"></span></li>--}}
{{--                                    <li><span class="novi-icon icon mdi mdi-comment"></span><span data-comments-count="text"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="col-md-9 col-lg-4 text-sm-center text-md-left">
                <h4>Newsletter</h4>
                <p>Enter your e-mail to get the latest news and latest updates from Us.</p>
                <form class="rd-mailform form-bordered form-centered" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="">
                    <div class="form-group">
                        <label class="form-label" for="footer-subscribe-email1">Your e-mail address</label>
                        <input class="form-control" id="footer-subscribe-email1" type="email" name="email">
                    </div>
                    <button class="btn btn-primary btn-block btn-offset-small btn-effect-ujarak" type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>
