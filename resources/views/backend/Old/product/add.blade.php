@extends('backend.master')
@section('document-title') Product List @endsection
@section('page-title') New Product @endsection
@section('active-breadcrumb-item') <a href="{{ route('product') }}">Product</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.product.form-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.product.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.product.style') @endsection


