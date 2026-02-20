@extends('backend.master')
@section('document-title') সিসি-লোন বিস্তারিত @endsection
@section('page-title')  সিসি-লোন বিস্তারিত @endsection
@section('active-breadcrumb-item') <a href="{{ route('bank-loan-report-detail',['loan_id'=>$loan->id]) }}"> সিসি-লোন বিস্তারিত</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title text-primary">Loan Details</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="3">ব্যাংক : {{ $loan->bank->name }}</th>
                                <th colspan="2">একাউন্ট টাইটেল : {{ $loan->ac_title }}</th>
                                <th colspan="2">একাউন্ট আইডি : {{ $loan->ac_id }}</th>
                                <th colspan="2" class="text-right">সর্বোচ্চ লিমিট : {{ bengaliNumber($loan->limiting_balance,2) }}</th>
                            </tr>
                            <tr>
                                <th rowspan="2">তারিখ</th>
                                <th rowspan="2" class="">লেনদেনের ধরণ</th>
                                <th rowspan="2" class="">বিবরণ</th>
                                <th rowspan="2" class="text-center">চেক নং</th>
                                <th rowspan="2" class="text-right">ডেবিট</th>
                                <th rowspan="1" colspan="2" class="text-center">ক্রেডিট</th>
                                <th rowspan="2" class="text-right">প্রিঞ্চিপাল ব্যালেন্স</th>
                                <th rowspan="2" class="text-right">লিমিট ব্যালেন্স</th>
{{--                                <th rowspan="2" class="text-right">Action</th>--}}
                            </tr>
                            <tr>
                                <th rowspan="1" colspan="1" class="text-right">মুনাফার হার ({{ bengaliNumber($loan->interest_rate,dp($loan->interest_rate)) }}%)</th>
                                <th rowspan="1" colspan="1" class="text-right">উত্তোলন</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ bengaliString(dateFormat($loan->created_at,'d/m/Y')) }}</td>
                                <td>লোন শুরু</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{ bengaliNumber($loan->principal_balance,2) }}</td>
                                <td class="text-right">{{ bengaliNumber($loan->principal_balance,2) }}</td>
                                <td class="text-right">{{ bengaliNumber(($loan->limiting_balance-$loan->principal_balance),2) }}</td>
                            </tr>
                            @php($totalInterest=0)

                            @php($principalBalance = $loan->principal_balance)
                            @php($limitBalance = $loan->limiting_balance)
                            @php($interestRate = $loan->interest_rate)
                            @php($interestFactor = ($interestRate/(365*100)))

                            @php($count=0) @php($lastTransactionDate = null)

                            @foreach($transactionGroup as $created_at => $transactions)
                                @php($latestTransactionDate = Carbon\Carbon::parse($created_at))
                                @if($count==0)
                                    @php($previousTransactionDate = Carbon\Carbon::parse($loan->created_at))
                                @else
                                    @php($previousTransactionDate = $lastTransactionDate)
                                @endif

                                @php($dayInterval = $previousTransactionDate->diffInDays($latestTransactionDate))
                                @php($interest = $principalBalance*$interestFactor*$dayInterval)

                                @php($totalInterest +=$interest)
                                <tr>
                                    <td class="">{{ bengaliString(dateFormat($created_at,'d/m/Y')) }}</td>
                                    <td class="">{{ 'দৈনিক সুধ' }}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">{{ bengaliNumber($interest,2) }}</td>
                                    <td class="text-center"></td>
                                    @php($principalBalance += $interest)
                                    <td class="text-right">{{ bengaliNumber($principalBalance,2) }}</td>
                                    @php($currentLimitBalance = ($limitBalance - $principalBalance))
                                    <td class="text-right">{{ bengaliNumber($currentLimitBalance,2) }}</td>
                                    {{--                                    <td class="text-right">--}}
                                    {{--                                        <a target="_blank" href="{{ route('bank-loan-report-detail',['loan_id'=>$loan->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>--}}
                                    {{--                                        <button onclick="statusUpdateConfirmation('{{ $loan->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $loan->status==1?'success':'warning' }}">--}}
                                    {{--                                            <i class="fa fa-arrow-{{ $loan->status==1?'up':'down' }}"></i>--}}
                                    {{--                                        </button>--}}
                                    {{--                                                                                <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                                    {{--                                        <button onclick="itemDeleteConfirmation('{{ $payment->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
                                    {{--                                    </td>--}}
                                </tr>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="">{{ bengaliString(dateFormat($created_at,'d/m/Y')) }}</td>
                                        <td class="">{{ $transaction->type =='Deposit'? 'জমা' : 'উত্তোলন' }}</td>
                                        <td>{{ $transaction->particular }}</td>
                                        <td></td>
                                        <td class="text-right">{{ $transaction->type=='Deposit'? bengaliNumber($transaction->amount,2) : '' }}</td>
                                        <td class="text-center"></td>
                                        <td class="text-right">{{ $transaction->type=='Withdrawal'? bengaliNumber($transaction->amount,2) : '' }}</td>
                                        @php($transaction->type=='Deposit' ? $principalBalance -= $transaction->amount : $principalBalance += $transaction->amount)
                                        <td class="text-right">{{ bengaliNumber($principalBalance,2) }}</td>
                                        @php($currentLimitBalance = ($limitBalance - $principalBalance))
                                        <td class="text-right">{{ bengaliNumber($currentLimitBalance,2) }}</td>
                                        {{--                                    <td class="text-right">--}}
                                        {{--                                        <a target="_blank" href="{{ route('bank-loan-report-detail',['loan_id'=>$loan->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>--}}
                                        {{--                                        <button onclick="statusUpdateConfirmation('{{ $loan->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $loan->status==1?'success':'warning' }}">--}}
                                        {{--                                            <i class="fa fa-arrow-{{ $loan->status==1?'up':'down' }}"></i>--}}
                                        {{--                                        </button>--}}
                                        {{--                                                                                <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                                        {{--                                        <button onclick="itemDeleteConfirmation('{{ $payment->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
                                        {{--                                    </td>--}}
                                    </tr>
                                @endforeach
                            @endforeach






{{--                            @foreach($transactions as $transaction)--}}
{{--                                @php($loanBalance=loanBalance($loan->id))--}}
{{--                                <tr>--}}
{{--                                    <td class="">{{ dateFormat($transaction->created_at,'d/m/Y') }}</td>--}}
{{--                                    <td class="">{{ $transaction->type }}</td>--}}
{{--                                    <td>--</td>--}}
{{--                                    <td>--</td>--}}
{{--                                    <td class="text-center">{{ $transaction->type=='Deposit'? numberFormat($transaction->amount) : '' }}</td>--}}
{{--                                    <td class="text-center">-</td>--}}
{{--                                    <td class="text-center">{{ $transaction->type=='Withdrawal'? numberFormat($transaction->amount) : '' }}</td>--}}
{{--                                    <td class="text-right">-</td>--}}
{{--                                    <td class="text-right">-</td>--}}
{{--                                    <td class="text-right">--}}
{{--                                        <a target="_blank" href="{{ route('bank-loan-report-detail',['loan_id'=>$loan->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>--}}
{{--                                        <button onclick="statusUpdateConfirmation('{{ $loan->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $loan->status==1?'success':'warning' }}">--}}
{{--                                            <i class="fa fa-arrow-{{ $loan->status==1?'up':'down' }}"></i>--}}
{{--                                        </button>--}}
{{--                                                                                <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                                        <button onclick="itemDeleteConfirmation('{{ $payment->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="" class="text-center">মোট</th>
                                <th class="text-right"></th>
                                <th class="text-right"></th>
                                <th></th>
                                <th></th>
                                <th class="text-right">{{ bengaliNumber($totalInterest,2) }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
{{--this script override all--}}
@section('script') @include('backend.report.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.report.style') @endsection


