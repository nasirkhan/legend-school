@extends('backend.master')
@section('document-title') Batch Wise Payment Report @endsection
@section('page-title') Batch Wise Payment Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('report-form',['from'=>'payment','type'=>'batch-wise']) }}">Batch Wise Payment Report</a> @endsection

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <form action="{{ route('report') }}" method="POST">
                                @csrf
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
                                        <button type="button" onclick="getBatchWiseStudent()" class="btn btn-block btn-secondary"><i class="fa fa-eye"></i> View</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg">
                            <form target="_blank" action="{{ route('report') }}" method="POST">
                                @csrf
                                <input name="year" id="printYear" value="{{ date('Y') }}" type="hidden">
                                <input name="session_id" id="printSessionId" type="hidden">
                                <input name="class_id" id="printClassId" type="hidden">
                                <input name="batch_id" id="printBatchId" type="hidden">
                                <input type="hidden" name="from" value="payment"/>
                                <input type="hidden" name="report_type" value="batch-wise"/>
                                <input type="hidden" name="type" value="print"/>
                                <button type="submit" class="btn btn-block btn-primary"><i class="bx bx-printer"></i> Print</button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        @include('backend.report.payments.batch-wise-report-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection

{{--this script override all--}}
@section('script') @include('backend.report.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.report.style') @endsection
