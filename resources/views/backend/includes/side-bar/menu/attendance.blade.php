<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-calendar"></i>
        <span class="f-s-small">Attendances</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <span class="f-s-small">Regular Attendance</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="">
                    <a href="{{ route('attendance',['from'=>'regular', 'type'=>'add']) }}"><span class="f-s-small">Add/Edit</span></a>
                    <a href="{{ route('attendance',['from'=>'regular', 'type'=>'view']) }}"><span class="f-s-small">Report</span></a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <span class="f-s-small">Exam Attendance</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="">
                    <a href="{{ route('attendance',['from'=>'exam', 'type'=>'add']) }}"><span class="f-s-small">Add/Edit</span></a>
                    <a href="{{ route('attendance',['from'=>'exam', 'type'=>'view']) }}"><span class="f-s-small">Report</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <span class="f-s-small">Payment Attendance</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li class="">
                    <a href="{{ route('attendance',['from'=>'payment', 'type'=>'add']) }}"><span class="f-s-small">Add/Edit</span></a>
                    <a href="{{ route('attendance',['from'=>'payment', 'type'=>'view']) }}"><span class="f-s-small">Report</span></a>
                </li>
            </ul>
        </li>
    </ul>
</li>
