@extends('backend.master')
@section('document-title') Exam Paper Management @endsection
@section('page-title') Exam Paper Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('papers') }}">Exam Paper Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.exams.papers.form-container')
    @include('backend.exams.papers.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.papers.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.papers.style') @endsection


