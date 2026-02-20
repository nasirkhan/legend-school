@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Attendance Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-attendance-report') }}">{{ 'Attendance Report' }}</a></li>
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
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-calendar-alt"></i> Date wise attendance report</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5 pr-lg-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">From</span>
                                    </div>
                                    <input type="date" name="from" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-lg-5 pr-lg-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input type="date" name="to" class="form-control"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-block btn-primary">Get Attendance Report</button>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-3">
                        <div class="col-12 table-responsive">
                            <table class="table table-hover table-sm">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $attendance)
                                    <tr class="{{ $attendance['status'] == 'Absent'? 'text-danger' : '' }}">
                                        <td>{{ $attendance['sl'] }}</td>
                                        <td>{{ $attendance['date'] }}</td>
                                        <td>{{ $attendance['day'] }}</td>
                                        <td>{{ $attendance['status'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
