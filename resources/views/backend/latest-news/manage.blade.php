@extends('backend.master')
@section('document-title') Latest News Management @endsection
@section('page-title') Latest News Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('latest-news') }}">Latest News Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.latest-news.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.latest-news.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.latest-news.style') @endsection


