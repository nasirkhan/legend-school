@extends('backend.invoice.master')
@section('title') {{ $payment->row_id ==null ? 'Due Paid' : 'Product Purchase' }} @endsection
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
            <th class="text-right">Chalan No:</th><td>{{ $payment->row_id != null ? $payment->purchase->invoice_no : '' }}</td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <th class="text-center">Sl</th>
            <th>Product</th>
            <th>Company</th>
{{--            <th class="text-right">Quantity</th>--}}
            <th class="text-right">Quantity</th>
            <th class="text-right">Rate(Taka)</th>
            <th class="text-right">Cost(Taka)</th>
        </tr>
        @if($payment->row_id !=null)
            @foreach($payment->purchase->details as $detail)
{{--                @php($factor = unitConversionFactor($detail->unit_id,$detail->secondary_unit_id))--}}
                <tr>
                    <td class="text-center">{{ numberFormat($loop->iteration) }}</td>
                    <td class="">{{ $detail->product->name }}</td>
                    <td class="">{{ $detail->product->brand->name }}</td>
{{--                    <td class="text-right">{{ numberFormat($detail->quantity*$factor) }} {{ $detail->secondaryUnit->code }}</td>--}}
                    <td class="text-right">{{ numberFormat($detail->quantity,dp($detail->quantity)) }} {{ $detail->unit->code }}</td>
                    <td class="text-right">{{ numberFormat($detail->rate,2) }}</td>
                    <td class="text-right">{{ numberFormat($detail->rate*$detail->quantity,2) }}</td>
                </tr>
            @endforeach

            <tr class="text-right border-0">
{{--                <th colspan="6">Total Cost:</th>--}}
                <th colspan="5">Total:</th>
                <th>{{ numberFormat($payment->purchase->product_cost,2) }}/-</th>
            </tr>

{{--            <tr class="text-right">--}}
{{--                <th colspan="6">Transport Cost:</th>--}}
{{--                <th>{{ numberFormat($payment->purchase->transport_cost,2) }}/-</th>--}}
{{--            </tr>--}}

{{--            <tr class="text-right">--}}
{{--                <th colspan="6">Labour Cost:</th>--}}
{{--                <th>{{ numberFormat($payment->purchase->labour_cost,2) }}/-</th>--}}
{{--            </tr>--}}

{{--            <tr class="text-right">--}}
{{--                <th colspan="6">Total:</th>--}}
{{--                <th>{{ numberFormat($payment->purchase->total,2) }}/-</th>--}}
{{--            </tr>--}}
        @endif


        <tr class="text-right">
            <th colspan="5">Paid:</th>
            <th>{{ numberFormat($payment->amount,2) }}/-</th>
        </tr>

        @php($total=0)
        @if($payment->row_id!=null)
            @php($total=$payment->purchase->product_cost)
{{--            @php($total=$payment->purchase->total)--}}
        @endif

        @php($due = ($total-($payment->amount)))

        @if($payment->row_id!=null)
            <tr class="text-right">
                <th colspan="5">{{ $due<0? 'Receivable':'Payable'  }}:</th>
                <th>{{ numberFormat(abs($due),2) }}/-</th>
            </tr>
        @endif

        @php($oldBalance = clientLastBalance($payment->client_id,$payment->id))
        <tr class="text-right">
            <th colspan="5">Past {{ $oldBalance['title'] == 'Credit' ? 'Receivable' : 'Payable' }}:</th>
            @php($oldBal = $oldBalance['balance'])
            <th>{{ numberFormat($oldBal,2) }}/-</th>
        </tr>

        @php($presentBalance = supplierNewBalance($due,$oldBalance))

        <tr class="text-right">
            <th colspan="5">Present {{ $presentBalance['title'] == 'Credit' ? 'Receivable' : 'Payable' }}:</th>
            <th>{{ numberFormat($presentBalance['balance'],2) }}/-</th>
        </tr>

        @if($payment->row_id!=null)
            <tr class="text-right">
                <th colspan="5">Transport Cost:</th>
                <th>{{ numberFormat($payment->purchase->transport_cost,2) }}/-</th>
            </tr>

            <tr class="text-right">
                <th colspan="5">Labour Cost:</th>
                <th>{{ numberFormat($payment->purchase->labour_cost,2) }}/-</th>
            </tr>
        @endif
    </table>
@endsection
