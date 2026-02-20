@extends('backend.master')
@section('document-title') Exam Edit @endsection
@section('page-title') Exam Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('exams') }}">Exam Edit</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
{{--                @include('backend.exams.add-form')--}}
                @include('backend.exams.edit-form')
            </div>
        </div>
    </div>
    @include('backend.exams.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.style') @endsection


