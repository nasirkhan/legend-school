@extends('backend.master')
@section('document-title') Bank Account Add @endsection
@section('page-title') Bank Account Add @endsection
@section('active-breadcrumb-item') <a href="{{ route('bank-account') }}">Bank Account Add</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.bank-account.form-container')
{{--    @include('backend.bank-account.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.bank-account.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.bank-account.style') @endsection
