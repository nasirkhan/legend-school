<li class="menu-title"><span class="f-s-small">Website Management</span></li>
@if(role()->code=='developer' or role()->code=='s_admin' or role()->code=='admin')
    @include('backend.includes.side-bar.menu.page')
    @include('backend.includes.side-bar.menu.sub-page')
    @include('backend.includes.side-bar.menu.slider')
    @include('backend.includes.side-bar.menu.popular-classes')
    @include('backend.includes.side-bar.menu.latest-news')
    <li><a href="{{ route('gallery-images') }}" class=" waves-effect"><i class="bx bx-images"></i><span class="f-s-small">Gallery Images</span></a></li>
    @include('backend.includes.side-bar.menu.leader')
    @include('backend.includes.side-bar.menu.testimonials')
@endif
