
{{--<li><a href="{{ route('syllabus') }}" class=" waves-effect"><i class="bx bx-file"></i><span class="f-s-small">Syllabus Management</span></a></li>--}}

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-file"></i><span class="f-s-small">Syllabus Management</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('syllabus-add-form') }}"><span class="f-s-small">Syllabus Add</span></a>
            {{--            <a href="{{ route('student-list',['from'=>'school']) }}"><span class="f-s-small">School & Class Wise List</span></a>--}}
            <a href="{{ route('syllabus') }}"><span class="f-s-small">Syllabus List</span></a>
        </li>
    </ul>
</li>
