@extends('backend.master')
@section('document-title') Due Report @endsection
@section('page-title') Due Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('invoice-check-form') }}">Due Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Select All Options and click on <kbd><i class="fa fa-list-alt"></i> Get Report</kbd> Button</h4>
                </div>
                <div class="card-body">
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
                                                <option value="{{ $year->year }}" {{ Session::get('year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Class</span>
                                        </div>
                                        <select class="form-control" name="class_id">
                                            <option value="">--Select--</option>
                                            <option value="all" {{ Session::get('class_id') == 'all' ? 'selected' : '' }}>All Classes</option>
                                            @foreach(activeAllClasses() as $class)
                                                <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg pr-lg-0">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Item</span>
                                        </div>
                                        <select class="form-control" name="item_id">
                                            <option value="">--Select--</option>
                                            @foreach(activeItems() as $item)
                                                <option value="{{ $item->id }}" {{ Session::get('item_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Month</span>
                                        </div>
                                        <select class="form-control" name="month_id">
                                            <option value="">--Select--</option>
                                            @foreach(months() as $month)
                                                <option value="{{ $month->id }}" {{ Session::get('month_id') == $month->id ? 'selected' : '' }}>{{ $month->name }}</option>
                                                {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" onclick="getDueReportNew()" class="btn btn-block btn-primary"><i class="fa fa-list-alt"></i> Get Report</button>
                        </div>
                    </div>
                    <div id="table" class="table-responsive p-1">
                        @include('backend.students.invoice.due-table-new')
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


