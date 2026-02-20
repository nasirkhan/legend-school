@extends('backend.master')
@section('document-title') Other Income-Expense @endsection
@section('page-title') Other Income-Expense Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('transaction') }}">Other Income-Expense</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.transaction.form-container')
{{--    @include('backend.transaction.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.transaction.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.transaction.style') @endsection


