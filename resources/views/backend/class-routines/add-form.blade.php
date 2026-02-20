@extends('backend.master')
@section('document-title') Class Routine Management @endsection
@section('page-title') Class Routine Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('class-routines') }}">Class Routine Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Add New Class Routine</h5>
                    <form class="" action="{{ route('class-routine-save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Class</span>
                                    </div>
                                    <select class="form-control" name="class_id">
                                        <option value="">--Select--</option>
                                        @foreach(activeClasses() as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">File</span>
                                    </div>
                                    <input type="file" name="file" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col col-md-2 mb-3">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.class-routines.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.class-routines.style') @endsection




