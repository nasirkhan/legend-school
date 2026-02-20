@extends('backend.master')
@section('document-title') Sub Category @endsection
@section('page-title') Sub Category @endsection
@section('active-breadcrumb-item') <a href="{{ route('sub-category') }}">Sub Category</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.sub-category.form-container')
    @include('backend.sub-category.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.sub-category.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.sub-category.style') @endsection


