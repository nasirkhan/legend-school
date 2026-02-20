@extends('backend.master')
@section('document-title') Student Regular Attendance Report @endsection
@section('page-title') Student Regular Attendance Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('attendance',['from'=>'regular', 'type'=>'view']) }}">Student Regular Attendance Report</a> @endsection

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
                                        <select class="form-control" name="year">
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
                                        <select class="form-control" name="session_id">
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
                                        <select class="form-control" name="class_id" onchange="getBatch(this)">
                                            <option value="">--Select--</option>
                                            @foreach(activeClasses() as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Batch</span>
                                        </div>
                                        <select class="form-control select2" name="batch_id" id="batch_id">
                                            <option value="">--Select-- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">From</span>
                                        </div>
                                        <input type="date" name="from" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">To</span>
                                        </div>
                                        <input type="date" name="to" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" onclick="getBatchWiseAttendanceReport()" class="btn btn-block btn-primary pr-1 pl-1"> Get</button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        {{--                            @include('backend.students.attendances.regular.add-table')--}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

@section('modal') @include('backend.students.attendances.modal.report-detail') @endsection

{{--this script override all--}}
@section('script') @include('backend.students.attendances.regular.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.attendances.regular.style') @endsection
