@extends('front.student.profile.master')

@section('page-title')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">{{ $student->name }}'s Payment Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('student-profile') }}">Student Area</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('student-detail-payment-report') }}">{{ 'Attendance Report' }}</a></li>
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
                    <h4 class="card-title text-primary mb-0"><i class="fa fa-dollar-sign"></i> Payment Report</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Description</th>
                            <th>Payment Date</th>
                            <th>Due Date</th>
                            <th class="text-right">Amount</th>
                            <th class="text-center">Invoice No.</th>
                            <th class="text-center">Invoice</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paymentInfos as $paymentInfo)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $paymentInfo->item->name }}
                                    @if($paymentInfo->month_id!=null)
                                        : {{ $paymentInfo->month->name }}
                                        - {{ $paymentInfo->month_id<7? $paymentInfo->year : $paymentInfo->year+1 }}
                                    @endif
                                </td>
                                <td>{{ $paymentInfo->payment_date != null ? dateFormat($paymentInfo->payment_date,'jS M Y') : '' }}</td>
                                <td>{{ $paymentInfo->due_date != null ? dateFormat($paymentInfo->due_date,'jS M Y') : '' }}</td>
                                <td class="text-right">{{ numberFormat($paymentInfo->receivable) }}</td>

                                <td class="text-center">{{ $paymentInfo->payment_date != null ? $paymentInfo->payment->invoice_number : '' }}</td>

                                <td class="text-center">
                                    @if($paymentInfo->payment_date != null)
                                        <a href="{{ route('student-new-invoice',['id'=>$paymentInfo->payment_id]) }}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    @else
                                        <span class="badge badge-soft-danger" style="font-size: small">DUE</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
