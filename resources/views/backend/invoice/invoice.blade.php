@extends('backend.invoice.master')

@php($title= 'Invoice')
@if($payment->model=='Purchase')
    @php($title='Credit Purchase Invoice')
@else
    @php($title = $payment->sale->sale_type.' Sale Invoice')
@endif


@section('title') {{ $title }} @endsection
@section('body')
    <h3 class="text-dark font-weight-bold" style="font-family: Rockwell"></h3>
    <table class="table table-bordered">
        <tr>
            <th class="text-center">Sl</th>
            <th class="text-center">Date</th>
            <th>Client</th>
            <th>Address</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Invoice/Chalan</th>
            <th class="text-right">Amount(Tk)</th>
        </tr>
        <tr>
            <td class="text-center">{{ '' }}</td>
            <td class="text-center">{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
            <td>
{{--                @if($client->type=='Supplier')--}}
{{--                    {{ isset($row)? $row->product->name : '' }}--}}
{{--                @else--}}
{{--                    @if(isset($row))--}}
{{--                        @foreach($row->details as $detail)--}}
{{--                            {{ $detail->purchase->product->name }},--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                @endif--}}
            </td>
            <td class="text-right">
{{--                {{ isset($row)? $row->total : '' }}--}}
            </td>
            <td class="text-right">{{ $payment->amount }}</td>
            <td>
                @if($payment->media=='Cash')
                    {{ $payment->media }}
                @else
                    {{ $payment->bankPayment->bankAccount->bank->code }}-{{ $payment->bankPayment->bankAccount->ac_no }}
                @endif
            </td>
        </tr>
    </table>
@endsection
