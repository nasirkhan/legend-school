@extends('backend.master')
@section('document-title') Section Management @endsection
@section('page-title') Section Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('sections') }}">Section Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.sections.form-container')
    @include('backend.sections.table-container')
    @include('backend.sections.modal.class-add-form')
@endsection
{{--this script override all--}}
@section('script') @include('backend.sections.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.sections.style') @endsection


