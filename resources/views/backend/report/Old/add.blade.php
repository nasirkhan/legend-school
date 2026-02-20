@extends('backend.master')
@section('document-title') Client Add@endsection
@section('page-title') Client Add @endsection
@section('active-breadcrumb-item') <a href="{{ route('client-add') }}">Client Add</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.client.form-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection


