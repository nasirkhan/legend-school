@extends('backend.master')
@section('document-title') Slide Management @endsection
@section('page-title') Slide Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('slides') }}">Slide Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Add New Slide</h5>
                    <form class="" action="{{ route('slide-save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10 mb-3  pr-md-0">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Slide Title</span>
                                    </div>
                                    <input type="text" name="title" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Description</span>
                                    </div>
                                    <input type="text" name="description" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Page Link</span>
                                    </div>
                                    <input type="text" name="page_link" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Thumbnail</span>
                                    </div>
                                    <input type="file" name="thumbnail" class="form-control pt-1 pl-1" onchange="showImage(this, 'thumbnail_show')"/>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-3">
{{--                                <img width="100%" class="img-thumbnail" id="thumbnail_show" src="{{ asset('assets/images/user-avatar.png') }}" alt="Image Not Found">--}}
                                <img width="100%" class="img-thumbnail" id="thumbnail_show" src="" alt="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.slider.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.slider.style') @endsection




