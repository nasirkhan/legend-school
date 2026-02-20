@extends('backend.invoice.master')

@php($title= 'Payment Invoice')

@section('title') {{ $title }} @endsection

@section('title-tag') {{ $payment->receipt_no }} @endsection

@section('body')
    <h3 class="text-dark font-weight-bold" style="font-family: Rockwell"></h3>
    @php($student = $payment->student)
    <table class="mb-3" style="width: 100%; color: #000000; padding-bottom: 5px;">
        <tr class="">
            <th class="text-right">Name: </th><td> {{ $student->name }}</td>
            <th class="text-right">Mobile: </th><td> {{ $student->mobile }}</td>
            <th class="text-right">Address: </th><td> {{ $student->address }}</td>
        </tr>
        <tr>
            <th class="text-right">Date: </th><td> {{ dateFormat($payment->created_at,'d-m-Y') }}</td>
            <th class="text-right">Time: </th><td> {{ dateFormat($payment->created_at,'h:m:i') }}</td>
            <th class="text-right">Receipt No: </th><td> {{ $payment->receipt_no }}</td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <th class="text-center">Sl</th>
            <th class="">Months</th>
            <th class="text-right">Monthly Fee (Tk.)</th>
            <th class="text-right">Total (Tk.)</th>
            <th class="text-right">Discount (Tk.)</th>
            <th class="text-right">Received (Tk.)</th>
        </tr>

        <tr>
            <td class="text-center">1</td>
            <td>
                <ul class="mb-0">
                    @foreach($payment->payments as $monthlyPayment)
                        <li>{{ $monthlyPayment->month->code }}-{{ $monthlyPayment->year }}</li>
                    @endforeach
                </ul>
            </td>
            <td class="text-right">{{ $student->monthly_fee }}</td>
            @php($totalFee = $student->monthly_fee*count($payment->payments))
            <td class="text-right">{{ numberFormat($totalFee) }}</td>
            @php($totalDiscount = $student->discount*count($payment->payments))
            <td class="text-right">{{ numberFormat($totalDiscount) }}</td>
            @php($totalPayable = $totalFee - $totalDiscount)
            <td class="text-right">{{ numberFormat($totalPayable) }}</td>
        </tr>
        <tr>
            <th colspan="6">In Word: <span class="font-weight-normal">{{ Illuminate\Support\Str::upper(convertNumberToWord($totalPayable)) }}</span></th>
        </tr>
    </table>
@endsection
