@extends('backend.master')
@section('document-title') Exam Management @endsection
@section('page-title') Exam Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('exams') }}">Exam Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.exams.form-container')
    @include('backend.exams.table-container')
    @include('backend.includes.loader')
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.style') @endsection


