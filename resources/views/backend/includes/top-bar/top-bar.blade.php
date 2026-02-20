<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
        @include('backend.includes.top-bar.includes.logo')
        <!-- Menu Button -->
        @include('backend.includes.top-bar.includes.vertical-menu-btn')
        <!-- App Search-->
        @include('backend.includes.top-bar.includes.app-search')
        <!-- App Mega Menu-->
            {{--@include('backend.includes.top-bar.includes.mega-menu')--}}
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

            {{--Country List--}}
{{--            @include('backend.includes.top-bar.includes.country-list')--}}

            {{--Media links--}}
            {{--@include('backend.includes.top-bar.includes.media')--}}

            {{--Full screen button--}}
            @include('backend.includes.top-bar.includes.full-screen-button')

            {{--Notification--}}
            {{--@include('backend.includes.top-bar.includes.notification')--}}

            {{--User Menu--}}
            @include('backend.includes.top-bar.includes.user-menu')

            {{--Theme changing button--}}
            {{-- @include('backend.includes.top-bar.includes.spin')--}}
        </div>
    </div>
</header>
