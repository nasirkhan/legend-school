@extends('front.master')
@section('content')
    <section>
        <div class="bg-image novi-background page-title page-title-custom" style="">
            <div class="page-title-text mar-bottom-4">Student Panel</div>
            <div class="col-sm-10 col-lg-10 col-xl-4 section-auto">
                @include('front.includes.alert')
                <form method="post" action="{{ route('student-login') }}" class="rd-mailform text-left" data-form-output="form-output-global" data-form-type="forms">
                    @csrf
                    <div class="row spacing-20">
                        <div class="col-sm-12">
                            <div class="form-group form-wrap-validation">
                                <label class="form-label rd-input-label" for="mobile">Mobile</label>
                                <input class="form-control" id="mobile" type="text" name="mobile" >
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-wrap-validation">
                                <label class="form-label rd-input-label" for="password">Password</label>
                                <input class="form-control" id="password" type="password" name="password" >
                            </div>
                        </div>
                        <div class="col-sm-12 form-button">
                            <button class="btn btn-primary btn-block btn-effect-ujarak" type="submit">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
