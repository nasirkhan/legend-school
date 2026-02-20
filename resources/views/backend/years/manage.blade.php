@extends('backend.master')
@section('document-title') Academic Year Management @endsection
@section('page-title') Academic Year Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('years') }}">Academic Year Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.years.form-container')
    @include('backend.years.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.years.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.years.style') @endsection


