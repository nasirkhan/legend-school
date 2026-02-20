@extends('backend.master')
@section('document-title') Others Income Report @endsection
@section('page-title') Others Income Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('other-income-report') }}">Others Income Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form" action="{{ route('date-to-date-other-income-report') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-5 pr-lg-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">From</span>
                                            </div>
                                            <input type="date" name="from" id="startDate" class="form-control" value="{{ date('Y-m-d') }}"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 pr-lg-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">To</span>
                                            </div>
                                            <input type="date" name="to" id="endDate" class="form-control" value="{{ date('Y-m-d') }}"/>
                                        </div>
                                    </div>

                                    <input type="hidden" name="type" value="view">

                                    <div class="col-lg-2 pr-lg-1">
                                        <button type="submit" class="btn btn-block btn-secondary"><i class="fa fa-eye"></i> View</button>
                                    </div>
                                </div>
                            </form>
                        </div>

{{--                        <div class="col-lg-2">--}}
{{--                            <form target="_blank" action="{{ route('date-to-date-other-income-report') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input class="d-none" type="date" id="printStartDate" name="from" value="{{ date('Y-m-d') }}"/>--}}
{{--                                <input class="d-none" type="date" id="printEndDate" name="to" value="{{ date('Y-m-d') }}"/>--}}
{{--                                <input type="hidden" name="type" value="print"/>--}}
{{--                                <button type="submit" class="btn btn-block btn-primary"><i class="bx bx-printer"></i> Print</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
{{--                    <h4 class="card-title text-primary">বিবিধ আয় বিস্তারিত রিপোর্ট</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        @include('backend.report.income.others-table')
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

@section('modal') @include('backend.report.income.income-edit-form') @endsection

@section('special-js') @include('backend.report.income.income-report-script') @endsection
