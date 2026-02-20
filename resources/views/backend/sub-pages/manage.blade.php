@extends('backend.master')
@section('document-title') Sub Page Management @endsection
@section('page-title') Sub Page Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('sub-pages') }}">Sub Page Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.sub-pages.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.sub-pages.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.sub-pages.style') @endsection


