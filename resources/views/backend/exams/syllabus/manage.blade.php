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
                {{--<div class="card-body" id="addForm">--}}
                <div class="card-body" id="">
                    <h5 class="card-title text-primary mb-3">Class and Exam Wise Syllabus <a class="btn btn-sm btn-primary" href="{{ route('syllabus-add-form') }}">Go to Syllabus Add Form</a></h5>
                    <form class="" action="{{ route('syllabus-save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg pr-lg-0 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Year</span>
                                    </div>
                                    <select class="form-control" name="year">
                                        <option value="">--Select--</option>
                                        @foreach(activeYears() as $year)
                                            <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg pr-lg-0 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Section</span>
                                    </div>
                                    <select class="form-control" name="section_id" onchange="getClasses(this.value)">
                                        <option value="">--Select--</option>
                                        @foreach(activeSections() as $section)
                                            <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg pr-lg-0 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Class</span>
                                    </div>
                                    <select class="form-control" name="class_id" onchange="getExam(this.value); getSubject(this.value)">
                                        <option value="">--Select--</option>
                                        @foreach(activeClasses() as $class)
                                            <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg pr-lg-0 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Exam</span>
                                    </div>
                                    <select class="form-control" name="exam_id" onchange="getSyllabus()">
                                        <option value="">--Select--</option>
                                        @foreach(activeExams() as $exam)
                                            <option value="{{ $exam->id }}" {{ Session::get('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <button type="button" onclick="getSyllabus()" class="btn btn-block btn-primary"><i class="fa fa-sync-alt"></i> Refresh</button>
{{--                                <button type="button" onclick="location.reload()" class="btn btn-block btn-primary"><i class="fa fa-sync-alt"></i> Refresh</button>--}}
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @include('backend.exams.syllabus.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.exams.syllabus.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.syllabus.style') @endsection


