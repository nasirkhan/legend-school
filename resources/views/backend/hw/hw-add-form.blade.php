@extends('backend.master')
@section('document-title') HW Management @endsection
@section('page-title') HW Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('hw-add-form') }}"> Add form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}

@section('content')
    @include('backend.hw.form-container')
{{--    @include('backend.teachers.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.hw.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.hw.style') @endsection


