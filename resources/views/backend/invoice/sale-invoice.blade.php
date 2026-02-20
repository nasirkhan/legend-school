@extends('backend.invoice.master')

@php($title= 'Invoice')
@if($payment->row_id!=null)
    @php($title='Sale Invoice')
@else
    @php($title='Cash Received Memo')
@endif

@section('title') {{ $title }} @endsection
@section('body')
    <h3 class="text-dark font-weight-bold" style="font-family: Rockwell"></h3>
    @php($client = $payment->client)
    <table class="mb-3" style="width: 100%; color: #000000; padding-bottom: 5px;">
        <tr class="">
            <th class="text-right">Name:</th><td>{{ $client->name }}</td>
            <th class="text-right">Mobile:</th><td>{{ $client->mobile }}</td>
            <th class="text-right">Address:</th><td>{{ $client->address }}</td>
        </tr>
        <tr>
            <th class="text-right">Date:</th><td>{{ dateFormat($payment->created_at,'d-m-Y') }}</td>
            <th class="text-right">Time:</th><td>{{ dateFormat($payment->created_at,'h:m:i') }}</td>
            <th class="text-right">Invoice No:</th><td>
                @if($payment->row_id != null)
                    {{ memoNo($payment->sale->id) }}
                @endif
            </td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <th class="text-center">Sl</th>
            <th class="">Product</th>
            <th class="text-center">Company</th>
{{--            <th class="text-right">Quantity</th>--}}
            <th class="text-right">Quantity</th>
            <th class="text-right">Rate(Taka)</th>
            <th class="text-right">Cost(Taka)</th>
        </tr>

        @if($payment->row_id!=null)
            @foreach($payment->sale->details as $detail)
{{--                @php($factor = unitConversionFactor($detail->unit_id,$detail->secondary_unit_id))--}}
                <tr>
                    <td class="text-center">{{ numberFormat($loop->iteration) }}</td>
                    <td class="">{{ $detail->product->name }}</td>
                    <td class="text-center">{{ $detail->product->brand->name }}</td>
{{--                    <td class="text-right">{{ numberFormat($detail->quantity*$factor) }} {{ $detail->secondaryUnit->code }}</td>--}}
                    <td class="text-right">{{ numberFormat($detail->quantity,dp($detail->quantity)) }} {{ $detail->unit->code }}</td>
                    <td class="text-right">{{ numberFormat($detail->rate,2) }}</td>
                    <td class="text-right">{{ numberFormat($detail->rate*$detail->quantity,2) }}</td>
                </tr>
            @endforeach
        @endif

        @php($total = 0)
        @if($payment->row_id!=null)
            <tr class="text-right border-0">
                <th colspan="5">Total Cost:</th>
                <th>{{ numberFormat($payment->sale->product_cost,2) }}/-</th>
            </tr>

{{--            @if($payment->sale->vat>0)--}}
                <tr class="text-right border-0">
                    <th colspan="5">Vat(+):</th>
                    <th>{{ numberFormat($payment->sale->vat,2) }}/-</th>
                </tr>
{{--            @endif--}}

{{--            @if($payment->sale->discount>0)--}}
                <tr class="text-right border-0">
                    <th colspan="5">Discount(-):</th>
                    <th>{{ numberFormat($payment->sale->discount,2) }}/-</th>
                </tr>
{{--            @endif--}}

{{--            <tr class="text-right">--}}
{{--                <th colspan="6">Transport Cost(-):</th>--}}
{{--                <th>{{ numberFormat($payment->sale->transport_cost,2) }}/-</th>--}}
{{--            </tr>--}}
{{--            <tr class="text-right">--}}
{{--                <th colspan="6">Labour Cost(-):</th>--}}
{{--                <th>{{ numberFormat($payment->sale->labour_cost,2) }}/-</th>--}}
{{--            </tr>--}}

            <tr class="text-right">
                <th colspan="5">Total:</th>
{{--                @php($total = $payment->sale->total)--}}
                @php($total = $payment->sale->product_cost+$payment->sale->vat-$payment->sale->discount)
                <th>{{ numberFormat($total,2) }}/-</th>
            </tr>
        @endif

        <tr class="text-right">
            <th colspan="5">Received:</th>
            @php($received = $payment->amount)
            <th>{{ numberFormat($received,2) }}/-</th>
        </tr>

        @php($due = ($total - $received))

        @if($payment->row_id!=null)
        <tr class="text-right">
            <th colspan="5">{{ $due<0 ? 'Payable':'Receivable' }}:</th>
            <th>{{ numberFormat(abs($due),2) }}/-</th>
        </tr>
        @endif

        @php($oldBalance = clientLastBalance($payment->client_id,$payment->id))
        <tr class="text-right">
            <th colspan="5">Past {{ $oldBalance['title'] == 'Credit' ? 'Receivable' : 'Payable' }}:</th>
            @php($oldBal = $oldBalance['balance'])
            <th>{{ numberFormat($oldBal,2) }}/-</th>
        </tr>

        @php($presentBalance = customerNewBalance($due,$oldBalance))

        <tr class="text-right">
            <th colspan="5">Present {{ $presentBalance['title'] == 'Credit' ? 'Receivable' : 'Payable' }}:</th>
            <th>{{ numberFormat($presentBalance['balance'],2) }}/-</th>
        </tr>
    </table>
@endsection
