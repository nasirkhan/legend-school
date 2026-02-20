<table id="datatable" class="table table-bordered table-hover table-sm ">
    <thead>
    <tr>
        <th class="text-center" style="width: 45px">SL</th>
        <th>Name</th>
        <th>ID</th>
        <th>Class</th>
        <th>Father Mob.</th>
        <th>Mother Mob.</th>
        <th style="">Description</th>
        <th class="text-right">Amount</th>
    </tr>
    </thead>
    <tbody>
    @php($totalDue = 0)
    @if(count($studentPaymentItems)>0)
        @foreach($studentPaymentItems as $studentPaymentItem)
            @php($student = $studentPaymentItem->student)
            @php($item = $studentPaymentItem->item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->roll }}</td>
                <td>{{ $studentPaymentItem->class->name }}</td>
                <td>{{ $student->father_mobile }}</td>
                <td>{{ $student->mother_mobile }}</td>

                <td>
                    {{ $item->name }}
                    @if($item->billing_cycle===3)
                        @if($studentPaymentItem->lab_fee>0)
                            + Lab Fee
                        @endif
                        : {{ $studentPaymentItem->month->name  }} - {{ dateFormat($studentPaymentItem->due_date,'Y') }}
                    @endif
                </td>

                <td class="p-0 text-right">
                    @php($due = $studentPaymentItem->receivable)
{{--                    @php($due = $studentPaymentItem->receivable + $studentPaymentItem->late_fee)--}}
                    {{ numberFormat($due) }}
                    @php($totalDue += $due)
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr class="text-danger">
        <th colspan="7" class="text-center">Total</th>
        <th class="text-right">
            {{ numberFormat($totalDue) }}
        </th>
    </tr>
    </tfoot>
</table>

<script>
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // console.log("Tab is active");
            getDueReportNew()
        }
    });
</script>
