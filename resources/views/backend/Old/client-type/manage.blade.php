@extends('backend.master')
@section('document-title') Client Types @endsection
@section('page-title') Client Types @endsection
@section('active-breadcrumb-item') <a href="{{ route('client-type') }}">Client Types</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.client-type.form-container')
    @include('backend.client-type.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.client-type.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client-type.style') @endsection


