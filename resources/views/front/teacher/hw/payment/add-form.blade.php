@extends('backend.master')
@section('document-title') Student Payment Form @endsection
@section('page-title') Student Payment Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('payment-form') }}">Student Payment Form</a> @endsection

{{--Select2 plugin include start--}}
@section('extra-stylesheet')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('extra-script')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    {{--    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>--}}
    <script>$('.select2').select2();</script>
@endsection
{{--Select2 plugin include end--}}

{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form id="form" action="{{ route('payment-save') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h6 class="font-weight-bold mb-0">Payment Collection</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="input-group" style="width: 100%">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Student</span>
                                    </div>
                                    <select class="form-control select2" name="student_id" onchange="paymentFormFillUp(this)">
                                        <option value="">--Select--</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}({{ $student->mobile }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">School</span>
                                    </div>
                                    <select class="form-control" name="school_id">
                                        <option value="">--Select--</option>
                                        @foreach(activeSchools() as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Class</span>
                                    </div>
                                    <select class="form-control" name="class_id">
                                        <option value="">--Select--</option>
                                        @foreach(activeClasses() as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

{{--                            <div class="col-lg-2 mb-3">--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                        <span class="input-group-text">Batch</span>--}}
{{--                                    </div>--}}
{{--                                    <select class="form-control" name="batch_id">--}}
{{--                                        <option value="">--Select--</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Monthly</span>
                                    </div>
                                    <input type="number" class="form-control" name="monthly_fee" value="0" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Taka</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Discount</span>
                                    </div>
                                    <input type="number" class="form-control" name="monthly_discount" value="0" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Taka</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Received</span>
                                    </div>
                                    <input type="number" class="form-control" name="received" value="0" readonly/>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Taka</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Receipt No.</span>
                                    </div>
                                    <input type="text" class="form-control" name="receipt_no"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered ">
                                    <tr id="months">
                                        <th class="" style="width: 90px; background-color: #eff2f7">Months</th>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div>
@endsection

{{--this script override all--}}
@section('script') @include('backend.students.payment.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.payment.style') @endsection
