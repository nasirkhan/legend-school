@extends('backend.master')
@section('document-title') Transaction Item @endsection
@section('page-title') Transaction Item Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('transaction-item') }}">Transaction Item</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.transaction-item.form-container')
    @include('backend.transaction-item.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.transaction-item.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.transaction-item.style') @endsection


