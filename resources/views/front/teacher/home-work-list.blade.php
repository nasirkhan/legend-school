@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Home Work List</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-home-work') }}">{{ 'Home Work List' }}</a></li>
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
                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Subject Wise Home Work List</h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th colspan="" style="width: 3%">Sl</th>
                                <th colspan="" style="width: 5%">Code</th>
                                <th colspan="" style="width: 20%">Subject Name</th>
                                <th style="width: 45%">Home Works</th>
                                <th style="width: 12%" class="text-center">Last Date</th>
                                <th style="width: 10%" class="text-center">Status</th>
                                <th style="width: 5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($sectionId = $studentClass->classInfo->section_id)

                            @php($sl=1)

                            @if($sectionId==1 or $sectionId==2)
                                @foreach($classSubjects as $classSubject)
                                    @php($hws = homeWorks($studentClass->year,$studentClass->class_id,$classSubject->subject_id))
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td style="text-align: left">{{ $classSubject->sub_code }}</td>
                                        <td style="text-align: left">{{ $classSubject->subject->name }}</td>
                                        <td class="p-0" colspan="4">
                                            <table class="table table-sm mb-0 table-bordered table-hover">
                                                @php($hwLoop=1)
                                                @foreach($hws as $hw)
                                                    <tr>
                                                        <td style="width: 62.5%">{{ $hw->title }}</td>
                                                        <td style="width: 16.6%" class="text-center">{{ dateFormat($hw->submission_date,'d-M-Y') }}</td>
                                                        <td style="width: 13.3%;" class="text-center">
                                                            @php($shw = studentHomeWork($studentClass->student_id,$hw->id))
                                                            @if(isset($shw))
                                                                <span class="badge badge-success badge-sm"> Submitted</span>
                                                            @else
                                                                <span class="badge badge-warning badge-sm">Not Submitted</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('student-home-work-details',['id'=>$hw->id]) }}" class="btn btn-sm btn-secondary">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                @foreach($classSubjects as $classSubject)
                                    @php($status = subjectCheck($student->id,$studentClass->class_id,$classSubject->subject_id))
                                    @if($status===true)
                                        @php($hws = homeWorks($studentClass->year,$studentClass->class_id,$classSubject->subject_id))
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td style="text-align: left">{{ $classSubject->sub_code }}</td>
                                            <td style="text-align: left">{{ $classSubject->subject->name }}</td>
                                            <td class="p-0" colspan="4">
                                                <table class="table table-sm mb-0 table-bordered table-hover">
                                                    @php($hwLoop=1)
                                                    @foreach($hws as $hw)
                                                        <tr>
                                                            <td style="width: 62.5%">{{ $hw->title }}</td>
                                                            <td style="width: 16.6%" class="text-center">{{ dateFormat($hw->submission_date,'d-M-Y') }}</td>
                                                            <td style="width: 13.3%;" class="text-center">
                                                                @php($shw = studentHomeWork($studentClass->student_id,$hw->id))
                                                                @if(isset($shw))
                                                                    <span class="badge badge-success badge-sm"> Submitted</span>
                                                                @else
                                                                    <span class="badge badge-warning badge-sm">Not Submitted</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('student-home-work-details',['id'=>$hw->id]) }}" class="btn btn-sm btn-secondary">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
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
