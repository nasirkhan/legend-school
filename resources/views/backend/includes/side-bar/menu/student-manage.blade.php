<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-user-circle"></i><span class="f-s-small">Student Management</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('student-registration') }}"><span class="f-s-small">Registration</span></a>
{{--            <a href="{{ route('student-list',['from'=>'school']) }}"><span class="f-s-small">School & Class Wise List</span></a>--}}
            <a href="{{ route('student-list',['from'=>'class']) }}"><span class="f-s-small">Class & Section Wise List</span></a>
            <a href="{{ route('attendance-report') }}"><span class="f-s-small">Attendance Report</span></a>
            <a href="{{ route('promotion-form') }}"><span class="f-s-small">Promotion to Next Class </span></a>
        </li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bxs-file"></i><span class="f-s-small">Academic Supervision</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('daily-academic-report') }}"><span class="f-s-small">Daily Report</span></a>
{{--            <a href="{{ route('date-wise-academic-report') }}"><span class="f-s-small">Date Wise Report</span></a>--}}
        </li>
    </ul>
</li>

