<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Supplier</th>
        <th>Mobile</th>
        <th>Product Description</th>
{{--        <th>Quantity</th>--}}
        <th class="text-right">Bill(Tk)</th>
        <th class="text-right">Discount(Tk)</th>
        <th class="text-right">Paid(Tk)</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalBill=0) @php($totalDiscount=0) @php($totalPayment=0)
    @foreach($payments as $payment)
        @php($sl = $loop->iteration)
        <tr>
            <td class="">{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
            <td>
                @if($payment->row_id!=null)
                    <span class="badge badge-pill badge-soft-warning font-size-12">{{ 'Purchase' }}</span>
                @else
                    <span class="badge badge-pill badge-soft-info font-size-12">{{ 'Paid' }}</span>
                @endif
            </td>

            <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
            <td>{{ $payment->client_id!=null? $payment->client->mobile : '' }}</td>

            <td>
                @if($payment->row_id != null)
                    @php($j=0)
                    @foreach($payment->purchase->details as $detail)
                        @php($j++)
                        {{ $detail->product->name }} ({{ numberFormat($detail->quantity,3) }} {{ $detail->product->unit->code }})-(Rate-Tk.{{ numberFormat($detail->rate) }})
                        {!! ($j<count($payment->purchase->details) and $j>=1)? '<br/>':'' !!}
                    @endforeach
{{--                    @php($totalBill +=$payment->purchase->total)--}}
                    @php($totalBill +=$payment->purchase->product_cost)
                    @php($totalDiscount +=$payment->purchase->discount)
                @endif
            </td>

{{--            <td></td>--}}

{{--            <td class="text-right">{{ $payment->row_id != null? numberFormat($payment->purchase->total,2) : '' }}</td>--}}
            <td class="text-right">{{ $payment->row_id != null? numberFormat($payment->purchase->product_cost,2) : '' }}</td>
            <td class="text-right">{{ $payment->row_id != null? numberFormat($payment->purchase->discount,2) : '' }}</td>
            <td class="text-right">{{ numberFormat($payment->amount,2) }}</td>
            <td class="text-right">
                <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                {{--                <button onclick="statusUpdateConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $client->status==1?'success':'warning' }}">--}}
                {{--                    <i class="fa fa-arrow-{{ $client->status==1?'up':'down' }}"></i>--}}
                {{--                </button>--}}
                {{--                                        <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                <button onclick="itemDeleteConfirmation('{{ $payment->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="6" class="text-center">Total</th>
        <th class="text-right">{{ numberFormat($totalBill,2) }}</th>
        <th class="text-right">{{ numberFormat($totalDiscount,2) }}</th>
        <th class="text-right">{{ numberFormat($payments->sum('amount'),2) }}</th>
        <th class="text-right"></th>
    </tr>
    </tfoot>
</table>
