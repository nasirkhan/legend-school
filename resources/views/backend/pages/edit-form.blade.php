@extends('backend.master')
@section('document-title') Page Edit @endsection
@section('page-title') Page Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('pages') }}">Page Edit</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Edit Page Information</h5>
                    <form class="" action="{{ route('page-update',['id'=>$page->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Menu</span>
                                    </div>
                                    <select class="form-control" name="menu_id">
                                        <option value="">--Select--</option>
                                        @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}" {{ $page->menu_id == $menu->id ? 'selected':'' }}>{{ $menu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Menu Text</span>
                                    </div>
                                    <input type="text" name="menu_txt" class="form-control" value="{{ $page->menu_txt }}" required/>
                                </div>
                            </div>

                            <div class="col-md-2 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 80px">
                                        <span class="input-group-text" style="width: 100%">Position</span>
                                    </div>
                                    <input type="text" name="position" class="form-control" value="{{ $page->position }}" required/>
                                </div>
                            </div>

                            <div class="col col-md-2 mb-3">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 110px">
                                        <span class="input-group-text" style="width: 100%">Page Title</span>
                                    </div>
                                    <input type="text" name="title" value="{{ $page->title }}" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label>Page Content</label>
                                <textarea class="form-control summernote" rows="10" name="page_content">{!! $page->content !!}</textarea>
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
                                <img width="100%" class="img-thumbnail" id="thumbnail_show" src="{{ asset($page->thumbnail) }}" alt="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.pages.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.pages.style') @endsection




