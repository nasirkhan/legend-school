@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s HW List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary font-weight-bold mb-3">Class Wise HW List
                        <a href="{{ route('teacher-hw-add-form') }}" class="btn btn-primary btn-sm">Go To HW Add Form</a>
                    </h5>
                    <div class="row">
                        <div class="col-lg-3 mb-3 pr-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Year</span>
                                </div>
{{--                                <select class="form-control" name="year" onchange="getTeacherClasses(this.value)">--}}
                                <select class="form-control" name="year">
                                    <option value="">--Select--</option>
                                    @foreach(activeYears() as $year)
                                        <option value="{{ $year->year }}" {{ Session::get('year') == $year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-3 pr-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Class</span>
                                </div>
                                {{--                            <select class="form-control" name="class_id" onchange="getExam()">--}}
{{--                                <select class="form-control" name="class_id" onchange="getTeacherSubject(this.value)">--}}
                                <select class="form-control" name="class_id" onchange="getSubjects()">
                                    <option value="">--Select--</option>
{{--                                    @php($classes = teacherClass(Session::get('year'),Session::get('teacherId')))--}}
{{--                                    @foreach($classes as $class)--}}
                                    @foreach(activeAllClasses() as $class)
                                        <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 pr-lg-0 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Subject</span>
                                </div>

                                <select name="subject_id" class="form-control" required>
                                    <option value="">--Select--</option>
{{--                                    @php($subjects = teacherClassSubject(Session::get('year'),Session::get('teacherId'),Session::get('class_id')))--}}
{{--                                    @foreach($subjects as $subject)--}}
{{--                                        <option value="{{ $subject->id }}" {{ Session::get('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>--}}
{{--                                    @endforeach--}}

                                    @foreach($classSubjects as $classSubject)
                                        {{--                            <option value="{{ $subject->id }}" {{ Session::get('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>--}}
                                        <option value="{{ $classSubject->subject_id }}" {{ Session::get('subject_id') == $classSubject->subject_id ? 'selected' : '' }}>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <button class="btn btn-primary btn-block" onclick="location.reload()"><i class="fa fa-paper-plane"></i> Check Home Work List</button>
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
                        @include('front.teacher.hw.table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('front.teacher.hw.script') @endsection
{{--this style override all--}}
@section('style') @include('front.teacher.hw.style') @endsection


