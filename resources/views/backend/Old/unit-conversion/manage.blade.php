@extends('backend.master')
@section('document-title') Unit Conversion @endsection
@section('page-title') Unit Conversion Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('unit-conversion') }}">Unit Conversion</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.unit-conversion.form-container')
    @include('backend.unit-conversion.table-container')
@endsection

@section('modal')
    @include('backend.unit-conversion.edit-form')
@endsection

{{--this script override all--}}
@section('script') @include('backend.unit-conversion.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.unit-conversion.style') @endsection


