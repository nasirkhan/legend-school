@extends('backend.master')
@section('document-title') Payment Collection Form @endsection
@section('page-title') Payment Collection Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('payment-collection-form') }}">Payment Collection Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('collect-payment-new') }}" id="collectPayment" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 pr-md-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Year</span>
                                    </div>

                                    <select class="form-control" name="year" required>
                                        <option value="">--Select--</option>
                                        @foreach(activeYears() as $year)
                                            <option value="{{ $year->year }}" {{ Session::get('year')==$year->year? 'selected' : '' }}>{{ $year->year }} - {{ $year->year+1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-6 pr-md-0">
                                <div class="input-group">
                                    <select class="select2 form-control" name="student_id" id="invSelect" data-placeholder="Select Student">
                                        <option value="">--Select--</option>
                                        @foreach($data as $student)
                                            @if(isset($student->class))
                                                <option value="{{ $student->id }}">ID: {{ $student->roll }}, Name: {{ $student->name }}, Class: {{ $student->class->classInfo->code }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <button type="button" class="btn btn-primary btn-block" id="addInvoice" onclick="checkPayment()">
                                    <i class="fa fa-check-circle"></i> Check Payment
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="paymentForm"></div>
                </div>
            </form>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.students.invoice.script')
    {{--    <script src="{{ asset('assets/js/pages/custom-mini-editor.js') }}"></script>--}}

    <script>
        document.addEventListener("keydown", function (event) {
            if (event.key === "ArrowDown") {
                event.preventDefault(); // optional: prevent browser default action
                $('#invSelect').select2('open');
            }
        });
    </script>
@endsection
{{--this style override all--}}
@section('style') @include('backend.students.invoice.style2') @endsection


