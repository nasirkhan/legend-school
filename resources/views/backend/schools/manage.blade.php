@extends('backend.master')
@section('document-title') School Management @endsection
@section('page-title') School Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('schools') }}">School Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.schools.form-container')
    @include('backend.schools.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.schools.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.schools.style') @endsection


