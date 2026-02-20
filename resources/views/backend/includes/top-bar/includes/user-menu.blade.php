<div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/user-avatar.png') }}"
             alt="Header Avatar">
        <span class="d-none d-xl-inline-block ml-1">{{ user()->name }}</span>
        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <!-- item-->
        <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
{{--        <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>--}}
{{--        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>--}}
{{--        <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>--}}
{{--        <div class="dropdown-divider"></div>--}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout
            </a>
        </form>

    </div>
</div>
