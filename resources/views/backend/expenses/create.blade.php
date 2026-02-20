@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title') Other Income-Expense Management @endsection
@section('page-title') Other Income-Expense Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('create-expense') }}">Other Income-Expense Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}

@section('extra-stylesheet')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('extra-script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    {{--    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>--}}
    <script>$('.select2').select2();</script>
@endsection

@section('content')
{{--    @if($role=='developer' or $role=='s_admin')--}}
{{--        --}}
{{--    @endif--}}
    @include('backend.expenses.form-container')
{{--    @include('backend.items.modal.item-add-form')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.expenses.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.expenses.style') @endsection


