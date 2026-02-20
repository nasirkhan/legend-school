@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Class Performance History</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student-class-performance') }}">Class Performance</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('class-performance-history') }}">{{ 'History' }}</a></li>
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
                <div class="card-body">
                    <h4 class="card-title text-primary"><i class="fa fa-calendar-check"></i>
                        Class History : {{ $subject->name }}
                        <a class="btn btn-sm btn-secondary" href="{{ route('student-class-performance') }}">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </h4>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th>Date</th>
                            <th>Class Activity</th>
                            <th>Home Work</th>
                            <th>Performance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="">{{ dateFormat($item->date,'jS M Y') }}</td>
                                <td>
                                    @php($ca = classWorkByDate($studentClass->class_id,$subject->id,$item->date))
                                    @if(isset($ca))
                                        <span class="font-weight-bold">Chapter:</span> {{ $ca->chapter }} <br>
                                        {!! $ca->cw_detail !!}
                                        @if($ca->attachment_url != null)
                                            <a target="_blank" href="{{ asset($ca->attachment_url) }}">Attachment</a>
                                        @endif
                                    @endif
                                </td>

                                <td>
                                    @php($hw = homeWorkByDate($studentClass->class_id,$subject->id,$item->date))
                                    @if(isset($hw))
                                        <span class="font-weight-bold">Title:</span> {{ $hw->title }} <br>
                                        {!! $hw->hw_detail !!}
                                        @if($hw->attachment_url != null)
                                            <a target="_blank" href="{{ asset($hw->attachment_url) }}">Attachment</a>
                                        @endif
                                    @endif
                                </td>

                                <td>{{ $item->tag->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
