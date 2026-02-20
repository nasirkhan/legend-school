<table id="datatable_" class="table table-bordered table-hover table-sm">
    <thead>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Class</th>
        <th>Stdn. ID</th>
        <th>Date</th>
        <th>Inv. No.</th>
        <th style="width: 280px">Description</th>
        <th style="">Media</th>
        <th class="text-right">Amount</th>
        <th class="text-center" style="width: 80px">Options</th>
    </tr>
    </thead>
    <tbody>
    @if(count($invoices)>0)
        @foreach($invoices as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->student->name }}</td>
                <td>{{ $invoice->class->name }}</td>
                <td>{{ $invoice->student->roll }}</td>
                <td>{{ dateFormat($invoice->created_at,'d/m/Y') }}</td>
                <td>{{ $invoice->invoice_number }}</td>
                <td>
                    <ul class="mb-0">
{{--                        @if(isset($invoice->previousDue))--}}
{{--                            @php($previousDue = $invoice->previousDue)--}}
{{--                            <li>--}}
{{--                                Previous Due ({{ $previousDue->description }})--}}
{{--                            </li>--}}
{{--                        @endif--}}



                        @foreach($invoice->studentPaymentItems as $detail)
                            @php($paymentItem = $detail->item)
                            <li>
                                {{ $paymentItem->name }}
{{--                                @if($paymentItem->billing_cycle==2)--}}
{{--                                    {{ $invoice->year }} - {{ $invoice->year+1 }}--}}
                                @if($paymentItem->billing_cycle==3)

                                     ({{ $detail->month->name }} - {{ dateFormat($detail->due_date,'Y') }})
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @foreach($invoice->methods as $method)
                        {{ $method->method == 1 ? 'Cash,':'' }}
                        {{ $method->method == 2 ? 'bKash-'.$method->transaction_id.',':'' }}
                        {{ $method->method == 3 ? 'Nagad-'.$method->transaction_id.',':'' }}
                        {{ $method->method == 4 ? 'Bank-'.$method->transaction_id.',':'' }}
                    @endforeach
                </td>
                <td class="text-right">
                    {{ numberFormat($invoice->received) }}
                </td>
                <td class="text-center">
                    <a href="{{ route('student-invoice-new', ['id'=>$invoice->id]) }}" class="btn btn-sm btn-secondary" title="View Invoice">
                        <i class="fa fa-eye"></i>
{{--                        View--}}
                    </a>

{{--                    <a href="{{ route('student-invoice-edit-new', ['id'=>$invoice->id]) }}" class="btn btn-sm btn-primary" title="Edit Invoice">--}}
{{--                        <i class="fa fa-edit"></i>--}}
{{--                        Edit--}}
{{--                    </a>--}}

                    <a href="{{ route('student-invoice-delete-new', ['id'=>$invoice->id]) }}" class="btn btn-sm btn-danger" title="Delete Invoice" onclick="return confirm('Are you sure to delete this invoice?');">
                        <i class="fa fa-trash-alt"></i>
{{--                        Edit--}}
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    @if(count($invoices)>0)
        <tfoot>
        <tr>
            <th colspan="8" class="text-center">Total</th>
            <th class="text-right">{{ numberFormat($invoices->sum('received')) }}</th>
            <th class="text-center">--</th>
        </tr>
        </tfoot>
    @endif
</table>

<script>
    // document.addEventListener("visibilitychange", function () {
    //     if (document.visibilityState === "visible") {
    //         // console.log("Tab is active");
    //         getClassWiseStudentInvoice()
    //     }
    // });
</script>
