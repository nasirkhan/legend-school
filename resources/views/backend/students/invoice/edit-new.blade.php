@extends('backend.master')
@section('document-title') Student Invoice Edit @endsection
@section('page-title') Student Invoice Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('student-invoice-edit-new',['id'=>$invoice->id]) }}"> Student Invoice Edit</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('student-invoice-update') }}" method="post" id="">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-primary mb-0"><i class="fa fa-info-circle"></i> Check All Options carefully and click on <kbd><i class="fa fa-save"></i> Save Changes</kbd> Button</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td><span class="font-weight-bold">Name:</span> {{ $invoice->student->name }}</td>
                                        <td><span class="font-weight-bold">Student ID:</span> {{ $invoice->student->roll }}</td>
                                        <td><span class="font-weight-bold">Class: </span> {{ $invoice->class->code }}</td>
                                        <td><span class="font-weight-bold">Mother Mobile:</span> {{ $invoice->student->mother_mobile }}</td>
                                    </tr>
                                </table>

                                <h5 class="font-weight-bold text-danger"><i class="fa fa-minus-square"></i> Select Items To Remove From Current Invoice</h5>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-trash-alt"></i></th>
                                        <th>Item</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right">Receivable</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoice->studentPaymentItems as $detail)

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script')
    @include('backend.students.invoice.script')
@endsection

