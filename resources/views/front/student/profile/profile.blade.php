@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active">{{ 'Dashboard' }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Basic Information</h4>
                </div>
                <div class="card-body">

                    <div id="" class="table-responsive p-1">
                        <table id="" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th colspan="3">--}}
{{--                                    <a target="_blank" href="{{ route('student-payment-detail',['id'=>$student->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Payments</a>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Attendances</a>--}}
{{--                                    <a target="_blank" href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Report Card</a>--}}
{{--                                </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
                            <tbody>
                            <tr><td style="width: 80px">Name</td><td style="width: 10px">:</td><td>{{ $student->name }}</td></tr>
                            <tr><td style="width: 80px">Student ID</td><td style="width: 10px">:</td><td>{{ $student->roll }}</td></tr>

                            <tr><td style="width: 80px">Class</td><td style="width: 10px">:</td><td>{{ $studentClass->classInfo->name }}</td></tr>
                            <tr><td style="width: 80px">Academic Year</td><td style="width: 10px">:</td><td>{{ $studentClass->year }} - {{ $studentClass->year+1 }}</td></tr>
                            <tr><td style="width: 80px">Session</td><td style="width: 10px">:</td><td>{{ 'July to June' }}</td></tr>

                            <tr><td style="width: 80px">Date of Birth</td><td style="width: 10px">:</td><td>{{ dateFormat($student->date_of_birth,'d-M-Y') }}</td></tr>
                            <tr><td style="width: 80px">Joining Date</td><td style="width: 10px">:</td><td>{{ dateFormat($student->join_date,'d-M-Y') }}</td></tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Contact Information</h4>
                </div>
                <div class="card-body">

                    <div id="" class="table-responsive p-1">
                        <table id="" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <tr><td style="width: 80px">Self Contact</td><td style="width: 10px">:</td><td>{{ $student->mobile }}</td></tr>
                            <tr><td style="width: 80px">Self Email</td><td style="width: 10px">:</td><td>{{ $student->email }}</td></tr>
                            <tr><td style="width: 80px">Father Name</td><td style="width: 10px">:</td><td>{{ $student->father_name }}</td></tr>
                            <tr><td style="width: 80px">Father Mobile</td><td style="width: 10px">:</td><td>{{ $student->father_mobile }}</td></tr>
                            <tr><td style="width: 80px">Mother Name</td><td style="width: 10px">:</td><td>{{ $student->mother_name }}</td></tr>
                            <tr><td style="width: 80px">Mother Mobile</td><td style="width: 10px">:</td><td>{{ $student->mother_mobile }}</td></tr>
                            <tr><td style="width: 80px">Address</td><td style="width: 10px">:</td><td>{{ $student->address }}</td></tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
