@extends('backend.master')
@section('document-title') Subject Management @endsection
@section('page-title') Subject Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('subjects') }}">Subject Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.subjects.form-container')
    @include('backend.subjects.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.subjects.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.subjects.style') @endsection


