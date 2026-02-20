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
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Password Update Form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('student-password-update') }}" method="post">
                        @csrf
                        <div id="" class="table-responsive p-1">
                            <table id="" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr>
                                    <th>Old Password</th>
                                    <td><input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}" id="old_password" placeholder="Old Password"></td>
                                </tr>
                                <tr>
                                    <th>New Password</th>
                                    <td><input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}" id="new_password" placeholder="New Password"></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Update Password</button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
