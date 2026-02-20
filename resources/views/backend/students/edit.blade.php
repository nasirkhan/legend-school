@extends('backend.master')
@section('document-title') Student Edit Form @endsection
@section('page-title') Student Edit Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('student-edit',['id'=>$student->id]) }}">Student Edit Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('backend.students.edit-form')
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.students.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.style') @endsection


