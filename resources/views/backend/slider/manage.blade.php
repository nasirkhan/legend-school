@extends('backend.master')
@section('document-title') Slider Management @endsection
@section('page-title') Slider Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('slides') }}">Slider Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.slider.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.slider.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.slider.style') @endsection


