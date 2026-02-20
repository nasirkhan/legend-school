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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10 col-md-9 pr-md-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Invoice Number</span>
                                </div>
                                <select class="select2 form-control" name="invoice_id" id="invSelect" onchange="getInvoice(this)" data-placeholder="Select Invoice">
                                    {{--                        <select class="select2 form-control select2-multiple" multiple="multiple" onchange="getInvoice(this)" data-placeholder="Select Invoices...">--}}
                                    <option value="">--Select--</option>
                                    @foreach($invoices as $invoice)
                                        <option value="{{ $invoice->id }}" {{ (isset($data['invoice_id']) and ($data['invoice_id'] == $invoice->id)) ? 'selected' : '' }}>
                                            {{ $invoice->invoice_no }} - {{ $invoice->student->name }} -
                                            Amount: {{ numberFormat($invoice->receivable_amount) }} Tk.
                                            @if($invoice->deadline != null)
                                                - ( Deadline: {{ dateFormat($invoice->deadline,'jS M Y') }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <button type="button" class="btn btn-primary btn-block" id="addInvoice" onclick="addToPayment()">
                                <i class="fa fa-check-circle"></i> Check Invoice
                            </button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('collect-payment') }}" id="collectPayment" method="post">
                    @csrf
                    <div class="card-body" id="paymentForm"></div>
                </form>

            </div>
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


