@extends('backend.master')
@section('document-title') Gallery Image Management @endsection
@section('page-title') Gallery Image Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('gallery-images') }}">Gallery Image Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.gallery-images.add-form')
    @include('backend.gallery-images.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.gallery-images.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.gallery-images.style') @endsection


