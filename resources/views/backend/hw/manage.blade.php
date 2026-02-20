@extends('backend.master')
@section('document-title') HW Management @endsection
@section('page-title') HW Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('class-wise-hw-list') }}">HW Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
{{--    @include('backend.teachers.form-container')--}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="addForm">
                <h5 class="card-title text-primary font-weight-bold mb-3">Class Wise HW List
                    <a href="{{ route('hw-add-form') }}" class="btn btn-primary btn-sm">Go To HW Add Form</a>
                </h5>
                <div class="row">
                    <div class="col-lg-3 mb-3 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Year</span>
                            </div>
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

                    <div class="col-lg-3 mb-3 pr-lg-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Class</span>
                            </div>
                            {{--                            <select class="form-control" name="class_id" onchange="getExam()">--}}
                            <select class="form-control" name="class_id">
                                <option value="">--Select--</option>
                                @foreach(activeClasses() as $class)
                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id? 'selected' : '' }}>{{ $class->name }}</option>
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

@include('backend.hw.table-container')
@endsection
{{--this script override all--}}
@section('script') @include('backend.hw.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.hw.style') @endsection


