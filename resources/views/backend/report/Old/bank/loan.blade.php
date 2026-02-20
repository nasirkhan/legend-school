@extends('backend.master')
@section('document-title') সিসি-লোন রিপোর্ট @endsection
@section('page-title') সিসি-লোন রিপোর্ট @endsection
@section('active-breadcrumb-item') <a href="{{ route('purchase-report') }}">সিসি-লোন রিপোর্ট</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">সিসি-লোন সমূহ</h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ক্রম</th>
                                <th>একাউন্ট টাইটেল</th>
                                <th class="text-center">একাউন্ট আইডি</th>
                                <th class="text-center">কাস্টমার আইডি</th>
                                <th class="text-center">শুরুর তারিখ</th>

                                <th class="text-right">সুধের হার</th>
                                <th class="text-right">প্রিঞ্চিপাল ব্যালেন্স</th>
                                <th class="text-right">লিমিট ব্যালেন্স</th>
                                <th class="text-right">অপশন</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($totalLimit=0)
                            @php($totalPrincipal=0)
                            @foreach($loans as $loan)
                                @php($loanBalance=loanBalance($loan->id))
                                @php($sl = $loop->iteration)
                                <tr>
                                    <td>{{ bengaliNumber($sl) }}</td>
                                    <td class="">{{ $loan->ac_title }}</td>
                                    <td class="text-center">{{ $loan->ac_id }}</td>
                                    <td class="text-center">{{ $loan->customer_id }}</td>
                                    <td class="text-center">{{ bengaliString(dateFormat($loan->opening_date,'d/m/Y')) }}</td>
                                    <td class="text-right">{{ $loan->interest_rate }} %</td>
                                    <td class="text-right">{{ bengaliNumber($loanBalance['principalBalance'],2) }}</td>
                                    <td class="text-right">{{ bengaliNumber($loanBalance['limitBalance'],2) }}</td>
                                    @php($totalLimit +=$loanBalance['limitBalance'])
                                    @php($totalPrincipal +=$loanBalance['principalBalance'])
                                    <td class="text-right">
                                        <a target="_blank" href="{{ route('bank-loan-report-detail',['loan_id'=>$loan->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                                        <button onclick="statusUpdateConfirmation('{{ $loan->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $loan->status==1?'success':'warning' }}">
                                            <i class="fa fa-arrow-{{ $loan->status==1?'up':'down' }}"></i>
                                        </button>
{{--                                                                                <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                                        <button onclick="itemDeleteConfirmation('{{ $payment->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="6" class="text-center">মোট</th>
                                <th class="text-right">{{ bengaliNumber($totalPrincipal,2) }}</th>
                                <th class="text-right">{{ bengaliNumber($totalLimit,2) }}</th>
                                <th class="text-right"></th>
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


