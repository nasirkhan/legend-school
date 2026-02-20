@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title')
    @php($title = isset($transactionType)? $transactionType : 'Transaction')
    Income-Expense Report : {{ $month }} - {{ $year }}
@endsection
@section('page-title') Income-Expense Report : {{ $month }} - {{ $year }} @endsection
@section('active-breadcrumb-item') <a href="{{ route('date-wise-expense-report') }}">Income-Expense Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')

{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('backend.expenses.month-selection-form')
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
{{--                    <h4 class="card-title text-primary">--}}
{{--                        <i class="fa fa-edit"></i>--}}
{{--                        Expense report : For --}}
{{--                    </h4>--}}
                    <div id="table" class="table-responsive">
                        @include('backend.expenses.expense-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


@endsection
{{--this script override all--}}
@section('script') @include('backend.expenses.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.expenses.style') @endsection


