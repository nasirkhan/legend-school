@extends('backend.master')
@section('document-title') Teachers Management @endsection
@section('page-title') Teachers Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('teachers') }}">Teachers Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
{{--    @include('backend.teachers.form-container')--}}
    @include('backend.teachers.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.teachers.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.teachers.style') @endsection


