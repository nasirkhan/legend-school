@extends('backend.master')
@section('document-title') Student Registration @endsection
@section('page-title') Student Registration @endsection
@section('active-breadcrumb-item') <a href="{{ route('batches') }}">Student Registration</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.students.form-container')
{{--    @include('backend.students.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.students.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.style') @endsection


