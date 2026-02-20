@extends('backend.master')
@section('document-title') Leader Management @endsection
@section('page-title') Leader Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('leaders') }}">Leader Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Add New Leader</h5>
                    <form class="" action="{{ route('leader-save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Name</span>
                                    </div>
                                    <input type="text" name="name" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-md-5 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Designation</span>
                                    </div>
                                    <input type="text" name="designation" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col col-md-2 mb-3">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Description</span>
                                    </div>
                                    <input type="text" name="short_description" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label>Long Description</label>
                                <textarea class="form-control summernote" rows="10" name="description"></textarea>
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
@section('script') @include('backend.leaders.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.leaders.style') @endsection




