@php($role = isset(user()->role)? user()->role->code:'')
@extends('backend.master')
@section('document-title') Transaction Item Management @endsection
@section('page-title') Transaction Item Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('items') }}">Transaction Item Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @if($role=='developer' or $role=='s_admin')
        @include('backend.items.form-container')
    @endif
    @include('backend.items.table-container')
{{--    @include('backend.items.modal.item-add-form')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.items.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.items.style') @endsection


