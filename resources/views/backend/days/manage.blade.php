@extends('backend.master')
@section('document-title') Day Management @endsection
@section('page-title') Day Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('days') }}">Day Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.days.form-container')
    @include('backend.days.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.days.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.days.style') @endsection


