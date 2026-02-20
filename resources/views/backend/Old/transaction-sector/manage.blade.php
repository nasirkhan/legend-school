@extends('backend.master')
@section('document-title') Transaction Sector @endsection
@section('page-title') Transaction Sector Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('transaction-sector') }}">Transaction Sector</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.transaction-sector.form-container')
    @include('backend.transaction-sector.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.transaction-sector.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.transaction-sector.style') @endsection


