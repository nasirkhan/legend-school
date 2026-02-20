@extends('backend.master')
@section('document-title') Site Info @endsection
@section('page-title') Site Info Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('site-info') }}">Site Info</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
{{--    @include('backend.site-info.form-container')--}}
    @include('backend.site-info.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.site-info.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.site-info.style') @endsection


