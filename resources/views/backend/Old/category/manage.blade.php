@extends('backend.master')
@section('document-title') Category @endsection
@section('page-title') Category Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('category') }}">Category</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.category.form-container')
    @include('backend.category.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.category.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.category.style') @endsection


