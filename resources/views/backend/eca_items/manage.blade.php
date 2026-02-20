@extends('backend.master')
@section('document-title') ECA Item Management @endsection
@section('page-title') ECA Item Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('eca-items') }}">ECA Item Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.eca_items.form-container')
    @include('backend.eca_items.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.eca_items.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.eca_items.style') @endsection


