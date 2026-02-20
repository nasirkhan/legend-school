@extends('backend.master')
@section('document-title') Menu Management @endsection
@section('page-title') Menu Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('menus') }}">Menu Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.menu.form-container')
    @include('backend.menu.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.menu.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.menu.style') @endsection


