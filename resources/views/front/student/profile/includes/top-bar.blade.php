<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('student-profile') }}" class="logo logo-dark">
{{--                    <span class="logo-sm"><img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22"></span>--}}
                    <span class="logo-sm"><img src="{{ asset(siteInfo('favicon')) }}" class="rounded" alt="" height="22"></span>
                    <span class="logo-lg"><img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17"></span>
                </a>

                <a href="{{ route('student-profile') }}" class="logo logo-light">
{{--                    <span class="logo-sm"><img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22"></span>--}}
                    <span class="logo-sm"><img src="{{ asset(siteInfo('favicon')) }}" alt="" height="22"></span>
{{--                    <span class="logo-lg">--}}
{{--                        <h4 class="pt-3 text-light">Student Area</h4>--}}
{{--                        <h3 class="text-light"> Student Area</h3>--}}
{{--                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">--}}
{{--                        <img src="{{ asset('assets/images/mizan-logo.png') }}" alt="" style="height: 50px; width: auto; border-radius: 3px" class="p-1">--}}
{{--                    </span>--}}

                    <span class="logo-lg">
                        <img src="{{ asset(siteInfo('logo')) }}" alt="" style="height: 60px; width: auto; border-radius: 3px; margin-top: 20px" class="">
                    </span>


                    {{--        <span class="logo-lg"><img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19"></span>--}}
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
{{--            <form class="app-search d-none d-lg-block">--}}
{{--                <div class="position-relative">--}}
{{--                    <input type="text" class="form-control" placeholder="Search...">--}}
{{--                    <span class="bx bx-search-alt"></span>--}}
{{--                </div>--}}
{{--            </form>--}}

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                     aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset($student->photo->url) }}" alt="Header Avatar">
{{--                    <img class="rounded-circle header-profile-user" src="{{ asset('assets') }}/images/users/avatar-1.jpg" alt="Header Avatar">--}}
                    <span class="d-none d-xl-inline-block ml-1">{{ $student->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
{{--                    <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Update Profile</a>--}}
                    <a class="dropdown-item" href="{{ route('student-password-update-form') }}"><i class="bx bxs-check-circle font-size-16 align-middle mr-1"></i> Change Password</a>
{{--                    <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>--}}
{{--                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>--}}
{{--                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item text-danger" href="{{ route('student-logout') }}"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                </div>
            </div>

{{--            <div class="dropdown d-inline-block">--}}
{{--                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">--}}
{{--                    <i class="bx bx-cog bx-spin"></i>--}}
{{--                </button>--}}
{{--            </div>--}}

        </div>
    </div>
</header> <!-- ========== Left Sidebar Start ========== -->
