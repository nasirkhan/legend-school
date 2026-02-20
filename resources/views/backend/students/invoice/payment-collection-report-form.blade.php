@extends('backend.master')
@section('document-title') Payment Collection Report Form @endsection
@section('page-title') Payment Collection Report Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('payment-collection-report') }}">Payment Collection Report Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Select All Options and click on <kbd><i class="fa fa-list-alt"></i> Get List</kbd> Button</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-11 pr-lg-0">
                            <div class="row">
                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">From</span>
                                        </div>
                                        <input type="date" class="form-control" name="from" value="{{ Session::get('from')? Session::get('from') : date('Y-m-d') }}" required>
                                    </div>
                                </div>

                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">To</span>
                                        </div>
                                        <input type="date" class="form-control" name="to" value="{{ Session::get('to')? Session::get('to') : date('Y-m-d') }}" required>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Class</span>
                                        </div>
                                        <select class="form-control" name="class_id">
                                            <option value="">--Select--</option>
                                            <option value="all" {{ Session::get('class_id') == 'all' ? 'selected' : '' }}>All</option>
                                            @foreach(classes() as $class)
                                                <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" onclick="getPaymentReport()" class="btn btn-block btn-primary">
                                {{--                                    <i class="fa fa-list-alt"></i>--}}
                                Get List
                            </button>
                        </div>
                    </div>
                    <div id="table" class="table-responsive p-0 mt-2">
                        @include('backend.students.invoice.payment-report-table')
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.students.invoice.script')
{{--    <script src="{{ asset('assets/js/pages/custom-mini-editor.js') }}"></script>--}}
@endsection
{{--this style override all--}}
{{--@section('style') @include('backend.students.invoice.style') @endsection--}}


