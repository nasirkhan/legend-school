<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="">
                    @if(Auth::user())
                        <a href="{{ route('dashboard') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span>Dashboard</span>
                            {{--                        <img src="{{ asset($student->photo->url) }}" class="rounded img-thumbnail" alt="" width="150" height="150">--}}
                        </a>
                    @else
                        <a href="{{ route('/') }}" class="waves-effect"><i class="bx bx-planet"></i>
                            <span>Go to Web Site</span>
                        </a>

                        <a href="{{ route('teacher-profile') }}" class="waves-effect"><i class="bx bx-home-circle"></i>
                            <span>My Profile</span>
                        </a>
                    @endif
                </li>

                <li class="menu-title">Apps</li>

{{--                <li>--}}
{{--                    <a href="#" class=" waves-effect">--}}
{{--                        <i class="bx bx-calendar"></i>--}}
{{--                        <span>Academic Calendar</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li>--}}
{{--                    <a href="{{ route('student-subject-choice-form') }}" class=" waves-effect">--}}
{{--                        <i class="bx bx-edit"></i>--}}
{{--                        <span>Subject Choice</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                <li><a href="{{ route('teacher-subject-list',['id'=>$teacher->id]) }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Class & Subject</span></a></li>--}}

                <li><a href="{{ route('teacher-schedule') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Class Routine</span></a></li>
                <li><a href="{{ route('class-activity') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Student Performance</span></a></li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i><span class="f-s-small">Class Activity</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="">
                            <a href="{{ route('teacher-class-activity-add-form') }}"><i class="bx bx-plus"></i><span class="f-s-small">Activity Add</span></a>
                            <a href="{{ route('teacher-class-wise-cw-list') }}"><i class="bx bx-list-ul"></i><span class="f-s-small">Activity List</span></a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i><span class="f-s-small">HW Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="">
                            <a href="{{ route('teacher-hw-add-form') }}"><i class="bx bx-plus"></i><span class="f-s-small">HW Add</span></a>
                            {{--            <a href="{{ route('student-list',['from'=>'school']) }}"><span class="f-s-small">School & Class Wise List</span></a>--}}
                            <a href="{{ route('teacher-class-wise-hw-list') }}"><i class="bx bx-list-ul"></i><span class="f-s-small">HW List</span></a>
                            <a href="{{ route('students-hw-check-by-teacher') }}"><i class="bx bx-list-ul"></i><span class="f-s-small">Students HW</span></a>
                            <a href="{{ route('returned-hw-form') }}"><i class="bx bx-list-ul"></i><span class="f-s-small">Returned HW</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-file"></i><span class="f-s-small">Syllabus Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li class="">
                            <a href="{{ route('syllabus-add-by-teacher') }}"><i class="bx bx-edit"></i><span class="f-s-small">Add New</span></a>
                            <a href="{{ route('syllabus-view-by-teacher') }}"><i class="bx bx-edit"></i><span class="f-s-small">View All</span></a>
                        </li>
                    </ul>
                </li>
{{--                <li><a href="{{ route('student-home-work') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Home Work</span></a></li>--}}
{{--                <li><a href="{{ route('student-syllabus') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Syllabus</span></a></li>--}}

{{--                @php($routine = classRoutine($student->class_id))--}}

{{--                <li>--}}
{{--                    <a target="_blank" href="{{ isset($routine) ? asset($routine->url) : '#' }}" class=" waves-effect">--}}
{{--                        <i class="bx bx-edit"></i>--}}
{{--                        <span>Class Routine</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li><a href="{{ route('student-exam-schedule') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Exam Schedule</span></a></li>--}}
{{--                <li><a href="{{ route('academic-transcript') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Academic Transcript</span></a></li>--}}

{{--                <li><a href="{{ route('student-attendance-report') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Attendance Report</span></a></li>--}}
{{--                --}}
{{--                <li><a href="#" class=" waves-effect"><i class="bx bx-edit"></i><span>Teacher's Solved Scripts</span></a></li>--}}
{{--                <li><a href="#" class=" waves-effect"><i class="bx bx-edit"></i><span>Payment Report</span></a></li>--}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
