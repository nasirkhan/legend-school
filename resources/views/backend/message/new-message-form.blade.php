@extends('backend.master')
@section('document-title') New Message Form @endsection
@section('page-title') New Message Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('message-form',['from'=>'new']) }}"> New Message Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <form class="form" action="{{ route('send-message') }}" method="POST">
    @csrf
        <div class="row">
            <div class="col-lg-11 pr-lg-0">
                <div class="row">
                    <div class="col-lg pr-lg-0 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">AC. Year</span>
                            </div>
                            <select class="form-control" name="year">
                                <option value="">--Select--</option>
                                @foreach(activeYears() as $year)
                                    <option value="{{ $year->year }}" {{ date('Y') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">AC. Session</span>
                            </div>
                            <select class="form-control" name="session_id">
                                <option value="">--Select--</option>
                                @foreach(activeSessions() as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">SMS Type</span>
                            </div>
                            <select class="form-control select2" name="sms_type" required>
                                <option value="">--Select--</option>
                                <option value="result">Result</option>
                                <option value="attendance">Attendance</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg pr-lg-0 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Class</span>
                            </div>
                            <select class="form-control" name="class_id" onchange="getData()">
                                <option value="">--Select--</option>
                                @foreach(activeClasses() as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-lg mb-2" id="batch">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Batch</span>
                            </div>
                            <select class="form-control select2" name="batch_id" id="batch_id">
                                <option value="">--Select-- </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg mb-2" id="exam" style="display: none">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Exam</span>
                            </div>
                            <select class="form-control select2" name="exam_id" id="exam_id">
                                <option value="">--Select-- </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg mb-2" id="month" style="display: none">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Month</span>
                            </div>
                            <select class="form-control select2" name="month_id" id="month_id">
                                <option value="">--Select-- </option>
                                @foreach(months() as $month)
                                    <option value="{{ $month->id }}">{{ $month->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 mb-2">
                <button type="button" onclick="getStudents()" class="btn btn-block btn-primary"> Get List</button>
            </div>

            <div class="col-12">
                <div class="form-group" style="position:relative;">
                    <label class="sr-only" for="name">Message Body</label>
                    <textarea name="sms_body" onkeyup="charCounter()" rows="5" class="form-control" placeholder="Message body....." style="display: none">{{ old('sms_body') }}</textarea>
                    <span class="badge badge-info" id="counter" style="left: 0px; bottom:0px; position: absolute; font-size: small"></span>
                </div>
            </div>

            <div class="col-12" id="table"></div>
        </div>
    </form>
@endsection
{{--this script override all--}}
@section('script') @include('backend.message.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.message.style') @endsection


