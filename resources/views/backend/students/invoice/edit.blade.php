@extends('backend.master')
@section('document-title') Student Invoice Edit @endsection
@section('page-title') Student Invoice Edit @endsection
@section('active-breadcrumb-item') <a href="{{ route('student-invoice-edit',['id'=>$invoice->id]) }}"> Student Invoice Edit</a> @endsection
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
                                        <td><span class="font-weight-bold">Class: </span> {{ $invoice->activeDetails[0]->classItem->class->code }}</td>
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
                                    @foreach($invoice->activeDetails as $detail)
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="invoiceDetail{{ $detail->id }}" name="invoice_detail_id[]" value="{{ $detail->id }}" class=""/>
                                            </td>
                                            <td><label for="invoiceDetail{{ $detail->id }}">{{ $detail->classItem->item->name }}</label></td>
                                            <td class="text-right">
                                                <div class="input-group">
                                                    @if($detail->classItem->item->billing_cycle==3)
                                                        <select class="form-control form-control-sm">
                                                            <option value="">--Select Month--</option>
                                                            @foreach(months() as $month)
                                                                <option value="{{ $month->id }}" {{ $month->id == $detail->reference_id ? 'selected':'' }}>{{ $month->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    <input type="number" name="detail_actual_amount[{{ $detail->id }}]" value="{{ $detail->actual_amount }}" required min="0" class="form-control form-control-sm text-right" readonly/>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <input type="number" name="detail_discount_amount[{{ $detail->id }}]" value="{{ $detail->discount_amount }}" required min="0" class="form-control form-control-sm text-right"/>
                                            </td>
                                            <td class="text-right">
                                                <input type="number" name="detail_receivable_amount[{{ $detail->id }}]" value="{{ $detail->receivable_amount }}" required min="0" class="form-control form-control-sm text-right"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <h5 class="font-weight-bold text-primary"><i class="fa fa-plus-square"></i> Select Items To Add Into Invoice </h5>

                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-plus-square"></i></th>
                                        <th>Item</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right">Receivable</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classItems as $classItem)
                                        @php($item = $classItem->item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="newInvoiceDetail{{ $item->id }}" name="new_item_ids[{{ $classItem->id }}]" value="{{ $item->id }}" class=""/>
                                            </td>

                                            <td><label for="newInvoiceDetail{{ $item->id }}">{{ $item->name }}</label></td>

                                            <td class="text-right">
                                                <div class="input-group">
                                                    @php($discount = 0)
                                                    @if($item->billing_cycle==3)
                                                        @if($item->name == 'Tuition Fee')
                                                            @php($tuitionFee = monthlyFee($invoice->year,$invoice->class_id,$invoice->student_id))
                                                            @if(isset($tuitionFee)) @php($discount=$tuitionFee['discount']) @endif
                                                        @endif
                                                        <select class="form-control form-control-sm" name="new_month_ids[{{ $item->id }}][]">
                                                            <option value="">--Select Month--</option>
                                                            @foreach(months() as $month)
                                                                <option value="{{ $month->id }}" {{ date('F') == $month->name ? 'selected' : '' }}>{{ $month->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                        <input type="number" value="{{ $classItem->amount }}" name="new_actual_amount[{{ $item->id }}]" min="0" class="form-control form-control-sm text-right" readonly/>
                                                </div>
                                            </td>

                                            <td class="text-right">
                                                <input
                                                    type="number" value="{{ $discount }}"
                                                    name="new_discount[{{ $item->id }}]"
                                                    min="0" readonly
                                                    class="form-control form-control-sm text-right"
                                                />
                                            </td>

                                            <td class="text-right">
                                                <input
                                                    type="number" value="{{ $classItem->amount-$discount }}"
                                                    name="new_receivable_amount[{{ $item->id }}]" readonly min="0"
                                                    class="form-control form-control-sm text-right"
                                                />
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if(!isset($invoice->previousDue) or (isset($invoice->previousDue) and $invoice->previousDue->status!==1))
                                <div class="col-12">
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold text-danger">Previous Due</span>
                                        </div>
                                        <input type="number" class="form-control text-danger" value="{{ isset($invoice->previousDue)? $invoice->previousDue->amount : 0 }}" onclick="this.select()" name="previous_due" placeholder="Amount" min="0">
                                        <input type="text" class="form-control text-danger" name="due_description" value="{{ isset($invoice->previousDue)? $invoice->previousDue->description : '' }}" placeholder="Description" >
                                    </div>

                                    <input type="hidden" name="previous_due_id" value="{{ isset($invoice->previousDue)? $invoice->previousDue->id : '' }}"/>
                                </div>
                            @endif

                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold">Remark</span>
                                    </div>
                                    <input type="text" class="form-control" name="remark" placeholder="Remark" value="{{ isset($invoice->activeNote)? $invoice->activeNote->note : '' }}">
                                </div>

                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"/>
                            </div>

                            <div class="col-lg-8 pr-lg-0">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold">Last Pay Date</span>
                                    </div>
                                    <input type="date" name="deadline" class="form-control form-control-sm" value="{{ $invoice->deadline }}">
                                </div>
                            </div>
                            <div class="col-lg-2 pr-lg-0">
                                <button type="submit" class="btn btn-primary btn-block btn-sm"><i class="fa fa-save"></i> Save Changes</button>
                            </div>

                            <div class="col-lg-2">
                                <a href="{{ route('invoice-check-form') }}" class="btn btn-sm btn-secondary btn-block">
                                    <i class="fa fa-arrow-alt-circle-left"></i> Back
                                </a>
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

