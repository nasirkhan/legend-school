@extends('backend.invoice.master')
@section('title') {{ dateFormat($data->start,'d/m/Y').' to '.dateFormat($data->end,'d/m/Y').' Payment Report' }} @endsection
@section('title-tag') {{ dateFormat($data->start,'d/m/Y').' to '.dateFormat($data->end,'d/m/Y').' Payment Report' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Student</th>
            <th>Class</th>
            <th>Batch</th>
            <th>Mobile</th>
            <th>Months</th>
            <th class="text-right">Amount(Tk)</th>
        </tr>
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
                    <ul class="mb-0 pl-0">
                        @foreach($payment->payments as $monthlyPayment)
                            <li class="">{{ $monthlyPayment->month->code }}-{{ $monthlyPayment->year }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="text-right">{{ numberFormat($payment->received) }}/-</td>
                @php($total += $payment->received)
            </tr>
        @endforeach
        <tr>
            <th colspan="7" class="text-center">Total = </th>
            <th class="text-right">{{ numberFormat($total) }}/-</th>
        </tr>
    </table>

@endsection
