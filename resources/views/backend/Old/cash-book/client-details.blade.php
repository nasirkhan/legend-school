@extends('backend.master')
@section('document-title') Invoice List @endsection
@section('page-title') {{ $client->name }}'s {{ $client->type=='Supplier'? 'Credit Purchase':'Credit Sale' }} Invoice List @endsection
@section('active-breadcrumb-item') <a href="{{ route('client',['type'=>$client->type]) }}">{{ $client->type }} List</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered font-weight-bold" style="background-color: #dddddd; font-size: 15px;">
                        <tr>
                            <td>Name: {{ $client->name }}</td>
                            <td>Mobile: {{ $client->mobile }}</td>
                            <td>Address: {{ $client->address }}</td>
                            <td>Area: Feni</td>
                        </tr>
                    </table>

                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th rowspan="2" style="width: 20px" class="text-center">Sl.</th>
                                <th rowspan="2" class="text-center">Date</th>
                                <th rowspan="2">Particulars</th>
                                <th rowspan="2" class="text-right">{{ $client->type=='Supplier'? 'Chalan(Tk)' : 'Bill(Tk)' }}</th>
                                <th rowspan="2" class="text-right">{{ $client->type=='Supplier'? 'Payment(Tk)' : 'Receive(Tk)' }}</th>
                                <th rowspan="2">{{ 'Media' }}</th>
                                <th colspan="2" class="text-center">Balance(Tk)</th>
                                <th rowspan="2" class="text-center" style="width: 85px;">Action</th>
                            </tr>
                            <tr>
                                <th class="text-right">Payable</th>
                                <th class="text-right">Receivable</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">{{ dateFormat($client->created_at,'d/m/Y') }}</td>
                                <td>{{ 'Initial Balance' }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{ $client->balance_type=='Debit'? $client->initial_balance : '' }}</td>
                                <td class="text-right">{{ $client->balance_type=='Credit'? $client->initial_balance : '' }}</td>
                                <td></td>
                            </tr>
                            @php($balance=$client->initial_balance)
                            @php($title=$client->balance_type)
                            @foreach($payments as $payment)
                                @php($row=null)
{{--                                @php($clientBalance = clientBalance($client->id))--}}

{{--                                @php($newBalance = balanceCalculate($balance,$title,$payment))--}}

                                @php($total=0)
                                @if($client->type=='Customer')
                                    @if($payment->row_id!=null)
                                        @php($total=$payment->sale->total)
                                    @endif
                                    @php($due = ($total - $payment->amount))
                                    @php($newBalance = customerNewBalance($due,clientLastBalance($client->id,$payment->id)))
                                @elseif($client->type=='Supplier')
                                    @if($payment->row_id!=null)
                                        @php($total=$payment->purchase->total)
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
                                    <td class="text-center">{{ $sl = $loop->iteration + 1 }}</td>
                                    <td class="text-center">{{ dateFormat($payment->created_at,'d/m/Y') }}</td>

                                    {{--Product Name--}}
                                    <td>
                                        @if($client->type=='Supplier')
                                            {{ isset($row)? $row->product->name : 'Paid' }}
                                        @else
                                            @if(isset($row))
                                                @foreach($row->details as $detail)
                                                    {{ $detail->purchase->product->name }},
                                                @endforeach
                                            @else
                                                {{ 'Received' }}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-right">{{ isset($row)? $row->total : '' }}</td>
                                    <td class="text-right">{{ $payment->amount }}</td>
                                    <td>
                                        @if($payment->media=='Cash')
                                            @if($payment->amount>0)
                                                {{ $payment->media }}
                                            @endif
                                        @else
                                            {{ $payment->bankPayment->bankAccount->bank->code }}-{{ $payment->bankPayment->bankAccount->ac_no }}
                                        @endif
                                    </td>
                                    <td class="text-right">{{ $newBalance['title']=='Debit' ? $newBalance['balance']:'' }}</td>
                                    <td class="text-right">{{ $newBalance['title']=='Credit' ? $newBalance['balance']:'' }}</td>
                                    <td class="text-center">
                                        <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-sm btn-secondary" title="Invoice/Chalan"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-primary" title="Invoice/Chalan Edit"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Invoice/Chalan Edit"><i class="fa fa-trash-alt"></i></a>
{{--                                        <a href="{{ route('client-details',['client_id'=>$client->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>--}}
{{--                                                        <button onclick="statusUpdateConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $client->status==1?'success':'warning' }}">--}}
{{--                                                            <i class="fa fa-arrow-{{ $client->status==1?'up':'down' }}"></i>--}}
{{--                                                        </button>--}}
{{--                                        <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                                        <button onclick="itemDeleteConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection


