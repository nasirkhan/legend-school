<li class="menu-title f-s-small">Operations</li>
@include('backend.includes.side-bar.menu.student-manage')
@include('backend.includes.side-bar.menu.account-manage')
@include('backend.includes.side-bar.menu.teacher-manage')
@include('backend.includes.side-bar.menu.attendance')
@include('backend.includes.side-bar.menu.syllabus')
<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-file"></i><span class="f-s-small">HW Management</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('hw-add-form') }}"><span class="f-s-small">HW Add</span></a>
            {{--            <a href="{{ route('student-list',['from'=>'school']) }}"><span class="f-s-small">School & Class Wise List</span></a>--}}
            <a href="{{ route('class-wise-hw-list') }}"><span class="f-s-small">HW List</span></a>
        </li>
    </ul>
</li>
@include('backend.includes.side-bar.menu.result')
@include('backend.includes.side-bar.menu.academic-transcript')
@include('backend.includes.side-bar.menu.message')
{{--@include('backend.includes.side-bar.menu.payment')--}}


