@extends('backend.master')
@section('document-title')
    Year Wise School Transcript Form
@endsection
@section('page-title')
    Year Wise School Transcript Form
@endsection
@section('active-breadcrumb-item')
    <a href="{{ route('school-transcript',['from'=>'private']) }}">Year Wise School Transcript Form</a>
@endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8 pr-lg-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Year</span>
                                        </div>
                                        <select class="form-control pl-2" name="year">
                                            <option value="null">--Select--</option>
                                            @foreach(activeYears() as $year)
                                                <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>
                                                    {{ $year->year }} - {{ $year->year+1 }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--                                <div class="col-lg pr-lg-0">--}}
                                {{--                                    <div class="input-group">--}}
                                {{--                                        <div class="input-group-prepend">--}}
                                {{--                                            <span class="input-group-text">Session</span>--}}
                                {{--                                        </div>--}}
                                {{--                                        <select class="form-control pl-2" name="session_id">--}}
                                {{--                                            <option value="">--Select--</option>--}}
                                {{--                                            @foreach(activeSessions() as $session)--}}
                                {{--                                                <option value="{{ $session->id }}">{{ $session->name }}</option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="col-lg">--}}
                                {{--                                    <div class="input-group">--}}
                                {{--                                        <div class="input-group-prepend">--}}
                                {{--                                            <span class="input-group-text">Class</span>--}}
                                {{--                                        </div>--}}
                                {{--                                        <select class="form-control pl-2" name="class_id">--}}
                                {{--                                            <option value="">--Select--</option>--}}
                                {{--                                            @foreach(activeClasses() as $class)--}}
                                {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="col-lg-2 pr-lg-0">
                            <button type="button" onclick="window.location.reload()" class="btn btn-block btn-primary"><i
                                    class="fa fa-sync"></i> Get Student List
                            </button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" onclick="privateStudentAddForm()" class="btn btn-block btn-success"><i
                                    class="fa fa-user-plus"></i> Add New Student
                            </button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        @include('backend.school-transcript.private.private-student-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    @include('backend.school-transcript.private.modal.student-add-form')
    @include('backend.school-transcript.private.modal.student-edit-form')
@endsection

{{--this script override all--}}
@section('script')
    @include('backend.school-transcript.script')
@endsection
{{--this style override all--}}
@section('style')
    @include('backend.school-transcript.style')
@endsection
