@extends('backend.master')
@section('document-title') Student Exam Result Add Form @endsection
@section('page-title') Student Exam Result Add Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('result',['from'=>'add']) }}">Student Exam Result Add Form</a> @endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form id="form" action="{{ route('result-save') }}" method="POST">
{{--            <form id="" action="{{ route('result-save') }}" method="POST">--}}
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-11 pr-lg-0">
                                <div class="row">
                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Year</span>
                                            </div>
                                            <select class="form-control pl-2" name="year" onchange="clearTable()">
                                                <option value="">--Select--</option>
                                                @foreach(activeYears() as $year)
                                                    <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Section</span>
                                            </div>
                                            <select class="form-control pl-2" name="section_id" onchange="getClasses(this.value); clearTable()">
                                                <option value="">--Select--</option>
                                                @foreach(activeSections() as $section)
                                                    <option value="{{ $section->id }}" {{ Session::get('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Class</span>
                                            </div>
                                            <select class="form-control pl-2" name="class_id" onchange="getExam(); clearTable(); getSubject(this.value);">
                                                <option value="">--Select--</option>
                                                @foreach(activeClasses() as $class)
                                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Exam</span>
                                            </div>
{{--                                            <select class="form-control pl-2" name="exam_id" id="exam_id" onchange="getPaper()">--}}
                                            <select class="form-control pl-2" name="exam_id" id="exam_id" onchange="clearTable()">
                                                <option value="">--Select-- </option>
                                                @foreach(activeExams() as $exam)
                                                    <option value="{{ $exam->id }}" {{ Session::get('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Subject</span>
                                            </div>
                                            <select class="form-control pl-2" name="subject_id" id="subject_id" onchange="clearTable()">
                                                <option value="">--Select--</option>
                                                @foreach(activeSubjects() as $subject)
                                                    <option value="{{ $subject->subject_id }}">{{ $subject->sub_code }} - {{ $subject->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

{{--                                    <div class="col-lg">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text">Paper</span>--}}
{{--                                            </div>--}}
{{--                                            <select class="form-control pl-2" name="paper_id" id="paper_id">--}}
{{--                                                <option value="">--Select--</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" onclick="getClassWiseStudent()" class="btn btn-block btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div id="table" class="table-responsive p-1">
                            @include('backend.exams.results.add-table')
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div>
@endsection

{{--this script override all--}}
@section('script') @include('backend.exams.results.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.results.style') @endsection
