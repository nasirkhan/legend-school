<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bxs-edit-alt"></i>
        <span class="f-s-small">Payment Report</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        <li class="">
            <a href="{{ route('report-form',['from'=>'payment','type'=>'date-to-date']) }}"><span class="f-s-small">Date Wise Collection</span></a>
            <a href="{{ route('report-form',['from'=>'payment','type'=>'batch-wise']) }}"><span class="f-s-small">Batch Wise Collection</span></a>
        </li>
    </ul>
</li>
