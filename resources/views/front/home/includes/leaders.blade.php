@if(count(activeLeaders())>0)
    <section class="section section-lg bg-default novi-background bg-image">
        <div class="container">
            <div class="row justify-content-center spacing-40">
                <div class="col-sm-10 col-lg-10 section-auto mar-bottom-2">
                    <h3><span class="heading-3">Our</span> Leaders</h3>
                    <p>Let's Introduce Honorable Leader Of {{ siteInfo('name') }}</p>
                </div>
                @foreach(activeLeaders() as $leader)
                    <div class="col-sm-6 col-md-4">
                        <div class="team-sty-two">
                            <div class="team-image"><img src="{{ asset($leader->thumbnail) }}" alt="" class="img-responsive">
                                <div class="team-overlay">
                                    <ul class="team-social">
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="team-info">
                                <h4>{{ $leader->name }}</h4>
                                <span class="serif">{{ $leader->designation }}</span>
                                <p>{{ $leader->short_description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
