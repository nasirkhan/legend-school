<table id="datatable" class="table table-bordered table-hover table-sm ">
    <thead>
    <tr>
        <th class="text-center" style="width: 45px">SL</th>
        <th>Name</th>
        <th>ID</th>
        <th>Class</th>
        <th class="text-right">Actual Fee(BDT)</th>
        <th class="text-right">Discount(%)</th>
        <th class="text-right">Receivable(BDT)</th>
    </tr>
    </thead>
    <tbody>
    @php($totalReceivable = 0)
    @if(count($students)>0)
        @foreach($students as $student)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $student['info']->name }}</td>
                <td>{{ $student['info']->roll }}</td>
                <td>{{ $student['class']->name }}</td>
                <td class="text-right">{{ numberFormat($student['fee']->monthly_fee) }}</td>
                <td class="text-right">{{ $student['fee']->discount }} %</td>
                <td class="text-right">
                    {{ numberFormat($receivable = $student['fee']->payable) }}
                    @php($totalReceivable += $receivable)
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <th colspan="6" class="text-center">Total Receivable</th>
        <th class="text-right">{{ numberFormat($totalReceivable) }}</th>
    </tr>
    </tfoot>
</table>

<script>
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            // console.log("Tab is active");
            getFees()
        }
    });
</script>
