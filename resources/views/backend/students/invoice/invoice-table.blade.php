<table id="datatable_" class="table table-bordered table-hover table-sm">
    <thead>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>ID</th>
        <th style="">Invoices</th>
    </tr>
    </thead>
    <tbody>
    @if(count($students)>0)
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student['info']->name }}</td>
                <td>{{ $student['info']->roll }}</td>
                <td class="p-0">
                    @foreach($student['invoices'] as $invoice)
                        <table class="table table-sm mb-0">
                            <tr>
                                <th>
                                    Inv No: {{ $invoice->invoice_no }}
                                </th>
                                <th>
                                    <span class="badge badge-{{ $invoice->status==1? 'success':'warning' }}">{{ $invoice->status==1? 'Paid':'Unpaid' }}</span>
                                </th>
                                <th style="width: 160px" rowspan="{{ count($invoice->activeDetails)+2 }}">
                                    <a target="_blank" href="{{ route('student-invoice',['id'=>$invoice->id]) }}" class="btn btn-sm btn-secondary mb-2">View</a>
                                    @if($invoice->status==2)
                                        <a href="{{ route('student-invoice-edit',['id'=>$invoice->id]) }}" class="btn btn-sm btn-primary mb-2">Edit</a>
                                        <a href="{{ route('payment-collection-form',['invoice_id'=>$invoice->id]) }}" class="btn btn-sm btn-info mb-2">Collect</a>
                                        @if(user()->role->name=='Developer')
                                            <a href="{{ route('student-invoice-delete',['id'=>$invoice->id]) }}"
                                               class="btn btn-sm btn-danger mb-2" onclick="return confirm('Are you sure to delete?')"
                                            >
                                                Delete
                                            </a>
                                        @endif
                                    @endif
                                </th>
                            </tr>
                            @foreach($invoice->activeDetails as $activeDetail)
                                @php($item = $activeDetail->classItem->item)
                                <tr>
                                    <td>
                                        {{ $item->name }}
                                        @if($item->billing_cycle==3)
                                            ({{ $activeDetail->month->name }})
                                        @endif
                                    </td>
                                    <td class="text-right">{{ numberFormat($activeDetail->receivable_amount) }}</td>
                                </tr>
                            @endforeach

                            @if(isset($invoice->previousDue))
                                @php($previousDue = $invoice->previousDue)
                                <tr>
                                    <td>Previous Due({{ $previousDue->description }})</td>
                                    <td class="text-right">{{ numberFormat($previousDue->receivable) }}</td>
                                </tr>
                            @endif


                            <tr>
                                <td class="font-weight-bold">Total</td>
                                <td class="text-right font-weight-bold">{{ numberFormat($invoice->receivable_amount) }}</td>
                            </tr>
                        </table>
                    @endforeach
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<script>
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // console.log("Tab is active");
            getClassWiseStudentInvoice()
        }
    });
</script>
