@if(count(activeTestimonilas())>0)
    <section class="section section-lg bg-default novi-background bg-image">
        <div class="container">
            <div class="row justify-content-center justify-content-lg-start spacing-40">
                <div class="col-sm-10 col-md-12">
                    <h3>What <span class="heading-3">Past Student</span> Says</h3>
                </div>
                <div class="col-sm-10 col-md-12">
                    <div class="owl-carousel" data-items="1" data-md-items="2" data-nav="true" data-dots="false" data-md-stage-padding="30" data-loop="true" data-margin="0" data-md-margin="30" data-mouse-drag="false">
                        @foreach(activeTestimonilas() as $testimonial)
                            <div class="quote-classic"><q>{!! $testimonial->content !!}</q>
                                <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                    <div class="unit-left"><img class="img-responsive rounded-circle" src="{{ asset($testimonial->thumbnail) }}" alt="" width="75" height="75"></div>
                                    <div class="unit-body">
                                        <h5>{{ $testimonial->name }} </h5>
                                        <p class="quote-classic-subcite">{{ $testimonial->profession }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
