@extends('backend.master')
@section('document-title') HW Review @endsection
@section('page-title') HW Review @endsection
@section('active-breadcrumb-item') <a href="{{ route('class-wise-hw-list') }}">HW Review</a> @endsection
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
                                <th>Class : {{ $hw->classInfo->name }}</th>
                                <th>Subject : {{ $hw->subject->name }}</th>
                                <th style="width: 250px" class="text-center">Submission Date : {{ ordinalNumber(dateFormat($hw->submission_date,'j')) }} {{ dateFormat($hw->submission_date,'M Y') }}</th>
                            </tr>
                            <tr><th colspan="2">Title : {{ $hw->title }}</th><th class="text-center"> Created by: {{ $hw->creator }}</th></tr>
                            <tr><td colspan="3">{!! $hw->hw_detail !!}</td></tr>

                            <tr>
                                <td colspan="3">
                                    <a href="{{ route('class-wise-hw-list') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                                    <a href="{{ route('hw-edit',['id'=>$hw->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('hw-status-update',['id'=>$hw->id]) }}" class="btn btn-sm btn-{{ $hw->status==1? 'success':'warning' }}">
                                        <i class="fa fa-arrow-{{ $hw->status==1? 'up':'down' }}"></i> {{ $hw->status == 1? 'Publish':'Unpublished' }}
                                    </a>
                                    @if(isset($hw->attachment_url))
                                        <a class="btn btn-sm btn-danger" href="{{ route('hw-delete-attachment',['id'=>$hw->id]) }}" onclick="return confirm('Press OK to delete the Attachment')">
                                            <i class="fa fa-times-circle"></i> Delete Attachment
                                        </a>
                                    @endif
                                    <a href="{{ route('hw-delete',['id'=>$hw->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Press OK to delete the HW')">
                                        <i class="fa fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </tr>

                            @if(isset($hw->attachment_url))
                                <tr>
                                    <td colspan="3">
                                        <embed src="{{ asset($hw->attachment_url) }}" width="100%" height="500" type="application/pdf">
                                        {{--                                        <a target="_blank" href="{{ asset($hw->attachment_url) }}"> See Attachment <i class="fa fa-paperclip"></i></a>--}}
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
@section('script') @include('backend.hw.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.hw.style') @endsection


