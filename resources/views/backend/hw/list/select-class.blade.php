@extends('backend.master')
@section('document-title') Class & Batch Wise Student List @endsection
@section('page-title') Class & Batch Wise Student List @endsection
@section('active-breadcrumb-item') <a href="{{ route('student-list',['from'=>'class']) }}">Class & Batch Wise Student List</a> @endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 pr-lg-0">
                            <div class="row">
                                <div class="col-lg pr-lg-0">
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

                                <div class="col-lg pr-lg-0">
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
                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Section</span>
                                        </div>
                                        <select class="form-control select2" name="batch_id" id="batch_id">
                                            <option value="">--Select-- </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" onclick="getBatchWiseStudent()" class="btn btn-block btn-primary"><i class="fa fa-list-alt"></i> Get List</button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        @include('backend.students.list.table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

{{--this script override all--}}
@section('script') @include('backend.students.list.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.list.style') @endsection


