{{--@extends('backend.master')--}}
{{--@section('document-title') Page Management @endsection--}}
{{--@section('page-title') Page Management @endsection--}}
{{--@section('active-breadcrumb-item') <a href="{{ route('pages') }}">Page Management</a> @endsection--}}
{{--This file must be included if Bootstrap Datatable is needed--}}
{{--@include('backend.includes.data-table')--}}
{{--Main Content of the page goes here--}}
{{--@section('content')--}}
{{--    --}}
{{--@endsection--}}
{{--this script override all--}}
{{--@section('script') @include('backend.pages.script') @endsection--}}
{{--this style override all--}}
{{--@section('style') @include('backend.pages.style') @endsection--}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="addForm">
                <h5 class="card-title text-primary mb-3">Add New Gallery Image (Size Should Be: 740px &times; 560px)</h5>
                <form class="" action="{{ route('gallery-image-save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="width: 110px">
                                            <span class="input-group-text" style="width: 100%">Title</span>
                                        </div>
                                        <input type="text" name="title" class="form-control" placeholder="***Caption" required/>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="width: 110px">
                                            <span class="input-group-text" style="width: 100%">Description</span>
                                        </div>
                                        <input type="text" name="description" class="form-control" placeholder="Optional"/>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend" style="width: 110px">
                                            <span class="input-group-text" style="width: 100%">Image</span>
                                        </div>
                                        <input type="file" name="thumbnail" class="form-control pt-1 pl-1" onchange="showImage(this, 'thumbnail_show')"/>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-6 pr-0">
                                    <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                                </div>

                                <div class="col-lg-2 col-md-4 col-sm-6">
                                    <button type="reset" class="btn btn-block btn-warning"><i class="fa fa-times-circle"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <img width="100%" class="img-thumbnail" id="thumbnail_show" src="{{ asset('assets/app/gallery-images/camera.png') }}" alt="">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
