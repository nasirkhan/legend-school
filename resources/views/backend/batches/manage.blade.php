@extends('backend.master')
@section('document-title') Section Management @endsection
@section('page-title') Section Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('batches') }}">Section Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.batches.form-container')
    @include('backend.batches.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.batches.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.batches.style') @endsection


