<table id="datatable" class="table table-bordered table-hover table-sm">
    <thead>
    <tr>
        <th class="text-center">SL</th>
        <th>Name</th>
        <th>Class</th>
{{--        <th>ID</th>--}}
        <th>Father Mob.</th>
        <th>Mother Mob.</th>
        <th style="">Description</th>
        <th class="text-right">Amount</th>
        <th class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @php($totalDue = 0)
    @if(count($data)>0)
        @foreach($data as $item)
            @php($studentTotalDue = 0)
            @php($student = $item['student'])
            @php($studentPaymentItems = $item['items'])
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td style="width: 150px !important;">{{ $student->name }}</td>
                <td>{{ $studentPaymentItems[0]->class->name }}</td>
{{--                <td>{{ $student->roll }}</td>--}}
                <td>{{ $student->father_mobile }}</td>
                <td>{{ $student->mother_mobile }}</td>
                <td>
                    <ul class="mb-0">
                        @foreach($studentPaymentItems as $studentPaymentItem)
                            @php($paymentItem = $studentPaymentItem->item)
                            @php($lateFeeInfo = checkLateFee($studentPaymentItem->id))
                            <li>
                                {{ $paymentItem->name }}

                                @if($paymentItem->billing_cycle === 1 or $paymentItem->billing_cycle === 2)
                                   - {{ numberFormat($studentPaymentItem['receivable']) }}/-
                                @endif

                                @if($paymentItem->billing_cycle===3)
                                    : {{ $studentPaymentItem->month->name }} - {{ dateFormat($studentPaymentItem->due_date,'Y') }}
                                    - {{ numberFormat($studentPaymentItem['receivable']) }}/-
                                @endif

                                @if($lateFeeInfo['late_fee']>0)
                                    <br> Late Fee: {{ numberFormat($lateFeeInfo['late_fee']) }}/-
                                @endif
                            </li>
                            @php($studentTotalDue += ($lateFeeInfo['late_fee'] + $studentPaymentItem['receivable']))
                        @endforeach
                    </ul>
                </td>
{{--                <td class="text-right">{{ numberFormat($item['total']) }}</td>--}}
                <td class="text-right">{{ numberFormat($studentTotalDue) }}/-</td>
                <td class="text-center">
                    <a href="{{ route('student-payment-report',[
                        'student_id'=>$student->id,
                        'class_id'=>$studentPaymentItems[0]->class_id,
                        'year'=>$studentPaymentItems[0]->year
                    ]) }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-eye"></i> View
                    </a>
                </td>
            </tr>
            @php($totalDue += $studentTotalDue)
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <th colspan="6" class="text-center">Total Due Amount</th>
        <th class="text-right">
            {{ numberFormat($totalDue) }}/-
        </th>
        <th class="text-center">--</th>
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
