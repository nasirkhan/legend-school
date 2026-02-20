@extends('backend.master')
@section('document-title') Bank Account Details @endsection
@section('page-title') Bank Account Details @endsection
@section('active-breadcrumb-item') <a href="{{ route('bank-account-details',['id'=>$bankAccount->id]) }}">Bank Account Details</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{ $bankAccount->bank->code }} - {{ $bankAccount->ac_no }}
                        <a class="btn btn-sm btn-secondary" href="{{ route('bank-account-list') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Trans. Type</th>
                                <th>Description</th>
                                <th>Transactor</th>
                                <th>Mobile</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Balance</th>
{{--                                <th class="text-right">Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @php($balance = $bankAccount->initial_balance)
                            <tr>
                                <td>{{ numberFormat($i++) }}</td>
                                <td>{{ dateFormat($bankAccount->created_at,'d/m/Y') }}</td>
                                <td>Previous Balance</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{ numberFormat($balance,dp($balance)) }}</td>
                                <td class="text-right">{{ numberFormat($balance,dp($balance)) }}</td>
                            </tr>

                            @foreach($bankAccount->transactions as $transaction)
                                @if($transaction->amount>0)
                                    @php($sl = $i++)
                                    <tr>
                                        <td>{{ numberFormat($sl) }}</td>
                                        <td>{{ dateFormat($transaction->created_at,'d/m/Y') }}</td>
                                        <td>{{ $transaction->title=='Debit'? 'Deposit':'Withdrawal' }}</td>
                                        <td>{{ $transaction->particular }}</td>
                                        <td>{{ $transaction->transactor }}</td>
                                        <td>{{ $transaction->contact }}</td>
                                        <td class="text-right">{{ numberFormat($transaction->amount,dp($transaction->amount)) }}</td>
                                        @if($transaction->title=='Debit')
                                            @php($balance+=$transaction->amount)
                                        @else
                                            @php($balance-=$transaction->amount)
                                        @endif
                                        <td class="text-right">{{ numberFormat($balance,2) }}</td>

                                        {{--                                    <td class="text-right">--}}
                                        {{--                                        <a target="_blank" href="{{ route('bank-account-details',['id'=>$account->id]) }}" title="Details" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>--}}
                                        {{--                                                        <button onclick="statusUpdateConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $account->status==1?'success':'warning' }}">--}}
                                        {{--                                                            <i class="fa fa-arrow-{{ $account->status==1?'up':'down' }}"></i>--}}
                                        {{--                                                        </button>--}}
                                        {{--                                        <button onclick="edit('{{ $account }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                                        {{--                                        <button onclick="itemDeleteConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
                                        {{--                                    </td>--}}
                                    </tr>
                                @endif
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
@section('script') @include('backend.bank-account.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.bank-account.style') @endsection
