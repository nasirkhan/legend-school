@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Subject and Exam Wise Revision Worksheet</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-revision-worksheet') }}">{{ 'Revision Worksheet' }}</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
    <style>td ul{margin-bottom: 0}</style>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Subject and Exam Wise Revision Worksheet</h4>
                    <div id="table" class="table-responsive p-1">

                        @php($exams = exam($studentClass->year,$studentClass->class_id,'student'))

                        <table id="datatable" class="table table-bordered table-hover table-sm table-centered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="">Sl</th>
                                <th colspan="">Code</th>
                                <th colspan="">Subject Name</th>
                                @foreach($exams as $exam)
                                    <th>{{ $exam->name }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @php($sectionId = $studentClass->classInfo->section_id)

                            @php($sl=1)
                            @if($sectionId==1 or $sectionId==2)
                                @foreach($classSubjects as $classSubject)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td style="text-align: left">{{ $classSubject->sub_code }}</td>
                                        <td style="text-align: left">{{ $classSubject->subject->name }}</td>
                                        @foreach($exams as $exam)
                                            @php($syllabus = studentExamSyllabus($exam->id,$classSubject->subject_id))
                                            <td>
                                                @if(isset($syllabus))
                                                    @if($syllabus->attachment_url)
                                                        <a href="{{ asset($syllabus->attachment_url) }}" target="_blank">{{ 'Revision Worksheet' }}</a>
                                                    @else
                                                        <span class="badge badge-danger">{{ 'Not Uploaded' }}</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger">{{ 'Not Uploaded' }}</span>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @else
                                @foreach($classSubjects as $classSubject)
                                    @php($status = subjectCheck($student->id,$studentClass->class_id,$classSubject->subject_id))
                                    @if($status===true)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td style="text-align: left">{{ $classSubject->sub_code }}</td>
                                            <td style="text-align: left">{{ $classSubject->subject->name }}</td>
                                            @foreach($exams as $exam)
                                                @php($syllabus = studentExamSyllabus($exam->id,$classSubject->subject_id))
                                                <td>
                                                    @if(isset($syllabus))
                                                        @if($syllabus->attachment_url)
                                                            <a href="{{ asset($syllabus->attachment_url) }}" target="_blank">{{ 'Revision Worksheet' }}</a>
                                                        @else
                                                            <span class="badge badge-danger">{{ 'Not Uploaded' }}</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">{{ 'Not Uploaded' }}</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
