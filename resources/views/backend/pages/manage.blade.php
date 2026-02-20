@extends('backend.master')
@section('document-title') Page Management @endsection
@section('page-title') Page Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('pages') }}">Page Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.pages.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.pages.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.pages.style') @endsection


