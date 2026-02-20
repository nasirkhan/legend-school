@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title') Expense Item Management @endsection
@section('page-title') Expense Item Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('expense-items') }}">Expense Item Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @if($role=='developer' or $role=='s_admin')
        @include('backend.expense-items.form-container')
    @endif
    @include('backend.expense-items.table-container')
{{--    @include('backend.items.modal.item-add-form')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.expense-items.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.expense-items.style') @endsection


