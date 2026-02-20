<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th class="text-center">Sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Customer</th>
{{--        <th class="text-center">Mobile</th>--}}
        <th>Product Description</th>
        <th class="text-right">Bill(Tk)</th>
{{--        <th class="text-right">Vat(Tk)</th>--}}
        <th class="text-right">Discount(Tk)</th>
        <th class="text-right">Profit(Tk)</th>
        <th class="text-right">Received(Tk)</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalBill=0) @php($totalDiscount=0)  @php($totalProfit=0) @php($totalReceived=0)
    @foreach($payments as $payment)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
            <td>
                @if($payment->row_id!=null)
                    <span class="badge badge-pill badge-soft-{{ $payment->sale->sale_type=='Cash'?'success':'warning' }} font-size-12">
                        {{ $payment->sale->sale_type =='Credit'? 'Credit Sale' : 'Cash Sale' }}
                    </span>
                @else
                    <span class="badge badge-pill badge-soft-info font-size-12">{{ 'Received' }}</span>
                @endif
            </td>
            @if($payment->row_id!=null)
                <td>{{ $payment->sale->client_id==null? $payment->sale->client_name : $payment->client->name }}</td>
{{--                <td class="text-center">{{ $payment->sale->client_id==null? $payment->sale->client_mobile : $payment->client->mobile }}</td>--}}
                <td>
                    @php($j=0)
                    @php($costPrice=0) @php($salePrice=0)
                    @foreach($payment->sale->details as $detail)
                        @php($costPrice += $detail->quantity*$detail->cost_rate)
                        @php($salePrice += $detail->quantity*$detail->rate)
                        @php($j++)
                        {{ $detail->product->name }} ({{ numberFormat($detail->quantity,3) }} {{ $detail->product->unit->code }})-(S.R-Tk.{{ numberFormat($detail->rate) }} : C.R-Tk.{{ numberFormat($detail->cost_rate) }})
                        {!! ($j<count($payment->sale->details) and $j>=1)? '<br/>':'' !!}
                    @endforeach
                </td>
                <td class="text-right">{{ numberFormat($payment->sale->product_cost,2) }}</td>
{{--                <td class="text-right">{{ numberFormat($payment->sale->vat,2) }}</td>--}}
                <td class="text-right">{{ numberFormat($payment->sale->discount,2) }}</td>
                @php($cost= $payment->sale->product_cost-$payment->sale->discount)
                @php($profit=($payment->sale->product_cost - $costPrice))
                <td class="text-right">{{ numberFormat($profit,2) }}</td>
                @php($totalBill += $payment->sale->product_cost)
                @php($totalProfit += $profit)
                @php($totalDiscount += $payment->sale->discount)
            @else
                <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
{{--                <td class="text-center">{{ $payment->client_id!=null? $payment->client->mobile : '' }}</td>--}}
{{--                <td></td>--}}
                <td></td>
                <td class="text-right"></td>
            @endif

            <td class="text-right">{{ numberFormat($payment->amount,2) }}</td>
            @php($totalReceived += $payment->amount)
            <td class="text-right">
                <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
{{--                <a href="{{ route('invoice-edit',['id'=>$payment->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>--}}
                @if(role()->code=='developer')
                    <button onclick="cashCreditInvoiceDelete('{{ $payment->id }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <th class="text-center" colspan="5">Total</th>
    <th class="text-right">{{ numberFormat($totalBill,2) }}</th>
    <th class="text-right">{{ numberFormat($totalDiscount,2) }}</th>
    <th class="text-right">{{ numberFormat($totalProfit,2) }}</th>
    <th class="text-right">{{ numberFormat($totalReceived,2) }}</th>
    <th></th>
    </tfoot>
</table>
