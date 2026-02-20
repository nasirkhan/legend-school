@extends('backend.master')
@section('document-title') Section Wise Teachers @endsection
@section('page-title') Section Wise Teachers @endsection
@section('active-breadcrumb-item') <a href="{{ route('section-wise-teacher') }}">Section Wise Teachers</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
{{--                    <h5 class="card-title text-primary font-weight-bold mb-3">Teacher Registration Form</h5>--}}
                    <div class="row">
                        <div class="col-lg-10 pr-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Section</span>
                                </div>

                                <select class="form-control" name="section_id">
                                    <option value="">--Select--</option>
                                    @foreach(activeSections() as $section)
                                        <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button class="btn btn-primary btn-block" onclick="window.location.reload()">Get Teacher List</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--                <h4 class="card-title text-primary">Batch Table</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        @include('backend.teachers.section-teacher-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    @include('front.teacher.modal.subject-add-form')
@endsection
{{--this script override all--}}
@section('script') @include('backend.teachers.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.teachers.style') @endsection


