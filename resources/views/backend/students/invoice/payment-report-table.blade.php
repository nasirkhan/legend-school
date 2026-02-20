<table id="datatable_" class="table table-bordered table-hover table-sm">
    <thead>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Stdn. ID</th>
        <th>Inv. No.</th>
        <th style="width: 280px">Description</th>
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
                <td>{{ $invoice->student->roll }}</td>
                <td>{{ $invoice->invoice_no }}</td>
                <td>
                    <ul class="mb-0">
                        @if(isset($invoice->previousDue))
                            @php($previousDue = $invoice->previousDue)
                            <li>
                                Previous Due ({{ $previousDue->description }})
                            </li>
                        @endif



                        @foreach($invoice->activeDetails as $detail)
                            @php($paymentItem = $detail->classItem->item)
                            <li>
                                {{ $paymentItem->name }}
                                @if($paymentItem->billing_cycle==2)
                                    {{ $invoice->year }} - {{ $invoice->year+1 }}
                                @elseif($paymentItem->billing_cycle==3)
                                    ({{ $detail->month->name }})
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-right">{{ numberFormat($invoice->receivable_amount) }}</td>
                <td class="text-center">
                    <a href="{{ route('student-invoice', ['id'=>$invoice->id]) }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-eye"></i> View
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    @if(count($invoices)>0)
        <tfoot>
        <tr>
            <th colspan="5" class="text-center">Total</th>
            <th class="text-right">{{ numberFormat($invoices->sum('receivable_amount')) }}</th>
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
