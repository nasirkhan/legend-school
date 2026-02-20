<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="">
                    <a href="{{ route('student-profile') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Home</span>
{{--                        <img src="{{ asset($student->photo->url) }}" class="rounded img-thumbnail" alt="" width="150" height="150">--}}
                    </a>

                </li>

                <li class="">
                    <a href="{{ route('/') }}" class="waves-effect">
                        <i class="bx bx-globe"></i>
                        <span>Go to Main Site</span>
{{--                        <img src="{{ asset($student->photo->url) }}" class="rounded img-thumbnail" alt="" width="150" height="150">--}}
                    </a>

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

                <li><a href="{{ route('student-subject-list') }}" class=" waves-effect"><i class="bx bx-list-ul"></i><span>Subject List</span></a></li>

                <li><a href="{{ route('student-syllabus') }}" class=" waves-effect"><i class="bx bx-book"></i><span>Syllabus</span></a></li>
                <li><a href="{{ route('student-revision-worksheet') }}" class=" waves-effect"><i class="bx bx-book"></i><span>Revision Worksheet</span></a></li>

                @php($routine = classRoutine($student->class_id))

{{--                <li>--}}
{{--                    <a target="_blank" href="{{ isset($routine) ? asset($routine->url) : '#' }}" class=" waves-effect">--}}
{{--                        <i class="bx bx-edit"></i>--}}
{{--                        <span>Class Routine</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li><a href="{{ route('student-exam-schedule') }}" class=" waves-effect"><i class="bx bx-edit"></i><span>Exam Schedule</span></a></li>
                <li><a href="{{ route('academic-transcript') }}" class=" waves-effect"><i class="bx bxs-file"></i><span>Academic Transcript</span></a></li>

                <li><a href="{{ route('student-attendance-report') }}" class=" waves-effect"><i class="bx bxs-calendar"></i><span>Attendance Report</span></a></li>
                <li><a href="{{ route('student-class-performance') }}" class=" waves-effect"><i class="bx bx-book-open"></i><span>Class Performance</span></a></li>
                <li><a href="{{ route('student-home-work') }}" class=" waves-effect"><i class="bx bxs-book-content"></i><span>Home Work</span></a></li>
{{--                <li><a href="#" class=" waves-effect"><i class="bx bx-edit"></i><span>Teacher's Solved Scripts</span></a></li>--}}
                <li><a href="{{ route('student-detail-payment-report') }}" class=" waves-effect"><i class="bx bx-dollar-circle"></i><span>Payment Report</span></a></li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
