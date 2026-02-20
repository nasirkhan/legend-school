@extends('backend.master')
@section('document-title') User Management @endsection
@section('page-title') User Management @endsection
@section('active-breadcrumb-item') <a href="{{ route('users') }}">User Management</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    {{--    @include('backend.teachers.form-container')--}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-0">
                    <h3 class="card-title mb-0 text-primary"><i class="fa fa-list-alt"></i> User List
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New User</a>
                    </h3>
                </div>
                <div class="card-body">
                    {{--                <h4 class="card-title text-primary">Batch Table</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th class="text-center" style="width: 150px">Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                @php($sl = $loop->iteration)
                                <tr>
                                    <td>{{ $sl }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-capitalize">{{ $user->role->name }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-lock-open"></i> Password Reset</a>
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
{{--this script override all--}}
@section('script') @include('backend.users.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.users.style') @endsection


