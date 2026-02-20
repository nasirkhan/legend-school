@extends('backend.master')
@section('document-title') Student Promotion Form @endsection
@section('page-title') Student Promotion Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('batches') }}">Student Promotion Form</a> @endsection
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
                    <form action="{{ route('promotion-save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10 pr-lg-0">
                                <div class="row">
                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Prev. AC. Year</span>
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
                                                <span class="input-group-text">Prev. Class</span>
                                            </div>
                                            <select class="form-control" name="class_id">
                                                <option value="">--Select--</option>
                                                @foreach(classes() as $class)
                                                    <option value="{{ $class->id }}" {{ Session::get('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                    {{--                                                <option value="{{ $class->id }}">{{ $class->name }}</option>--}}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg pr-lg-0">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Next AC. Year</span>
                                            </div>
                                            <select class="form-control" name="next_year">
                                                <option value="">--Select--</option>
                                                @foreach(activeYears() as $year)
                                                    <option value="{{ $year->year }}" {{ Session::get('next_year') == $year->year ? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Next Class</span>
                                            </div>
                                            <select class="form-control" name="next_class_id">
                                                <option value="">--Select--</option>
                                                @foreach(classes() as $class)
                                                    <option value="{{ $class->id }}" {{ Session::get('next_class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" onclick="getClassWiseStudent()" class="btn btn-block btn-primary"><i class="fa fa-list-alt"></i> Get List</button>
                            </div>
                        </div>
                        <div id="table" class="table-responsive p-1">
                            @include('backend.students.promotion.table')
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.students.promotion.script')
    <script src="{{ asset('assets/js/pages/custom-mini-editor.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.students.promotion.style') @endsection


