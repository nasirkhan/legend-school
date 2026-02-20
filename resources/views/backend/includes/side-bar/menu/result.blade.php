<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-edit"></i>
        <span class="f-s-small">Results</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('result',['from'=>'add']) }}"><span class="f-s-small">Result Add/Edit</span></a>
            <a href="{{ route('result',['from'=>'view']) }}"><span class="f-s-small">Result View</span></a>
            <a href="{{ route('result',['from'=>'old']) }}"><span class="f-s-small">Old Result View</span></a>
            @if(role()->code=='developer' || role()->code=='s_admin')
                <a href="{{ route('result',['from'=>'delete']) }}"><span class="f-s-small">Result Delete</span></a>
            @endif
            <a href="{{ route('result',['from'=>'merit']) }}"><span class="f-s-small">Exam Wise Merit List</span></a>
            <a href="{{ route('report-card-form') }}"><span class="f-s-small">Report Card</span></a>
            @if(role()->code=='developer' || role()->code=='s_admin')
                <a href="{{ route('academic-transcript-settings') }}"><span class="f-s-small">Transcript Settings</span></a>
            @endif
        </li>
    </ul>
</li>
