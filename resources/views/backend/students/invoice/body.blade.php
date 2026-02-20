@php($student = $invoice->student)
@php($class = $invoice->activeDetails[0]->classItem->class)
@php($details = $invoice->activeDetails)
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
            <td class="text-center"><span class="f-w-bold">Session:</span> {{ $invoice->year }}-{{ $invoice->year+1 }}</td>
            <td class="text-center"><span class="f-w-bold">Inv. No:</span> {{ $invoice->invoice_no }}</td>
        </tr>
        </tbody>
    </table>

    <table class="invoice-table" style="margin-bottom: 5pt">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Description</th>
{{--            @if($invoice->invoice_type==3)--}}
{{--                @php($colspan +=1)--}}
{{--                <th>Reference</th>--}}
{{--            @endif--}}
            <th>Reference</th>
            <th class="text-right">Amount (BDT)</th>
        </tr>
        </thead>
        <tbody id="invoice-rows">
        @php($sl=1)

        @php($previousDueAmount = 0)
        @if(isset($invoice->previousDue))
            @php($previousDue = $invoice->previousDue)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>Previous Due</td>
                <td>{{ $previousDue->description }}</td>
                <td class="text-right">{{ numberFormat($previousDueAmount = $previousDue->receivable) }}</td>
            </tr>
        @endif


        @foreach($details as $detail)
            @php($paymentItem = $detail->classItem->item)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $paymentItem->name }}</td>

                <td>
                    @if($paymentItem->billing_cycle==3)
                        {{ $detail->month->name }}
                    @elseif($paymentItem->billing_cycle==2)
                        {{ $invoice->year }} - {{ $invoice->year+1 }}
                    @endif
                </td>

                <td class="text-right">{{ numberFormat($detail->receivable_amount) }}</td>
            </tr>
        @endforeach

        @php($fine=0) @php($fineDiscount=0)

        @if($invoice->status==1)
            @if(isset($invoice->fine) and $invoice->invoice_type==3)
                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ 'Late Fee' }}</td>
                    <td>{{ $invoice->fine->delay }}</td>
                    @php($fine=$invoice->fine->amount)
                    <td class="text-right">{{ numberFormat($fine) }}</td>
                </tr>

                @if($invoice->fine->discount>0)
                    <tr>
                        <td>{{ ++$sl }}</td>
                        <td>{{ 'Discount' }}</td>
                        <td>Late Fee</td>
                        @php($fineDiscount=$invoice->fine->discount)
                        <td class="text-right">{{ numberFormat($fineDiscount) }}</td>
                    </tr>
                @endif
            @endif
        @elseif($invoice->status=2)
            @php($delay = invoiceDelay($invoice->deadline))
            @if($delay>0)

                @php($lateFee = lateFee($invoice->id))

                <tr>
                    <td>{{ ++$sl }}</td>
                    <td>{{ 'Late Fee' }}</td>
                    <td>{{ $lateFee['reference'] }}</td>
{{--                    @php($fine=$delay*siteInfo('daily_fine'))--}}
                    @php($fine=$lateFee['fine'])
                    <td class="text-right">{{ numberFormat($fine) }}</td>
                </tr>
            @endif
        @endif

        @php($total = $previousDueAmount + $details->sum('receivable_amount')+$fine-$fineDiscount)

        <tr>
            <td class="text-center" colspan="3"><strong>Total</strong></td>
            <td class="text-right"><strong>{{ numberFormat($total) }}</strong></td>
        </tr>
        <tr>
            <td colspan="2"><strong>In Word:</strong> <span class="font-weight-normal" style="text-transform: capitalize">{{ convertNumberToWord($total) }} taka only</span></td>
            <td class="text-center" colspan="2">
                @php($dueDate = invoiceDueDate($invoice->id))
                <strong>Last date of payment : </strong> {{ dateFormat($dueDate,'jS M Y') }}
            </td>
        </tr>
        @if($invoice->invoice_type==3)
            <tr>
                <td colspan="3" class="b-none" style="padding-top: 20px">
                    <strong>Important Note:</strong>
                    <ul class="" style="padding-left: 15px">
                        @php($secondDueDate = secondInvoiceDueDate($invoice->id))
                        <li>Tk.500/- will be added as a late fee after {{ dateFormat($dueDate,'jS M Y') }}</li>
                        <li>Tk.750/- will be added as a late fee after {{ dateFormat($secondDueDate,'jS M Y') }}</li>
                    </ul>
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    <table class="invoice-table">
        <tr>
            <td class="b-x-none b-t-none f-w-bold text-center" style="width: 33.33%">
                @if($invoice->status==2)
                    &nbsp;
                @else
                    @if($invoice->status==1 and $invoice->payment_date==null)
                        {{ dateFormat($invoice->payments[0]->payment_date,'jS M y') }}
                    @else
                        {{ dateFormat($invoice->payment_date,'jS M y') }}
                    @endif
                @endif
            </td>
            <td class="b-none" style="width: 33.34%"></td>
            <td class="b-x-none b-t-none text-center" style="width: 33.33%">
{{--                &nbsp;--}}
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


