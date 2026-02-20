@php($student = $invoice->student)
@php($class = $invoice->class)
@php($details = $invoice->studentPaymentItems)
@php($colspan = 2)
<div class="wrapper" style="position: relative">
    {{--Invoice Status--}}
    <div class="" style="z-index: 1000; position: absolute; top: 40%; left: 50%; transform: translate(-50%,-50%) rotate(-45deg)">
        @if($invoice->status==1)
            <h5 style="font-size: 50px; opacity: 0.3; color: green">PAID</h5>
        @elseif($invoice->status==2)
            <h5 style="font-size: 50px; opacity: 0.3; color: red">UNPAID</h5>
        @elseif($invoice->status==3)
            <h5 style="font-size: 50px; opacity: 0.3; color: red">DELETED</h5>
        @endif
    </div>

    <table class="invoice-table">
        <tbody id="invoice-rows">
        <tr>
            <td><span class="f-w-bold">Name:</span> {{ $student->name }}</td>
            <td class="text-center"><span class="f-w-bold">ID:</span> {{ $student->roll }}</td>
            <td class="text-center"><span class="f-w-bold">Class:</span> {{ $class->code }}</td>
            <td class="text-center"><span class="f-w-bold">Session:</span>
                {{ $details[0]->year }}-{{ $details[0]->year+1 }}
            </td>
            <td class="text-center"><span class="f-w-bold">Inv. No:</span>
                {{ $invoice->invoice_number }}
            </td>
        </tr>
        </tbody>
    </table>

    <table class="invoice-table" style="margin-bottom: 5pt">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Description</th>
            <th>Reference</th>
            <th class="text-right">Amount (BDT)</th>
        </tr>
        </thead>
        <tbody id="invoice-rows">
        @php($sl=1)
        @foreach($details as $detail)
            @php($paymentItem = $detail->item)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>
                   @if($paymentItem->billing_cycle==3)
                        <ul style="padding-left: 15px">
{{--                            <li>{{ $paymentItem->name }} : {{ numberFormat($detail->receivable) }}/-</li>--}}
                            <li>{{ $paymentItem->name }} : {{ numberFormat($detail->amount - $detail->discount) }}/-</li>

                            @if($detail->lab_fee>0)
                                <li>Lab Fee : {{ numberFormat($detail->lab_fee) }}/-</li>
                            @endif

                            @if($detail->late_fee>0)
                                <li>Late Fee : {{ numberFormat($detail->late_fee) }}/-</li>
                            @endif
                        </ul>
                    @else
                        {{ $paymentItem->name }}

{{--                        @if($detail->lab_fee>0)--}}
{{--                            + Lab Fee : {{ numberFormat($detail->lab_fee) }}--}}
{{--                        @endif--}}

{{--                        @if($detail->late_fee>0)--}}
{{--                            + Late Fee : {{ numberFormat($detail->late_fee) }}--}}
{{--                        @endif--}}
                   @endif
                </td>

                <td>
                    @if($paymentItem->billing_cycle==3)
                        {{ $detail->month->name }} - {{ dateFormat($detail->due_date,'Y') }}
                    @elseif($paymentItem->billing_cycle==2)
                        {{ $detail->year }} - {{ $detail->year+1 }}
                    @endif
                </td>

                <td class="text-right">
                    {{ numberFormat($detail->receivable+$detail->late_fee) }}/-
                </td>
            </tr>
        @endforeach

        <tr>
            <th colspan="3" class="text-right">Total</th>
            <th class="text-right">{{ numberFormat($invoice->amount) }}/-</th>
        </tr>
        @if($invoice->discount>0)
            <tr>
                <td colspan="3" class="text-right">Discount</td>
                <td class="text-right">(-) {{ numberFormat($invoice->discount) }}/-</td>
            </tr>
        @endif
        <tr>
            <th colspan="3" class="text-right">Received</th>
            <th class="text-right">{{ numberFormat($invoice->received) }}/-</th>
        </tr>

        <tr>
            <td colspan="4"><strong>In Word:</strong> <span class="font-weight-normal" style="text-transform: capitalize">{{ convertNumberToWord($invoice->received) }} taka only.</span></td>
        </tr>

        <tr>
            <td colspan="4" class="b-none" style="padding-top: 20px">
                <strong>Important Note:</strong>
                <ul class="" style="padding-left: 15px">
                    <li>Tk. 500/- will be added as a late fee after the 10th of the month.</li>
                    <li>Tk. 750/- will be added as a late fee after the end of the month.</li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="invoice-table">
        <tr>
            <td class="b-x-none b-t-none f-w-bold text-center" style="width: 33.33%">
                @if($invoice->status==2)
                    &nbsp;
                @else
{{--                    @if($invoice->status === 1 and $invoice->payment_date === null)--}}

{{--                    @else--}}
{{--                        --}}
{{--                    @endif--}}
                        {{ dateFormat($invoice->created_at,'jS M Y') }}
                @endif
            </td>
            <td class="b-none" style="width: 33.34%"></td>
            <td class="b-x-none b-t-none text-center" style="width: 33.33%">
            <span class="text-uppercase f-w-bold">{{ siteInfo('invoice_signatory') }}</span>
            </td>
        </tr>
        <tr>
            <td class="b-none" style="text-align: center !important;">Payment Date</td>
            <td class="b-none"></td>
            <td class="b-none" style="text-align: center !important;">Head Of Accounts</td>
        </tr>
    </table>

</div>


