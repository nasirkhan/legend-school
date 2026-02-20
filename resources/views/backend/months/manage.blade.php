@extends('backend.master')
@section('document-title') Month Management @endsection
@section('page-title') Month Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('months') }}">Month Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.months.form-container')
    @include('backend.months.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.months.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.months.style') @endsection


