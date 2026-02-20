<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Student</th>
        <th>Class</th>
        <th>Batch</th>
        <th>Mobile</th>
        <th class="text-center">Months</th>
        <th class="text-right">Amount(Tk)</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($total=0)
    @foreach($payments as $payment)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
            <td>{{ $payment->student->name }}</td>
            <td>{{ $payment->classInfo->name }}</td>
            <td>{{ $payment->student->batch->name }}</td>
            <td>{{ $payment->student->mobile }}</td>
            <td>
                <ul class="mb-0">
                    @foreach($payment->payments as $monthlyPayment)
                        <li>{{ $monthlyPayment->month->code }}-{{ $monthlyPayment->year }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="text-right">{{ numberFormat($payment->received) }}</td>
            @php($total += $payment->received)
            <td class="text-right">
                <a href="{{ route('invoice',['id'=>$payment->id]) }}" target="_blank" class="btn btn-sm btn-secondary" title="Invoice Show"><i class="fa fa-eye"></i></a>
                <a href="{{ route('invoice',['id'=>$payment->id]) }}" target="_blank" class="btn btn-sm btn-primary" title="Invoice Edit"><i class="fa fa-edit"></i></a>
                <a href="{{ route('invoice',['id'=>$payment->id]) }}" target="_blank" class="btn btn-sm btn-danger" title="Invoice Delete"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="7" class="text-center">Total = </th>
        <th class="text-right">{{ numberFormat($total) }}</th>
        <th class="text-right"></th>
    </tr>
    </tfoot>
</table>
