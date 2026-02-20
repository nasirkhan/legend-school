@extends('backend.master')
@section('document-title') Academic Session Management @endsection
@section('page-title') Academic Session Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('academic-sessions') }}">Academic Session Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.academic-sessions.form-container')
    @include('backend.academic-sessions.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.academic-sessions.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.academic-sessions.style') @endsection


