@extends('backend.master')
@section('document-title') Popular ECA Management @endsection
@section('page-title') Popular ECA Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('popular-classes') }}">Popular ECA Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.popular-classes.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.popular-classes.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.popular-classes.style') @endsection


