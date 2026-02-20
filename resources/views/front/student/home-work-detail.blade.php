@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18"> Home Work : {{ $hw->subject->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-home-work') }}">{{ 'Home Work List' }}</a></li>
                        <li class="breadcrumb-item active"><a href="#">{{ 'Home Work Detail' }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @php($studentHW = studentHomeWork($studentClass->student_id,$hw->id))
                <div class="card-body">
                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Home Work Detail
{{--                        @if(!isset($studentHW))--}}
                        <button class="btn btn-sm btn-primary" onclick="hwUploadForm('{{ $hw->subject->name }}','{{ $hw->title }}')">
                            Upload/Change My Home Work
                        </button>
{{--                        @endif--}}
                    </h4>

                    <table class="table table-sm">
                        <tr>
                            <td><span class="font-weight-bold">Class : </span>{{ $studentClass->classInfo->code }}</td>
                            <td class="text-center"><span class="font-weight-bold">Subject : </span>{{ $hw->subject->name }}</td>
                            <td><span class="font-weight-bold">Topic : </span>{{ $hw->title }}</td>
                            @if(!isset($studentHW))
                                <td class="text-right" style="width: 250px"><span class="font-weight-bold">Last Date of Submission : </span>{{ $hw->submission_date }}</td>
                            @else
                                <td class="text-right" style="width: 250px"><span class="font-weight-bold">Submission Date: </span>{{ dateFormat($studentHW->created_at,'d-M-Y') }}</td>
                            @endif

                        </tr>
                        @if($hw->hw_detail!='')
                            <tr><td colspan="4">{!! $hw->hw_detail !!}</td></tr>
                        @endif

                        @if(isset($hw->attachment_url) and !isset($studentHW))
                            <tr>
                                <td colspan="4">
                                    <embed src="{{ asset($hw->attachment_url) }}" width="100%" height="900" type="application/pdf" allowfullscreen >
                                </td>
                            </tr>
                        @endif

                        @if(isset($studentHW))
                            <tr>
                                <td colspan="4">
                                    <embed src="{{ asset($studentHW->hw_url) }}" width="100%" height="900" type="application/pdf" allowfullscreen >
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    @include('front.student.modal.hw-upload-form')
@endsection

@section('script')
    @include('front.student.profile.script')
@endsection
