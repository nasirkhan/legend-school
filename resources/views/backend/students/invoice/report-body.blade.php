@php($class = $monthlyFee->class)
@php($colspan = 2)
<div class="wrapper" style="position: relative">

    <table class="invoice-table">
        <tbody id="invoice-rows">
        <tr>
            <td><span class="f-w-bold">Name:</span> {{ $student->name }}</td>
            <td class="text-center"><span class="f-w-bold">ID:</span> {{ $student->roll }}</td>
            <td class="text-center"><span class="f-w-bold">Class:</span> {{ $class->code }}</td>
            <td class="text-center"><span class="f-w-bold">Session:</span>
                {{ $monthlyFee->year }}-{{ $monthlyFee->year+1 }}
            </td>
        </tr>
        </tbody>
    </table>

    <table class="invoice-table" style="margin-bottom: 5pt">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Reference</th>
            <th>Description</th>
            <th>Status</th>
            <th class="text-right">Amount (BDT)</th>
        </tr>
        </thead>
        <tbody id="invoice-rows">
        @php($total = 0)
        @foreach($studentPaymentItems as $studentPaymentItem)
            @php($item = $studentPaymentItem->item)
            @php($lateFeeInfo = checkLateFee($studentPaymentItem->id))
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    @if($item->billing_cycle==1 or $item->billing_cycle==2)
                        <b>
                            {{ $studentPaymentItem->year }} - {{ $studentPaymentItem->year+1 }}
                        </b>
                    @elseif($item->billing_cycle==3)
                        <b>
                            {{ $studentPaymentItem->month->name }} - {{ dateFormat($studentPaymentItem->due_date,'Y') }}
                        </b>
                    @endif
                </td>

                <td>

{{--                    @if($item->billing_cycle==3)--}}
{{--                      <b> Month : {{ $studentPaymentItem->month->name }} - {{ dateFormat($studentPaymentItem->due_date,'Y') }}</b>--}}
{{--                    @endif--}}

                    @if($item->billing_cycle !==3)
                        <ul style="padding-left: 15px">
                            <li>{{ $item->name }} : {{ numberFormat($studentPaymentItem->amount) }}/-</li>

                            @if($studentPaymentItem->discount>0)
                                <li>Discount : (-) {{ numberFormat($studentPaymentItem->discount) }}/-</li>
                            @endif
                        </ul>
                    @else
                        <ul style="padding-left: 15px">
                            <li>{{ $item->name }} : {{ numberFormat($studentPaymentItem->amount) }}/-</li>

                            @if($studentPaymentItem->discount>0)
                                <li>Discount : (-) {{ numberFormat($studentPaymentItem->discount) }}/-</li>
                            @endif

                            @if($studentPaymentItem->lab_fee>0)
                                <li>Lab Fee : (+) {{ numberFormat($studentPaymentItem->lab_fee) }}/-</li>
                            @endif

                            @if($studentPaymentItem->late_fee>0)
                                <li>Late Fee : (+) {{ numberFormat($studentPaymentItem->late_fee) }}/-</li>
                            @endif
                        </ul>
                    @endif
                </td>
                <td class="text-center">
                    @php($paymentStatus = studentPaymentItemStatus($studentPaymentItem->id))
                    @if(isset($paymentStatus))
                        <span style="color: {{ $paymentStatus['color'] }}; font-weight: {{ $paymentStatus['bold'] }}">{{ $paymentStatus['status'] }}</span>
                    @endif
                </td>
                <td class="text-right">{{ numberFormat( $itemTotal = ($studentPaymentItem->amount+$studentPaymentItem->lab_fee+$studentPaymentItem->late_fee-$studentPaymentItem->discount)) }}/-</td>
            </tr>

            @php($total += $itemTotal)
        @endforeach

        <tr>
            <td class="text-center" colspan="4">
                <span style="font-weight: bold">Total</span>
            </td>
            <td class="text-right" style="font-weight: bold">{{ numberFormat($total) }}/-</td>
        </tr>
        <tr>
            <th colspan="5" style="text-transform: capitalize">In words: {{ convertNumberToWord($total) }} Taka only</th>
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
                {{ date('jS M Y') }}
            </td>
            <td class="b-none" style="width: 33.34%"></td>
            <td class="b-x-none b-t-none text-center" style="width: 33.33%">
            <span class="text-uppercase f-w-bold">{{ siteInfo('invoice_signatory') }}</span>
            </td>
        </tr>
        <tr>
            <td class="b-none" style="text-align: center !important;">Report Date</td>
            <td class="b-none"></td>
            <td class="b-none" style="text-align: center !important;">Head Of Accounts</td>
        </tr>
    </table>

</div>


