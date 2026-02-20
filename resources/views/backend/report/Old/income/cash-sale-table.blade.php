<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Customer</th>
        <th>Mobile</th>
        <th class="text-right">Bill(Tk)</th>
        <th class="text-right">Vat(Tk)</th>
        <th class="text-right">Discount(Tk)</th>
        <th class="text-right">Received(Tk)</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalBill=0) @php($totalVat=0) @php($totalDiscount=0) @php($totalReceived=0)
    @foreach($sales as $sale)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($sale->created_at,'d/m/Y') }}</td>
            <td>{{ $sale->client_name }}</td>
            <td>{{ $sale->client_mobile }}</td>
            @php($totalBill += $sale->product_cost)
            <td class="text-right">{{ numberFormat($sale->product_cost,2) }}</td>
            @php($totalVat += $sale->vat)
            <td class="text-right">{{ numberFormat($sale->vat,2) }}</td>
            @php($totalDiscount += $sale->discount)
            <td class="text-right">{{ numberFormat($sale->discount,2) }}</td>
            @php($received=($sale->product_cost+$sale->vat-$sale->discount))
            <td class="text-right">{{ numberFormat($received,2) }}</td>
            @php($totalReceived += $received)
            <td class="text-right">
                <a href="{{ route('invoice',['paymentId'=>$sale->payment_id]) }}" target="_blank" class="btn btn-sm btn-secondary" title="Invoice"><i class="fa fa-eye"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4" class="text-center">Total</th>
        <th class="text-right">{{ numberFormat($totalBill,2) }}</th>
        <th class="text-right">{{ numberFormat($totalVat,2) }}</th>
        <th class="text-right">{{ numberFormat($totalDiscount,2) }}</th>
        <th class="text-right">{{ numberFormat($totalReceived,2) }}</th>
        <th class="text-right"></th>
    </tr>
    </tfoot>
</table>
