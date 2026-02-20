@extends('backend.master')
@section('document-title') Teacher Edit @endsection
@section('page-title') Teacher Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('teachers') }}">Teacher Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}

@section('content')
{{--    @include('backend.teachers.form-container')--}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('backend.teachers.edit-form')
            </div>
        </div>
    </div>
{{--    @include('backend.teachers.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('backend.teachers.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.teachers.style') @endsection


