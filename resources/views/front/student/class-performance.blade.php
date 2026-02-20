@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Class Performance</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-class-performance') }}">{{ 'Class Performance' }}</a></li>
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
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title text-primary"><i class="fa fa-edit"></i> Subject List</h4>--}}
{{--                    <div id="table" class="table-responsive p-1">--}}
{{--                        <table id="datatable" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th colspan="">Sl</th>--}}
{{--                                <th colspan="">Code</th>--}}
{{--                                <th colspan="">Subject Name</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @php($sl=1)--}}

{{--                            @php($sectionId = $studentClass->classInfo->section_id)--}}

{{--                            @if($sectionId==1 or $sectionId==2)--}}
{{--                                @foreach($classSubjects as $classSubject)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $sl++ }}</td>--}}
{{--                                        <td style="text-align: left">{{ $classSubject->sub_code }}</td>--}}
{{--                                        <td style="text-align: left">{{ $classSubject->subject->name }}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                @foreach($classSubjects as $classSubject)--}}
{{--                                    @php($status = subjectCheck($student->id,$studentClass->class_id,$classSubject->subject_id))--}}
{{--                                    @if($status===true)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $sl++ }}</td>--}}
{{--                                            <td style="text-align: left">{{ $classSubject->sub_code }}</td>--}}
{{--                                            <td style="text-align: left">{{ $classSubject->subject->name }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card-body">
                    <h4 class="card-title text-primary"><i class="fa fa-calendar-check"></i> Latest Class Performance </h4>
                    <table class="table table-sm table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Performance</th>
                            <th class="text-center" style="width: 75px">History</th>
                        </tr>
                        </thead>
                        <tbody>

{{--                        @foreach($classPerformances as $classPerformance)--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $classPerformance['subject'] }}</td>--}}
{{--                                <td>{{ $classPerformance['topic'] }}</td>--}}
{{--                                <td>{{ $classPerformance['performance'] }}</td>--}}
{{--                                <td class="text-center"><a href="{{ route('class-performance-history') }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> View</a></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}


                        @foreach($classSubjects as $classSubject)

                            @php($performance = lastClassPerformance($student->id,$classSubject->class_id,$classSubject->subject_id))

                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $classSubject->subject->name }}</td>
                                <td>{{ isset($performance)? dateFormat($performance->date,'jS F Y') : '' }}</td>
                                <td>{{ isset($performance)? $performance->tag->name : '' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('class-performance-history',[
                                    'class_id'=>$classSubject->class_id, 'subject_id'=>$classSubject->subject_id
                                        ]) }}" class="btn btn-sm btn-secondary">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
