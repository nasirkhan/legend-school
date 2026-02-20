<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bxs-message-dots"></i>
        <span class="f-s-small">Message</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
{{--            <a href="{{ route('message-form',['from'=>'new']) }}"><span class="f-s-small">New Message</span></a>--}}
{{--            <a href="{{ route('message-form',['from'=>'sent']) }}"><span class="f-s-small">Sent Messages</span></a>--}}
{{--            <a href="{{ route('message-form',['from'=>'unsent']) }}"><span class="f-s-small">Unsent Messages</span></a>--}}
            <a href="{{ route('message-form',['from'=>'password']) }}"><span class="f-s-small">Send Password</span></a>
        </li>
    </ul>
</li>
