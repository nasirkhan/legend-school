<div class="footer-bottom pt-100 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget mb-40">
                    <h3>{{ siteInfo('short_name') }}</h3>
                    <img src="{{ siteInfo('logo') }}" class="p-2 bg-white rounded mb-3" alt="" style="height: 90px; width: auto">
                    <p>
                        <i class="fa fa-map-marked-alt"></i> {{ siteInfo('address') }} <br>
                        <i class="fa fa-envelope "></i> {{ siteInfo('email') }} <br>
                        <i class="fa fa-mobile-alt "></i> {{ siteInfo('mobile') }}
                    </p>
                    <div class="footer-social">
                        <h4>Follow us :</h4>
                        <a target="_blank" href="{{ siteInfo('facebook') }}"><i class="fab fa-facebook"></i></a>
                        <a target="_blank" href="{{ siteInfo('twitter') }}"><i class="fab fa-twitter"></i></a>
{{--                        <a href="{{ siteInfo('google') }}"><i class="fas fa-google-plus"></i></a>--}}
{{--                        <a target="_blank" href="{{ siteInfo('pinterest') }}"><i class="fab fa-pinterest"></i></a>--}}
{{--                        <a href="{{ siteInfo('behance') }}"><i class="fab fa-behance"></i></a>--}}
                        <a target="_blank" href="{{ siteInfo('youtube') }}"><i class="fab fa-youtube"></i></a>
                        <a target="_blank" href="{{ siteInfo('instagram') }}"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" href="{{ siteInfo('linkedin') }}"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget mb-40">
                    <h3>Recent Blog Posts</h3>
                    <div class="footer-post">
                        @foreach(recentBlogs() as $blog)
                            <div class="fp-single">
                                <div class="thumb">
                                    <a href="{{ route('latest-blog',['id'=>$blog->id]) }}"><img src="{{ asset($blog->thumbnail)}}" style="width:100px; height: auto" alt=""></a>
                                </div>
                                <div class="content">
                                    <span><i class="far fa-calendar-alt"></i> {{ dateFormat($blog->updated_at,'jS M Y') }}</span>
                                    <h5><a href="{{ route('latest-blog',['id'=>$blog->id]) }}">{{ $blog->title }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="footer-widget mb-40">
                    <h3>Newsletter Subscription</h3>
                    <p>Enter your email and get latest updates and offers subscribe us</p>
                    <form action="#!">
                        <input type="text" placeholder="Enter your email">
                        <button class="thm-btn">Subscribe Now!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
