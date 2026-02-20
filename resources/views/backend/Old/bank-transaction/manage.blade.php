@extends('backend.master')
@section('document-title') Bank Deposit/Withdrawal @endsection
@section('page-title') Bank Deposit/Withdrawal @endsection
@section('active-breadcrumb-item') <a href="{{ route('bank-transaction') }}">Bank Deposit/Withdrawal</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.bank-transaction.form-container')
{{--    @include('backend.bank-account.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.bank-transaction.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.bank-transaction.style') @endsection
