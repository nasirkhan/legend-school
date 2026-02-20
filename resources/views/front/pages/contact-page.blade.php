@extends('front.master')

@section('page-header')
    <section>
        <div class="bg-image novi-background page-title page-title-custom" style="background-image: url({{ asset('front/_images/slide-28-1-2.html') }});">
            <div class="page-title-text">Contact US</div>
        </div>
        <ul class="breadcrumbs-custom novi-background">
            <li><a href="#" target="">Home</a></li>
            <li class="active">Contact US</li>
        </ul>
    </section>
@endsection

@section('content')
    <section class="section section-lg bg-default novi-background bg-image">
        <div class="container">
            <div class="row justify-content-sm-center justify-content-lg-between spacing-40">
                <div class="col-sm-10 col-xl-12">
                    <h3> <span class="heading-3">Contact</span> with Us</h3>
                </div>
                <div class="col-sm-10 col-lg-10 col-xl-6 text-left">
                    <form class="rd-mailform text-left" data-form-output="form-output-global" data-form-type="forms" method="post" action="">
                        <div class="row spacing-30">
                            <div class="col-sm-6">
                                <div class="form-group form-wrap-validation">
                                    <label class="form-label" for="forms-name">First name</label>
                                    <input class="form-control" id="forms-name" type="text" name="name" data-constraints="Required">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-wrap-validation">
                                    <label class="form-label" for="forms-last-name">Last name</label>
                                    <input class="form-control" id="forms-last-name" type="text" name="last-name" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-wrap-validation">
                                    <label class="form-label" for="forms-email">E-mail</label>
                                    <input class="form-control" id="forms-email" type="email" name="email" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-wrap-validation">
                                    <label class="form-label" for="forms-phone">Phone</label>
                                    <input class="form-control" id="forms-phone" type="text" name="phone" >
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-wrap-validation">
                                    <label class="form-label" for="forms-message">Message</label>
                                    <textarea class="form-control" id="forms-message" name="message" ></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 form-button">
                                <button class="btn btn-primary btn-block btn-effect-ujarak" type="submit">send message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-10 col-lg-10 col-xl-5 text-left">
                    <div class="box-contact-info">
                        <div class="unit unit-xs-horizontal box-contact-item">
                            <div class="unit-left">
                                <p>ADDRESS</p>
                            </div>
                            <div class="unit-body">
                                <div class="object-inline object-inline-top"> <span class="icon novi-icon icon-sm icon-gray material-icons-location_on"></span> <a class="link link-sm link-gray-darker" href="#">House#4/9, Block-F, <br>
                                        Lalmatia, Dhaka-1207</a> </div>
                            </div>
                        </div>
                        <div class="unit unit-xs-horizontal box-contact-item">
                            <div class="unit-left">
                                <p>SUPPORT</p>
                            </div>
                            <div class="unit-body">
                                <div class="object-inline"> <span class="icon novi-icon icon-sm icon-gray material-icons-phone"></span> <a class="link link-sm link-gray-darker" href="callto:#">{{ siteInfo('mobile') }}</a> </div>
                            </div>
                        </div>
                        <div class="unit unit-xs-horizontal box-contact-item">
                            <div class="unit-left">
                                <p>get social </p>
                            </div>
                            <div class="unit-body">
                                <ul class="inline-list-xs">
                                    <li> <a class="icon novi-icon icon-sm icon-gray fa fa-facebook" href="#"></a> </li>
                                    <li> <a class="icon novi-icon icon-sm icon-gray fa fa-twitter" href="#"></a> </li>
                                    <li> <a class="icon novi-icon icon-sm icon-gray fa fa-google-plus" href="#"></a> </li>
                                    <li> <a class="icon novi-icon icon-sm icon-gray fa fa-youtube" href="#"></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section bg-default">
        <div class="google-map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58427.90990080753!2d90.29630665820311!3d23.7564936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf14e0ae8e9f%3A0x5252fc42d6498d9b!2sTHE%20LEGENDS!5e0!3m2!1sen!2sbd!4v1673908125428!5m2!1sen!2sbd" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>
    </section>
@endsection
