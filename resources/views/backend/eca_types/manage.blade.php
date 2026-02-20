@extends('backend.master')
@section('document-title') ECA Type Management @endsection
@section('page-title') ECA Type Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('eca-types') }}">ECA Type Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.eca_types.form-container')
    @include('backend.eca_types.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.eca_types.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.eca_types.style') @endsection


