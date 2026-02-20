<div class="header-bottom-area" data-uk-sticky="top: 250; animation: uk-animation-slide-top;">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-xl-2 col-lg-2 col-6">
                <div class="logo">
                    <a href="{{ route('/') }}"><img src="{{ asset(siteInfo('logo')) }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                <div class="main-menu-wrap">
                    <nav id="mobile-menu" class="main-menu">
                        <ul class="main-menu-list ul_li">
                            <li class=""><a href="{{ route('/') }}">Home</a></li>
                            @foreach(frontMenus() as $menu)
                                <li class="menu-item-has-children"><a href="#!">{{ $menu->name }}</a>
                                    <ul class="submenu">
                                        @foreach(menuItems($menu->id) as $item)
                                            @if(count($item->subPages)>0)
                                                <li><a href="{{ route('page',['id'=>$item->id]) }}">{{ $item->menu_txt }}</a>
                                                    <ul class="sub-dropdown">
                                                        @foreach($item->subPages as $subPage)
                                                            <li><a href="{{ route('sub-page',['id'=>$subPage->id]) }}">{{ $subPage->menu_txt }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a href="{{ route('page',['id'=>$item->id]) }}">{{ $item->menu_txt }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                            {{--                            <li class="menu-item-has-children">--}}
                            {{--                                <a href="classes.html">Classes</a>--}}
                            {{--                                <ul class="submenu">--}}
                            {{--                                    <li><a href="classes.html">Classes</a></li>--}}
                            {{--                                    <li><a href="class-single.html">Class Details</a></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}
                            {{--                            <li class="menu-item-has-children">--}}
                            {{--                                <a href="shop.html">Shop</a>--}}
                            {{--                                <ul class="submenu">--}}
                            {{--                                    <li><a href="shop.html">Shop Sidebar</a></li>--}}
                            {{--                                    <li><a href="shop-single.html">Shop Details</a></li>--}}
                            {{--                                    <li><a href="cart.html">Cart</a></li>--}}
                            {{--                                    <li><a href="checkout.html">Checkout</a></li>--}}
                            {{--                                </ul>--}}
                            {{--                            </li>--}}
                            <li class="menu-item-has-children"><a href="{{ route('photo-gallery') }}">Gallery</a>
{{--                                <ul class="submenu">--}}
{{--                                    <li><a href="{{ route('photo-gallery') }}">Photo Gallery</a></li>--}}
{{--                                    <li><a href="blog-details.html">Video Gallery</a></li>--}}
{{--                                </ul>--}}
                            </li>
                            <li><a href="{{ route('all-blogs') }}">Blogs</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-6">
                <div class="header-right">
                    <div class="header-btn">
                        <a class="thm-btn" href="{{ route('contact-us') }}">Admission Now</a>
                    </div>
                    <div class="side-mobile-menu">
                        <button class="side-info-close"><i class="far fa-times"></i></button>
                        <div class="mobile-menu"></div>
                    </div>
                    <div class="side-menu-icon d-lg-none">
                        <button class="side-toggle"><i class="far fa-bars"></i></button>
                    </div>
                    <div class="offcanvas-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</div>
