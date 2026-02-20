<table id="datatable" class="table table-bordered table-hover table-sm ">
    <thead>
    <tr>
        <th class="text-center" style="width: 45px">SL</th>
        <th>Name</th>
        <th>ID</th>
        <th>Father Mob.</th>
        <th>Mother Mob.</th>
        <th style="">Description</th>
        <th class="text-right">Amount</th>
    </tr>
    </thead>
    <tbody>
    @php($totalDue = 0)
    @if(count($students)>0)
        @foreach($students as $student)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $student['info']->name }}</td>
                <td>{{ $student['info']->roll }}</td>
                <td>{{ $student['info']->father_mobile }}</td>
                <td>{{ $student['info']->mother_mobile }}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($student['invoices'] as $invoice)
                            @if(isset($invoice->previousDue))
                                @php($previousDue = $invoice->previousDue)
                                <li>Previous Due({{ $previousDue->description }}) - {{ numberFormat($previousDue->receivable) }}</li>
                            @endif

                            @foreach($invoice->activeDetails as $activeDetail)
                                @php($item = $activeDetail->classItem->item)
                                <li>
{{--                            <span>--}}
                                @if($item->billing_cycle==3)
                                    {{ $item->name }} ({{ $activeDetail->month->name }}) - {{ numberFormat($activeDetail->receivable_amount) }}
                                @else
                                    {{ $item->name }} - {{ numberFormat($activeDetail->receivable_amount) }}
                                @endif
{{--                            </span><br>--}}

                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                </td>
                <td class="p-0 text-right">
                    {{ numberFormat($due = $student['invoices']->sum('receivable_amount')) }}
                    @php($totalDue += $due)
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr class="text-danger">
        <th colspan="6" class="text-center">Total</th>
        <th class="text-right">{{ numberFormat($totalDue) }}</th>
    </tr>
    </tfoot>
</table>

<script>
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // console.log("Tab is active");
            getDueReport()
        }
    });
</script>
