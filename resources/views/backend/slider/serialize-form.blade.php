@extends('backend.master')
@section('document-title') Slider Serialize @endsection
@section('page-title') Slider Serialize @endsection
@section('active-breadcrumb-item') <a href="{{ route('slides') }}">Slider Serialize</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('update-slide-position') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <button class="btn  btn-primary" type="submit"><i class="fa fa-save"></i> Update Position</button>
                        <a target="_blank" href="{{ route('/') }}" class="btn  btn-secondary" type="submit"> Visit Site</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table  class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Page Link</th>
                                    <th>Photo</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 120px">Position</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($slides as $slide)
                                    @php($sl = $loop->iteration)
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $slide->title }}</td>
                                        <td>{{ $slide->description }}</td>
                                        <td>{{ $slide->slide_link }}</td>
                                        <td class="text-center">
                                            <a class="image-popup-no-margins" href="{{ $slide->url != null? asset($slide->url) : '' }}">
                                                <img class="img-fluid" alt="Image" src="{{ $slide->url != null? asset($slide->url) : '' }}" width="25">
                                            </a>
                                            {{--                <a class="image-popup-no-margins" href="{{ imagePath($participant->participant->avatar) }}">--}}
                                            {{--                    <img class="img-fluid" alt="Image" src="{{ imagePath($participant->participant->avatar) }}" width="25">--}}
                                            {{--                </a>--}}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-pill badge-soft-{{ $slide->status==1?'success':'danger' }} font-size-12">{{ $slide->status==1?'Active':'Close' }}</span>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" class="form-control text-center" name="position[{{ $slide->id }}]" value="{{ $slide->position }}">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
{{--this script override all--}}
@section('script')
    @include('backend.slider.script')
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.slider.style') @endsection


