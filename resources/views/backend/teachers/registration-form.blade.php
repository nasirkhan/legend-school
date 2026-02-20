@extends('backend.master')
@section('document-title') Teacher Registration @endsection
@section('page-title') Teacher Registration @endsection
@section('active-breadcrumb-item') <a href="{{ route('teachers') }}">Teacher Registration</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}

@section('content')
    @include('backend.teachers.form-container')
{{--    @include('backend.teachers.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.teachers.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.teachers.style') @endsection


