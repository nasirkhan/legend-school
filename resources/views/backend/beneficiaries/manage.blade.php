@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title') Account Holder Management @endsection
@section('page-title') Account Holder Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('expense-items') }}">Account Holder Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @if($role=='developer' or $role=='s_admin' or $role=='accountant')
        @include('backend.beneficiaries.form-container')
    @endif
    @include('backend.beneficiaries.table-container')
    {{--    @include('backend.items.modal.item-add-form')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.beneficiaries.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.beneficiaries.style') @endsection
