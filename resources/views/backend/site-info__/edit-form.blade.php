@extends('backend.master')
@section('document-title') Site Info Edit @endsection
@section('page-title') Site Info Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('site-info-edit',['id'=>$info->id]) }}">Site Info Edit</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="editForm">
                    <h5 class="card-title text-primary mb-3">Property Edit Form</h5>
                    <form class="" action="{{ route('site-info-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col col-md-5 pr-md-0">
                                <label class="sr-only">Property</label>
                                <input type="text" name="property" value="{{ $info->property }}" class="form-control" placeholder="Property" readonly>
                            </div>

                            <div class="col col-md-5 pr-md-0">
                                <label class="sr-only">Value</label>
                                <input type="{{ $info->type != 'file' ? 'text' : 'file' }}" name="value" value="{{ $info->type != 'textarea' ? $info->value : 'value' }}" {{ $info->type != 'textarea' ? '' : 'readonly' }} class="form-control" placeholder="Value">
                            </div>

                            <input type="hidden" name="id" value="{{ $info->id }}">

                            <div class="col col-md-2">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                        <div class="row mt-3" id="editor" style="display: {{ $info->type != 'textarea' ? 'none' : '' }}">
                            <div class="col-12">
                                <textarea name="editor" class="summernote">{!! $info->type != 'textarea' ? '' : $info->value !!}</textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.site-info.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.site-info.style') @endsection



