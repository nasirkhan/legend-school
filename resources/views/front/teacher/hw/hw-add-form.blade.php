@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s HW Add Form</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        @if(Auth::user())
                            <li class="breadcrumb-item"><a href="{{ route('teacher-detail',['id'=>$teacher->id]) }}">Teacher's Portal</a></li>
                        @else

                        @endif

                        <li class="breadcrumb-item">{{ 'Dashboard' }}</li>
                        <li class="breadcrumb-item active"><a href="{{ route('teacher-hw-add-form') }}">HW Add Form</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
{{--@include('backend.includes.data-table')--}}

{{--Main Content of the page goes here--}}

@section('content')
    @include('front.teacher.hw.form-container')
{{--    @include('backend.teachers.table-container')--}}
@endsection
{{--this script override all--}}
@section('script') @include('front.teacher.hw.script') @endsection
{{--this style override all--}}
@section('style') @include('front.teacher.hw.style') @endsection


