@php($query = $data['query'])
@php($student = $data['student'])
@php($monthlyFee = $data['monthlyFee'])
@php($labSubjects = $data['labSubjects'])
@php($classItems = $data['classItems'])
@php($months = $data['months'])

@php($query['student_id'] = $student->id)

@extends('backend.master')
@section('document-title') Invoice Creation Form @endsection
@section('page-title') Invoice Creation Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('invoice-creation-for-student',[
    'id'=>$query->id, 'class_id'=>$query->class_id, 'year'=>$query->year
]) }}">Invoice Creation Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('create-student-invoice') }}" method="post" id="">
                @csrf

                <input type="hidden" name="year" value="{{ $monthlyFee->year }}">
                <input type="hidden" name="class_id" value="{{ $monthlyFee->class_id }}">
                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Invoice for
                            <kbd>{{ $student->name }}, Class: {{ $monthlyFee->class->code }}, Session: {{ $query->year }} - {{ $query->year+1 }}</kbd>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th class="text-primary" colspan="6"><i class="fa fa-arrow-alt-circle-right"></i> Fee Other Than Tuition Fee</th>
                                    </tr>

                                    <tr>
                                        <th>
                                            <div class="custom-control custom-checkbox custom-checkbox-success d-none">
                                                <input type="checkbox" class="custom-control-input" id="allClassItem">
                                                <label class="custom-control-label" for="allClassItem">All Items</label>
                                            </div>
                                            Select Items
                                        </th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right">Receivable</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Note</th>
                                        @if(user()->role->code=='developer')
                                            <th class="text-danger text-center">
                                                <i class="fa fa-trash-alt"></i>
                                            </th>
                                        @endif
                                    </tr>
                                    @php($classItemCount=0)
                                    @foreach($classItems as $classItem)
                                        @if($classItem->item->billing_cycle!=3)
                                            @php($classItemCount++)
                                            @php($nonMonthlyStatus = null)
                                            @php($query['item_id'] = $classItem->item_id)

                                            @if($classItem->item->billing_cycle==1)
                                                @php($nonMonthlyPaymentItem = OneTimeFeeCheck($query))
                                            @elseif($classItem->item->billing_cycle==2)
                                                @php($nonMonthlyPaymentItem = YearlyFeeCheck($query))
                                            @endif

                                            @if($nonMonthlyPaymentItem)
                                                @php($nonMonthlyStatus = $nonMonthlyPaymentItem->status)
                                            @endif

                                            <tr>
                                                <td>
                                                    @if($nonMonthlyStatus === 2 or $nonMonthlyStatus === null)
                                                        <div class="custom-control custom-checkbox custom-checkbox-secondary">
                                                            <input type="checkbox" name="class_items[]" {{ $nonMonthlyPaymentItem? 'checked':'' }}
                                                            value="{{ $classItem->id }}" class="custom-control-input class-item" id="classItem-{{ $classItem->id }}"
                                                            >
                                                            <label class="custom-control-label" for="classItem-{{ $classItem->id }}">{{ $classItem->item->name }}</label>
                                                        </div>
                                                    @else
                                                        {{ $classItem->item->name }}
                                                    @endif
                                                </td>
                                                <td class="text-right" id="classItemAmount-{{ $classItem->id }}">{{ numberFormat($classItem->amount) }}</td>
                                                <td>

                                                    <input type="number" id="classItemDiscount-{{ $classItem->id }}"
                                                           name="class_item_discounts[{{ $classItem->id }}]" class="form-control form-control-sm text-right"
                                                           value="{{ $nonMonthlyPaymentItem? $nonMonthlyPaymentItem->discount : 0 }}" min="0" max="{{ $classItem->amount }}" onkeyup="classItemDiscount({{ $classItem->id }})"
                                                           onclick="this.select()"
                                                    >
                                                </td>

                                                <td class="text-right" id="classItemReceivable-{{ $classItem->id }}">
                                                    @if($nonMonthlyPaymentItem)
                                                        {{ numberFormat($classItem->amount-$nonMonthlyPaymentItem->discount) }}
                                                    @else
                                                        {{ numberFormat($classItem->amount) }}
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @if($nonMonthlyPaymentItem and $nonMonthlyPaymentItem->status == 2)
                                                        <span style="font-size: smaller" class="badge badge-soft-danger">Unpaid</span>
                                                    @elseif($nonMonthlyPaymentItem and $nonMonthlyPaymentItem->status == 1)
                                                        <span style="font-size: smaller" class="badge badge-soft-success">Paid</span>
                                                    @else
                                                        <span style="font-size: smaller" class="badge badge-soft-warning">Not Found</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <input type="text" name="class_item_notes[{{ $classItem->id }}]"
                                                           class="form-control form-control-sm" placeholder="Note for {{ $classItem->item->name }}"
                                                           value="{{ $nonMonthlyPaymentItem? $nonMonthlyPaymentItem->note : '' }}"
                                                    >
                                                </td>


                                                @if(user()->role->code=='developer')
                                                    <td class="text-center">
                                                        @if($nonMonthlyStatus === 2)
                                                            <input type="checkbox" name="non_monthly_class_items_delete[{{ $classItem->id }}]" value="{{ $nonMonthlyPaymentItem? $nonMonthlyPaymentItem->id : '' }}" class="form-control-sm">
                                                        @else
                                                            --
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>

                            <div class="col-lg-12">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="3" class="text-primary">
                                            <i class="fa fa-info-circle"></i>
                                            Monthly Tuition Fee Information
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Tuition Fee</span>
                                                </div>
                                                <input type="number" name="monthly_fee" class="form-control form-control-sm text-right" value="{{ $monthlyFee->monthly_fee }}" min="0" max="{{ $monthlyFee->monthly_fee }}" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Discount</span>
                                                </div>
                                                <input type="number" name="discount" class="form-control form-control-sm text-right" value="{{ $monthlyFee->discount }}" min="0" max="{{ $monthlyFee->discount }}" step="0.001" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Receivable</span>
                                                </div>
                                                <input type="number" name="payable" class="form-control form-control-sm text-right" value="{{ $monthlyFee->payable }}" min="0" max="{{ $monthlyFee->payable }}" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">BDT</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            @if($labSubjects['lab_fee']>0)
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-sm">
                                        <tr>
                                            <th colspan="3" class="text-primary">
                                                <i class="fa fa-info-circle"></i>
                                                Monthly Lab Fee Information
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                Subjects:
                                                @foreach($labSubjects['subjects'] as $subject)
                                                    <span class="badge badge-soft-success" style="font-size: small">{{ $subject->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-right"><b>Per Subject Fee:</b> {{ numberFormat($labSubjects['per_month_per_subject']) }}/-</td>
                                            <td class="text-right"><b>Total Lab Fee:</b> {{ numberFormat($labSubjects['lab_fee']) }}/-</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            <div class="col-lg-12">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th class="text-primary" colspan="{{ count($months) }}">
                                            <i class="fa fa-arrow-alt-circle-right"></i> Tuition Fee
                                        </th>
                                    </tr>
                                    <tr>
                                        @php($checkedMonthCount=0)
                                        @foreach($months as $month)
                                            @php($monthlyStatus = null)
                                            @php($query['month_id'] = $month->id)
                                            @php($monthlyFeeChecked = MonthlyFeeCheck($query))

                                            @if($monthlyFeeChecked)
                                                @php($checkedMonthCount++)
                                                @php($monthlyStatus = $monthlyFeeChecked->status)
                                            @endif

                                            <th>
                                                @if(($monthlyFeeChecked and $monthlyFeeChecked->status == 2) or !$monthlyFeeChecked)
                                                    <div class="custom-control custom-checkbox custom-checkbox-secondary">
                                                        <input type="checkbox" name="months[]" value="{{ $month->id }}"
                                                               class="custom-control-input month"
                                                               id="{{ $month->code }}" {{ $monthlyFeeChecked? 'checked':'' }}
                                                        >
                                                        <label class="custom-control-label" for="{{ $month->code }}">{{ $month->name }}</label><br>
                                                    </div>
                                                @else
                                                    {{ $month->name }}<br>
                                                @endif

                                                @if($monthlyFeeChecked and $monthlyFeeChecked->status == 2)
                                                    <span style="font-size: smaller" class="badge badge-soft-danger">Unpaid</span>
                                                @elseif($monthlyFeeChecked and $monthlyFeeChecked->status == 1)
                                                    <span style="font-size: smaller" class="badge badge-soft-success">Paid</span>
                                                @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th colspan="{{ count($months) }}">
                                            <div class="custom-control custom-checkbox custom-checkbox-success d-inline">
                                                <input type="checkbox" class="custom-control-input" id="allMonth" {{ $checkedMonthCount == count($months)? 'checked' : '' }}>
                                                <label class="custom-control-label text-success" for="allMonth">Select All Months</label>
                                            </div>
                                        </th>
                                    </tr>
                                </table>
                            </div>

                            @if(user()->role->code=='developer')
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-sm">
                                        <tr>
                                            <th class="text-danger" colspan="{{ count($months) }}">
                                                <i class="fa fa-trash-alt"></i> Tuition Fee Delete
                                            </th>
                                        </tr>
                                        <tr>
                                            @foreach($months as $month)
                                                @php($query['month_id'] = $month->id)
                                                @php($monthlyFeeChecked = MonthlyFeeCheck($query))

                                                <th>
                                                    @if($monthlyFeeChecked and $monthlyFeeChecked->status == 2)
                                                        <div class="custom-control custom-checkbox custom-checkbox-secondary">
                                                            <input type="checkbox" name="months_delete[{{ $month->id }}]" value="{{ $monthlyFeeChecked->id }}" id="delete_month_{{ $month->id }}" class="custom-control-input month">
                                                            <label class="custom-control-label" for="delete_month_{{ $month->id }}">{{ $month->name }}</label><br>
                                                        </div>
                                                    @endif
                                                </th>
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <button type="submit" onclick="getStudentsForCreatingInvoice()" class="btn btn-primary" id="submitButton">
                                    <i class="fa fa-save"></i>
                                    Save Changes
                                </button>

                                <button type="button" onclick="window.close()" class="btn btn-danger">
                                    <i class="fa fa-times-circle"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                        <div id="table" class="table-responsive p-0 mt-2">

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
{{--    <script src="{{ asset('assets/js/pages/custom-mini-editor.js') }}"></script>--}}
    <script>
        $(document).ready(function () {
            $('#allMonth').on('change', function () {
                if($(this).is(':checked')){
                    $('.month').prop('checked', true);
                }else{
                    $('.month').prop('checked', false);
                }
            });

            $('.month').on('change', function () {
                if($('.month:checked').length<12){
                    $('#allMonth').prop('checked', false);
                }else{
                    $('#allMonth').prop('checked', true);
                }
            });

            $('#allClassItem').on('change', function () {
                if($(this).is(':checked')){
                    $('.class-item').prop('checked', true);
                }else{
                    $('.class-item').prop('checked', false);
                }
            });

            $('.class-item').on('change', function () {
                if($('.class-item:checked').length< {{ $classItemCount }}){
                    $('#allClassItem').prop('checked', false);
                }else{
                    $('#allClassItem').prop('checked', true);
                }
            });
        });

        document.addEventListener("keydown", function (event) {
            // if (event.altKey && event.key.toLowerCase() === "s") {
            if (event.ctrlKey && event.key.toLowerCase() === "s") {
                event.preventDefault(); // optional: prevent browser default action
                // document.getElementById("cash").select();
                document.getElementById("submitButton").focus();
            }
        });

        function classItemDiscount(id){
            let classItemAmount = Number(removeCommas($('#classItemAmount-'+id).text()));
            let classItemDiscount = Number($('#classItemDiscount-'+id).val());
            let classItemReceivable = $('#classItemReceivable-'+id);
            classItemReceivable.text(numberWithCommas(classItemAmount-classItemDiscount));
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function removeCommas(str) {
            return parseFloat(str.replace(/,/g, ""));
        }
    </script>
@endsection
{{--this style override all--}}
{{--@section('style') @include('backend.students.invoice.style') @endsection--}}


