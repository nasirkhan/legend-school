<table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th rowspan="2" style="width: 20px" class="text-center">Sl</th>
        <th rowspan="2" class="text-center">Date</th>
        <th rowspan="2">Particular</th>
        <th rowspan="2">Note</th>
        <th rowspan="2" class="text-right">{{ $client->type=='Supplier'? 'Chalan(Taka)' : 'Bill(Taka)' }}</th>
        @if($client->type=='Customer')
            <th rowspan="2" class="text-right">(+)Vat</th>
        @endif
        <th rowspan="2" class="text-right">(-)Discount</th>
        <th rowspan="2" class="text-right">{{ $client->type=='Supplier'? 'Paid(Taka)' : 'Received(Taka)' }}</th>
        <th rowspan="2">{{ 'Media' }}</th>
        <th colspan="2" class="text-center">Balance(Taka)</th>
        <th rowspan="2" class="text-center" style="width: 100px;">Option</th>
    </tr>
    <tr>
        <th class="text-right">Payable</th>
        <th class="text-right">Receivable</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center">{{ numberFormat(1) }}</td>
        <td class="text-center">{{ dateFormat($client->created_at,'d/m/Y') }}</td>
        <td>{{ 'Past Balance' }}</td>
        <td></td>
        <td></td>
        @if($client->type=='Customer')
            <td></td>
        @endif
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right">{{ $client->balance_type=='Debit'? numberFormat($client->initial_balance,2) : '' }}</td>
        <td class="text-right">{{ $client->balance_type=='Credit'? numberFormat($client->initial_balance,2) : '' }}</td>
        <td></td>
    </tr>
    @php($balance=$client->initial_balance)
    @php($title=$client->balance_type)
    @foreach($payments as $payment)
        @php($row=null)
        @php($total=0)
        @if($client->type=='Customer')
            @if($payment->row_id!=null)
{{--                @php($total=$payment->sale->total)--}}
                @php($total=($payment->sale->product_cost+$payment->sale->vat-$payment->sale->discount))
            @endif
            @php($due = ($total - $payment->amount))
            @php($newBalance = customerNewBalance($due,clientLastBalance($client->id,$payment->id)))
        @elseif($client->type=='Supplier')
            @if($payment->row_id!=null)
{{--                @php($total=$payment->purchase->total)--}}
                @php($total=($payment->purchase->product_cost-$payment->purchase->discount))
            @endif
            @php($due = ($total - $payment->amount))
            @php($newBalance = supplierNewBalance($due,clientLastBalance($client->id,$payment->id)))
        @endif

            <?php if ($payment->row_id!=null){
            if ($payment->model=='Purchase'){
                $row = App\Models\Purchase::find($payment->row_id);
            }else{
                $row = App\Models\Sale::find($payment->row_id);
            }
        } ?>


        <tr>
            @php($sl = $loop->iteration + 1)
            <td class="text-center">{{ numberFormat($sl) }}</td>
            <td class="text-center">{{ dateFormat($payment->created_at,'d/m/Y') }}</td>

            {{--Product Name--}}
            <td>
                @if($client->type=='Supplier')
                    @if(isset($row))
                        @foreach($row->details as $detail)
                            {{ $detail->product->name }},
                        @endforeach
                    @else
                        {{ 'Paid' }}
                    @endif
                @else
                    @if(isset($row))
                        @foreach($row->details as $detail)
                            {{ $detail->product->name }},
                        @endforeach
                    @else
                        {{ 'Received' }}
                    @endif
                @endif
            </td>
            <td>{{ isset($row)? $row->note : '' }}</td>
            <td class="text-right">{{ isset($row)? numberFormat($row->product_cost,2) : '' }}</td>
            @if($client->type=='Customer')
                <td class="text-right">{{ isset($row)? numberFormat($row->vat,2) : '' }}</td>
            @endif
            <td class="text-right">{{ isset($row)? numberFormat($row->discount,2) : '' }}</td>
{{--            <td class="text-right">{{ isset($row)? numberFormat($row->total,2) : '' }}</td>--}}
            <td class="text-right">{{ numberFormat($payment->amount,2) }}</td>
            <td>
                @if($payment->media=='Cash')
                    @if($payment->amount>0){{ $payment->media }}@endif
                @else
                    {{ $payment->bankPayment->bankAccount->bank->code }}-{{ $payment->bankPayment->bankAccount->ac_no }}
                @endif
            </td>
            <td class="text-right">{{ $newBalance['title']=='Debit' ? numberFormat($newBalance['balance'],2):'' }}</td>
            <td class="text-right">{{ $newBalance['title']=='Credit' ? numberFormat($newBalance['balance'],2):'' }}</td>
            <td class="text-center">
                <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-sm btn-secondary" title="Invoice/Chalan"><i class="fa fa-eye"></i></a>
{{--                <a href="{{ route('invoice-edit',['id'=>$payment->id,'location'=>'client_details']) }}" class="btn btn-sm btn-primary" title="Invoice/Chalan Edit"><i class="fa fa-edit"></i></a>--}}
                @if(role()->code=='developer')
                    <button onclick="invoiceDelete('{{ $payment->id }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
