<div class="copyright-area pt-30 pb-30">
    <div class="container">
        <div class="row flex-row-reverse align-items-center">
            <div class="col-xl-8 col-lg-8 col-md-4">
                <div class="footer-social">
                    <ul>
                        <li>
                            <a target="_blank" href="{{ siteInfo('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                            <span>Facebook</span>
                        </li>
                        <li>
                            <a target="_blank" href="{{ siteInfo('google') }}"><i class="fab fa-google-plus-g"></i></a>
                            <span>Google Plus</span>
                        </li>
                        <li>
                            <a target="_blank" href="{{ siteInfo('twitter') }}"><i class="fab fa-twitter"></i></a>
                            <span>Twitter</span>
                        </li>
                        <li>
                            <a target="_blank" href="{{ siteInfo('pinterest') }}"><i class="fab fa-pinterest-p"></i></a>
                            <span>Pinterest</span>
                        </li>
                        <li>
                            <a target="_blank" href="{{ siteInfo('linkedin') }}"><i class="fab fa-linkedin-in"></i></a>
                            <span>Linkedin</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-8">
                <div class="copyright-text">
                    <p>	&copy; {{ date('Y') }} Copyright <a href="{{ route('/') }}">{{ siteInfo('title') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
