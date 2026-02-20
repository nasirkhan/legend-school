@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Class Activity List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">{{ 'Dashboard' }}</li>
                        <li class="breadcrumb-item active"><a href="{{ route('teacher-class-activity-add-form') }}">Class Activity Add Form</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="table" class="table-responsive p-1">
                        <table id="" class="table table-sm table-bordered table-hover table-centered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <tr>
                                <th>Class : {{ $cw->classInfo->name }}</th>
                                <th>Subject : {{ $cw->subject->name }}</th>
                                <th style="width: 250px" class="text-center">Lecture Date : {{ dateFormat($cw->date,'jS M Y') }}</th>
                            </tr>
                            <tr><th colspan="3">Chapter : {{ $cw->chapter }}</th></tr>
                            <tr><td colspan="3">{!! $cw->cw_detail !!}</td></tr>

                            <tr>
                                <td colspan="3">
                                    <a href="{{ route('teacher-class-wise-cw-list') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                                    <a href="{{ route('teacher-cw-edit',['id'=>$cw->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('teacher-cw-status-update',['id'=>$cw->id]) }}" class="btn btn-sm btn-{{ $cw->status==1? 'success':'warning' }}">
                                        <i class="fa fa-arrow-{{ $cw->status==1? 'up':'down' }}"></i> {{ $cw->status == 1? 'Publish':'Unpublished' }}
                                    </a>
                                    @if(isset($cw->attachment_url))
                                        <a class="btn btn-sm btn-danger" href="{{ route('teacher-cw-delete-attachment',['id'=>$cw->id]) }}" onclick="return confirm('Press OK to delete the Attachment')">
                                            <i class="fa fa-times-circle"></i> Delete Attachment
                                        </a>
                                    @endif
                                    <a href="{{ route('teacher-cw-delete',['id'=>$cw->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Press OK to delete the HW')">
                                        <i class="fa fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </tr>

                            @if(isset($cw->attachment_url))
                                <tr>
                                    <td colspan="3">
                                        <embed src="{{ asset($cw->attachment_url) }}" width="100%" height="800" type="application/pdf">
                                        {{--                                        <a target="_blank" href="{{ asset($cw->attachment_url) }}"> See Attachment <i class="fa fa-paperclip"></i></a>--}}
                                    </td>
                                </tr>
                            @endif
                        </table>
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


