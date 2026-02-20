@extends('backend.master')
@section('document-title') Testimonial Management @endsection
@section('page-title') Testimonial Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('pages') }}">Testimonial Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.testimonials.table-container')
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.testimonials.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.testimonials.style') @endsection


