@extends('backend.master')
@section('document-title') Class Wise Payment Report @endsection
@section('page-title') Class Wise Payment Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('class-wise-payment-report') }}">Class Wise Payment Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('create-class-wise-invoice') }}" method="post" id="">
                @csrf
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

                                    <div class="col-lg">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Class</span>
                                            </div>
                                            <select class="form-control" name="class_id" onchange="getPaymentItem()">
                                                <option value="">--Select--</option>
                                                <option value="all" {{ Session::get('class_id') == 'all' ? 'selected' : '' }}>All Classes</option>
                                                @foreach(activeAllClasses() as $class)
                                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                    {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

{{--                                    <div class="col-lg pr-lg-0">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text">Payment For</span>--}}
{{--                                            </div>--}}
{{--                                            <select class="form-control" name="item_id">--}}
{{--                                                <option value="">--Select--</option>--}}
{{--                                                @foreach($items as $transactionItem)--}}
{{--                                                    <option value="{{ $transactionItem->item_id }}" {{ Session::get('item_id') == $transactionItem->item_id ? 'selected' : '' }}>{{ $transactionItem->item->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-lg">--}}
{{--                                        <div class="input-group">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text">Month</span>--}}
{{--                                            </div>--}}
{{--                                            <select class="form-control" name="month_id">--}}
{{--                                                <option value="">--Select--</option>--}}
{{--                                                @foreach(months() as $invMonth)--}}
{{--                                                    <option value="{{ $invMonth->id }}" {{ Session::get('month_id') == $invMonth->id ? 'selected' : '' }}>{{ $invMonth->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                                <option value="na" {{ Session::get('month_id') == 'na' ? 'selected' : '' }}>N/A</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


                                </div>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" onclick="classWiseDueReport()" class="btn btn-block btn-primary">
                                    {{--                                    <i class="fa fa-list-alt"></i>--}}
                                    Get List
                                </button>
                            </div>
                        </div>
                        <div id="table" class="table-responsive p-0 mt-2">
                            @include('backend.students.invoice.class-wise-due-report-table')
{{--                            @include('backend.students.invoice.payment-report-table')--}}
                        </div>
                    </div>
                </div>
            </form>
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


