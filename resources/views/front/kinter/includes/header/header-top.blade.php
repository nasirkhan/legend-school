<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="left">
                    <li><span><i class="far fa-clock"></i></span> {{ siteInfo('active_hour') }} </li>
                    <li><span><i class="far fa-phone"></i></span> {{ siteInfo('mobile') }} </li>
                    <li><span><i class="far fa-map-marker-alt"></i></span> {{ siteInfo('address') }}
                    </li>
                </ul>
                <ul class="right">
                    @if(Session::get('studentId'))
                        <li><a href="{{ route('student-profile') }}" style="font-size: 16px !important;"><i class="fa fa-graduation-cap"></i> Student Profile</a></li>
                    @else
                        <li><a href="{{ route('student-login-form') }}" style="font-size: 16px !important;"><i class="fa fa-graduation-cap"></i> Student Login</a></li>
                    @endif

                    @if(Session::get('teacherId'))
                        <li>
                            <a href="{{ route('teacher-profile') }}" style="font-size: 16px !important;">
                                <i class="fa fa-graduation-cap"></i> Teacher Profile
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('teacher-login-form') }}" style="font-size: 16px !important;">
                                <i class="fa fa-graduation-cap"></i> Teacher Login
                            </a>
                        </li>
                    @endif

                        @if(Auth::user())
                            <li><a href="{{ route('login') }}" style="font-size: 16px !important;"><i class="fa fa-user-check"></i> Admin Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" style="font-size: 16px !important;"><i class="fa fa-user-circle"></i> Admin Login</a></li>
                        @endif


{{--                    <li><a href="#!"><i class="fab fa-twitter"></i></a></li>--}}
{{--                    <li><a href="#!"><i class="fab fa-vimeo-v"></i></a></li>--}}
{{--                    <li><a href="#!"><i class="fab fa-skype"></i></a></li>--}}
{{--                    <li><a href="#!"><i class="fas fa-rss"></i></a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>
