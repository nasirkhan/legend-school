<li class="menu-title"><span class="f-s-small">Settings</span></li>
@if(role()->code=='developer')
    <li><a href="{{ route('users') }}" class=" waves-effect"><i class="bx bxs-school"></i><span class="f-s-small">User Management</span></a></li>
    <li><a href="{{ route('sections') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Section Management</span></a></li>
    <li><a href="{{ route('classes') }}" class=" waves-effect"><i class="bx bxs-bank"></i><span class="f-s-small">Class Management</span></a></li>
<li><a href="{{ route('subjects') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Subject Management</span></a></li>

<li><a href="{{ route('exams') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Exam Management</span></a></li>
<li><a href="{{ route('papers') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Paper Management</span></a></li>
<li><a href="{{ route('exam-components') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Component Management</span></a></li>
<li><a href="{{ route('eca-types') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">ECA Type Management</span></a></li>
<li><a href="{{ route('eca-items') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">ECA Item Management</span></a></li>

{{--@include('backend.includes.side-bar.menu.class-routine')--}}

{{--    <li><a href="{{ route('batches') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Batch Management</span></a></li>--}}
<li><a href="{{ route('years') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Academic Year</span></a></li>
<li><a href="{{ route('months') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Month Management</span></a></li>
<li><a href="{{ route('days') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Day Management</span></a></li>
<li><a href="{{ route('periods') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Period Management</span></a></li>
<li><a href="{{ route('academic-sessions') }}" class=" waves-effect"><i class="bx bx-link"></i><span class="f-s-small">Academic Session</span></a></li>
<li><a href="{{ route('site-info') }}" class=" waves-effect"><i class="bx bxs-ruler"></i><span class="f-s-small">Site Options</span></a></li>
@endif

