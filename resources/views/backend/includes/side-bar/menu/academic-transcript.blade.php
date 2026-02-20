<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-edit"></i>
        <span class="f-s-small">Academic Transcript</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class=""><a href="{{ route('school-transcript',['from'=>'regular']) }}"><span class="f-s-small">Regular Student</span></a></li>
        <li class=""><a href="{{ route('school-transcript',['from'=>'private']) }}"><span class="f-s-small">Private Student</span></a></li>
    </ul>
</li>
