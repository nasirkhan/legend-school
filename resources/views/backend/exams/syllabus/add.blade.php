@extends('backend.master')
@section('document-title') Exam Syllabus and Schedule Management @endsection
@section('page-title') Exam Syllabus and Schedule Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('syllabus') }}">Exam Syllabus and Schedule Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('backend.exams.syllabus.add-form')
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.syllabus.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.syllabus.style') @endsection


