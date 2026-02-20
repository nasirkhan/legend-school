@extends('front.teacher.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $teacher->name }}'s Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher-profile') }}">Teacher's Portal</a></li>
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
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Profile Update Form</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher-profile-update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div id="" class="table-responsive p-1">
                            <table id="" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr>
                                    <th>Name</th>
                                    <td><input type="text" class="form-control" name="name" value="{{ $teacher->name }}" id="name" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td><input type="text" class="form-control" name="mobile" value="{{ $teacher->mobile }}" id="mobile" placeholder="Mobile Number"></td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td><input type="text" class="form-control" name="email" value="{{ $teacher->email }}" id="email" placeholder="Email Address"></td>
                                </tr>
                                <tr>
                                    <th>Passport Number</th>
                                    <td><input type="text" class="form-control" name="passport" value="{{ $teacher->passport }}" id="passport" placeholder="Passport Number"></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><input type="text" class="form-control" name="address" value="{{ $teacher->address }}" id="passport" placeholder="Address"></td>
                                </tr>
                                <tr>
                                    <th>Profile Photo</th>
                                    <td><input type="file" class="form-control" name="photo" id="photo"></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> Save Changes</button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
