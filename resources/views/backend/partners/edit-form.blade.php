@extends('backend.master')
@section('document-title') News Edit Form @endsection
@section('page-title') News Edit Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('latest-news-edit',['id'=>$news->id]) }}">News Edit Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="addForm">
                    <h5 class="card-title text-primary mb-3">Edit News</h5>
                    <form class="" action="{{ route('latest-news-update',['id'=>$news->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 100%">Title</span>
                                    </div>
                                    <input type="text" name="title" value="{{ $news->title }}" class="form-control" required/>
                                </div>
                            </div>

                            <div class="col-md-3 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 100%">Author</span>
                                    </div>
                                    <input type="text" name="author" class="form-control" value="{{ $news->author }}" required/>
                                </div>
                            </div>

                            <input type="hidden" name="sl" class="form-control" value="{{ $news->sl }}" required/>

                            <div class="col-md-2 pr-md-0 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="width: 100%">Show Front</span>
                                    </div>
                                    <select name="front_page_status" class="form-control" required>
                                        <option value="2" {{ $news->front_page_status == 2? 'selected' : '' }}>No</option>
                                        <option value="1" {{ $news->front_page_status == 1? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1 mb-3">
                                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>

                            <div class="col-12 mb-3">
                                <label>Page Content</label>
                                <textarea class="form-control summernote" rows="10" name="page_content">{!! $news->content !!}</textarea>
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
                                <img width="100%" class="img-thumbnail" id="thumbnail_show" src="{{ asset($news->thumbnail) }}" alt="">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.latest-news.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.latest-news.style') @endsection




