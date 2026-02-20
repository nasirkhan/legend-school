<li class="menu-title f-s-small">Account Management</li>
<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-dollar"></i><span class="f-s-small">Fees Management</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        @if(user()->role->code=='developer')
            <li class=""><a href="{{ route('items') }}"><span class="f-s-small">Transaction Item</span></a></li>
            <li class=""><a href="{{ route('class-wise-items') }}"><span class="f-s-small">Class Wise Item</span></a></li>

{{--            <li class=""><a href="{{ route('invoice-creation-form') }}"><span class="f-s-small">Invoice Creation</span></a></li>--}}
{{--            <li class=""><a href="{{ route('invoice-check-form') }}"><span class="f-s-small">Check Unpaid Invoices</span></a></li>--}}
{{--            <li class=""><a href="{{ route('payment-collection-form') }}"><span class="f-s-small">Payment Collection Old</span></a></li>--}}
{{--            <li class=""><a href="{{ route('payment-collection-report') }}"><span class="f-s-small">Payment Report Old</span></a></li>--}}
{{--            <li class=""><a href="{{ route('due-report-form') }}"><span class="f-s-small">Due Report Old</span></a></li>--}}
        @endif

        <li class=""><a href="{{ route('fees-form') }}"><span class="f-s-small">Student Fees</span></a></li>
        <li class=""><a href="{{ route('payment-collection-form-new') }}"><span class="f-s-small">Payment Collection</span></a></li>
        <li class=""><a href="{{ route('payment-collection-report-new') }}"><span class="f-s-small">Payment Report</span></a></li>
        <li class=""><a href="{{ route('due-report-form-new') }}"><span class="f-s-small">Item Wise Due Report</span></a></li>
        <li class=""><a href="{{ route('class-wise-payment-report') }}"><span class="f-s-small">Class Wise Due Report</span></a></li>
    </ul>
</li>

<li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-dollar"></i><span class="f-s-small">Other Income-Expense</span>
    </a>
    <ul class="sub-menu" aria-expanded="false">
        @if(user()->role->code=='developer' or user()->role->code=='s_admin' or user()->role->code=='accountant')
            <li class=""><a href="{{ route('create-expense') }}"><span class="f-s-small">Make Transaction</span></a></li>
            <li class=""><a href="{{ route('date-wise-expense-report') }}"><span class="f-s-small">Date Wise Transactions</span></a></li>
            <li class=""><a href="{{ route('month-wise-expense-report') }}"><span class="f-s-small">Monthly Transactions</span></a></li>
            <li class=""><a href="{{ route('item-wise-expense-report') }}"><span class="f-s-small">Item Wise Transactions</span></a></li>
            <li class=""><a href="{{ route('expense-items') }}"><span class="f-s-small">Income-Expense Items</span></a></li>
            <li class=""><a href="{{ route('beneficiaries') }}"><span class="f-s-small">Account Holders</span></a></li>
        @endif
    </ul>
</li>

