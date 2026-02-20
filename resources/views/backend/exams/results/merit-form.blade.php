@extends('backend.master')
@section('document-title') Class Wise Result View Form @endsection
@section('page-title') Class Wise Result View Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('result',['from'=>'view']) }}">Class Wise Result View Form</a> @endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
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
                                        <select class="form-control pl-2" name="year">
                                            <option value="">--Select--</option>
                                            @foreach(activeYears() as $year)
                                                <option value="{{ $year->year }}" {{ date('Y') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Session</span>
                                        </div>
                                        <select class="form-control pl-2" name="session_id">
                                            <option value="">--Select--</option>
                                            @foreach(activeSessions() as $session)
                                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Class</span>
                                        </div>
                                        <select class="form-control pl-2" name="class_id" onchange="getExam()">
                                            <option value="">--Select--</option>
                                            @foreach(activeClasses() as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Exam</span>
                                        </div>
                                        <select class="form-control pl-2" name="exam_id" id="exam_id">
                                            <option value="">--Select-- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" onclick="getMeritList()" class="btn btn-block btn-primary">Submit</button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        @include('backend.exams.results.report-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

{{--this script override all--}}
@section('script') @include('backend.exams.results.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.exams.results.style') @endsection
