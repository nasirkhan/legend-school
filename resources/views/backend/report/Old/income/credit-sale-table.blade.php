<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Customer</th>
        <th>Mobile</th>
        <th class="text-right">Bill(Tk)</th>
        <th class="text-right">Vat(Tk)</th>
        <th class="text-right">Discount(Tk)</th>
        <th class="text-right">Receive(Tk)</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalBill=0) @php($totalVat=0) @php($totalDiscount=0) @php($totalReceived=0)
    @foreach($payments as $payment)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
            <td>
                @if($payment->row_id!=null)
                    <span class="badge badge-pill badge-soft-{{ $payment->sale->sale_type=='Cash'?'success':'warning' }} font-size-12">
                                                {{ $payment->sale->sale_type == 'Credit' ? 'Sale' : '' }}
                                            </span>
                @else
                    <span class="badge badge-pill badge-soft-info font-size-12">{{ 'Received' }}</span>
                @endif
            </td>
            @if($payment->row_id!=null)
                <td>{{ $payment->sale->client_id==null? $payment->sale->client_name : $payment->client->name }}</td>
                <td>{{ $payment->sale->client_id==null? $payment->sale->client_mobile : $payment->client->mobile }}</td>
{{--                <td class="text-right">{{ numberFormat($payment->sale->total,dp($payment->sale->total)) }}</td>--}}
                <td class="text-right">{{ numberFormat($payment->sale->product_cost,2) }}</td>
                <td class="text-right">{{ numberFormat($payment->sale->vat,2) }}</td>
                <td class="text-right">{{ numberFormat($payment->sale->discount,2) }}</td>
                @php($totalBill += $payment->sale->product_cost)
                @php($totalVat += $payment->sale->vat)
                @php($totalDiscount += $payment->sale->discount)
            @else
                <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
                <td>{{ $payment->client_id!=null? $payment->client->mobile : '' }}</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            @endif

            <td class="text-right">{{ numberFormat($payment->amount,2) }}</td>
            <td class="text-right">
                <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
        @php($totalReceived += $payment->amount)
    @endforeach
    </tbody>
    <tr>
        <th colspan="5" class="text-center">Total</th>
        <th class="text-right">{{ numberFormat($totalBill,2) }}</th>
        <th class="text-right">{{ numberFormat($totalVat,2) }}</th>
        <th class="text-right">{{ numberFormat($totalDiscount,2) }}</th>
        <th class="text-right">{{ numberFormat($totalReceived,2) }}</th>
        <th class="text-right"></th>
    </tr>
</table>
