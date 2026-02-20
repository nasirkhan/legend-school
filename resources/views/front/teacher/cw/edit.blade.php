@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Class Activity Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">{{ 'Dashboard' }}</li>
                        <li class="breadcrumb-item active"><a href="{{ route('teacher-cw-edit',['id'=>$cw->id]) }}">Class Activity Edit Form</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @include('front.teacher.cw.edit-form')
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('front.teacher.cw.script') @endsection
{{--this style override all--}}
@section('style') @include('front.teacher.cw.style') @endsection


