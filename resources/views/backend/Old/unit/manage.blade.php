@extends('backend.master')
@section('document-title') Measurement Units @endsection
@section('page-title') Measurement Units @endsection
@section('active-breadcrumb-item') <a href="{{ route('unit') }}">Measurement Units</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.unit.form-container')
    @include('backend.unit.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.unit.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.unit.style') @endsection


