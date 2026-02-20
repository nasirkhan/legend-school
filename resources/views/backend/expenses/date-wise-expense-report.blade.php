@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title')
    Income-Expense report : From {{ dateFormat($from,'jS M-Y') }} To {{ dateFormat($to,'jS M-Y') }}
@endsection
@section('page-title') Income-Expense Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('date-wise-expense-report') }}">Income-Expense Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')

{{--Main Content of the page goes here--}}
@section('content')
    {{--    @if($role=='developer' or $role=='s_admin')--}}
    {{--        --}}
    {{--    @endif--}}
    @include('backend.expenses.report-form-container')
    @include('backend.expenses.report-container')
    {{--    @include('backend.items.modal.item-add-form')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.expenses.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.expenses.style') @endsection


