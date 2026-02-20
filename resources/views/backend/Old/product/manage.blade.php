@extends('backend.master')
@section('document-title') Product List @endsection
@section('page-title') Product List @endsection
@section('active-breadcrumb-item') <a href="{{ route('product') }}">Product List</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.product.table-container')
@endsection

@section('modal')
    @include('backend.product.edit-form')
@endsection

{{--this script override all--}}
@section('script') @include('backend.product.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.product.style') @endsection


