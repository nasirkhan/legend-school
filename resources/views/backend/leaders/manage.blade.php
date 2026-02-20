@extends('backend.master')
@section('document-title') Leader Management @endsection
@section('page-title') Leader Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('leaders') }}">Leader Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.leaders.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.leaders.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.leaders.style') @endsection


