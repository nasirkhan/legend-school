@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            @if(Auth::user())
                                <a href="{{ route('teacher-detail',['id'=>$teacher->id]) }}">Teacher's Portal</a>
                            @else

                            @endif

                        </li>
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Basic Information</h4>
                </div>
                <div class="card-body table-responsive pt-0">

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
                        <tr><td>Name</td><td>:</td><td>{{ $teacher->name }}</td></tr>
                        <tr><td>Mobile</td><td>:</td><td>{{ $teacher->mobile }}</td></tr>
                        <tr><td>Email</td><td>:</td><td>{{ $teacher->email }}</td></tr>
                        <tr><td>Passport No</td><td>:</td><td>{{ $teacher->passport }}</td></tr>
                        <tr><td>Address</td><td>:</td><td>{{ $teacher->address }}</td></tr>
                        <tr><td>Photo</td><td>:</td><td><img style="max-height: 200px; width: auto" src="{{ asset($teacher->photo) }}" alt=""></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
