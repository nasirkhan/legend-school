@extends('backend.master')
@section('document-title') Class Management @endsection
@section('page-title') Class Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('classes') }}">Class Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.classes.form-container')
    @include('backend.classes.table-container')
    @include('backend.classes.modal.subject-add-form')
    @include('backend.classes.modal.lab-subject-add-form')
@endsection
{{--this script override all--}}
@section('script') @include('backend.classes.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.classes.style') @endsection


