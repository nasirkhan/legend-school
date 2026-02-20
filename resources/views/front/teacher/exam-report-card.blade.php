@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Academic Transcript</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('academic-transcript') }}">{{ 'Academic Transcript' }}</a></li>
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
                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Academic Transcript</h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="">Sl</th>
                                <th colspan="">Exam Name</th>
                                <th>Academic Transcript</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $exam->name }}</td>
                                    <td>
                                        <a target="_blank"
                                           href="{{ route('student-report-card-by-own',['student_id'=>$student->id, 'exam_id'=>$exam->id, 'class_id'=>$studentClass->class_id, 'year'=>$studentClass->year]) }}"
                                        >Click Here
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
