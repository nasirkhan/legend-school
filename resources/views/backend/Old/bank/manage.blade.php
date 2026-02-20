@extends('backend.master')
@section('document-title') Bank @endsection
@section('page-title') Bank Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('bank') }}">Bank</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.bank.form-container')
    @include('backend.bank.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.bank.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.bank.style') @endsection


