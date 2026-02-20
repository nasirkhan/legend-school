<div class="novi-background">
    <div class="rd-navbar-inner">
        <div class="rd-navbar-panel">
            <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
            <div class="rd-navbar-brand">
                <a class="brand-name" href="{{ route('/') }}">
                    <img src="{{ asset(siteInfo('logo')) }}" alt="" style="height: 70px; width: auto">
{{--                    <img src="{{ asset('front') }}/legend/Legend-Logo.png" alt="" style="height: 70px; width: auto">--}}
{{--                    <img src="{{ asset('front') }}/images/logo-15.png" alt="" width="100" height="28">--}}
                </a>
            </div>
        </div>
        <div class="rd-navbar-nav-wrap">
            <ul class="rd-navbar-nav">
                <li><a href="{{ route('/') }}">Home</a></li>
{{--                Multi Level Dropdown--}}

                @foreach(frontMenus() as $menu)
                    <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a href="#">{{ $menu->name }}</a>
                        <ul class="rd-navbar-dropdown">
                            @foreach(menuItems($menu->id) as $item)
                                @if(count($item->subPages)>0)
                                    <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a class="fa fa-angle-right" href="{{ route('page',['id'=>$item->id]) }}">{{ $item->menu_txt }}</a>
                                        <ul class="rd-navbar-dropdown">
                                            @foreach($item->subPages as $subPage)
                                                <li><a class="fa fa-angle-right" href="{{ route('sub-page',['id'=>$subPage->id]) }}">{{ $subPage->menu_txt }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="fa fa-angle-right" href="{{ route('page',['id'=>$item->id]) }}"> {{ $item->menu_txt }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach

                {{--Dropdown--}}
{{--                @foreach(frontMenus() as $menu)--}}
{{--                    <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a href="#">{{ $menu->name }}</a>--}}
{{--                        <ul class="rd-navbar-dropdown">--}}
{{--                            @foreach(menuItems($menu->id) as $item)--}}
{{--                                <li><a class="fa fa-angle-right" href="{{ route('page',['id'=>$item->id]) }}"> {{ $item->menu_txt }}</a></li>--}}
{{--                            @endforeach--}}
{{--                            <li><a class="fa fa-angle-right" href="{{ route('principal-speech') }}"> Principle's Speech</a></li>--}}
{{--                            <li><a class="fa fa-angle-right" href="{{ route('mission-vision') }}"> Mission & Vision</a></li>--}}
{{--                            <li><a class="fa fa-angle-right" href="portfolio-grid.html"> History of the School</a></li>--}}
{{--                            <li><a class="fa fa-angle-right" href="portfolio-grid.html"> Safety Policy</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endforeach--}}

                {{--Dropdown--}}
                <li class="rd-navbar--has-dropdown rd-navbar-submenu"><a href="portfolio-grid.html">Gallery</a>
                    <ul class="rd-navbar-dropdown">
                        <li><a class="fa fa-angle-right" href="{{ route('photo-gallery') }}"> Photo Gallery</a></li>
                        <li><a class="fa fa-angle-right" href="#"> Video Gallery</a></li>
                    </ul>
                </li>

                {{--Dropdown--}}
                <li class=""><a href="{{ route('contact-us') }}">Contact US</a></li>

                <li class="rd-navbar-nav-wrap-content">
                    @if(Session::get('studentId'))
                        <div class="group-md"><a class="btn btn-sm btn-success btn-effect-ujarak" href="{{ route('student-profile') }}">Student Profile</a></div>
                    @else
                        <div class="group-md"><a class="btn btn-sm btn-primary btn-effect-ujarak" href="{{ route('student-login-form') }}">Student Login</a></div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
