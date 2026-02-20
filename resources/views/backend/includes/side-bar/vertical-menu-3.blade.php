<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
{{--                <li class="menu-title">Menu</li>--}}

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span class="f-s-small">Dashboard</span>
                    </a>
                </li>
                @include('backend.includes.side-bar.menu.operation')
{{--                @include('backend.includes.side-bar.menu.report')--}}
                @include('backend.includes.side-bar.menu.setting')
                @include('backend.includes.side-bar.menu.website')
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
