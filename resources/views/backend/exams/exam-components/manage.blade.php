@extends('backend.master')
@section('document-title') Exam Component Management @endsection
@section('page-title') Exam Component Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('exam-components') }}">Exam Component Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.exams.exam-components.form-container')
    @include('backend.exams.exam-components.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.exam-components.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.exam-components.style') @endsection


