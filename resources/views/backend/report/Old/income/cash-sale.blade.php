@extends('backend.master')
@section('document-title') Cash Sale Report @endsection
@section('page-title') Cash Sale Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('cash-sale-report') }}">Cash Sale Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form" action="{{ route('date-to-date-cash-sale-report') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-5 pr-lg-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">From</span>
                                            </div>
                                            <input type="date" name="from" id="startDate" class="form-control" value="{{ date('Y-m-d') }}"/>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 pr-lg-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">To</span>
                                            </div>
                                            <input type="date" name="to" id="endDate" class="form-control" value="{{ date('Y-m-d') }}"/>
                                        </div>
                                    </div>

                                    <input type="hidden" name="type" value="view">

                                    <div class="col-lg-2 pr-lg-1">
                                        <button type="submit" class="btn btn-block btn-secondary"><i class="fa fa-eye"></i> View</button>
                                    </div>
                                </div>
                            </form>
                        </div>

{{--                        <div class="col-lg-2">--}}
{{--                            <form target="_blank" action="{{ route('date-to-date-cash-sale-report') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <input class="d-none" type="date" id="printStartDate" name="from" value="{{ date('Y-m-d') }}"/>--}}
{{--                                <input class="d-none" type="date" id="printEndDate" name="to" value="{{ date('Y-m-d') }}"/>--}}
{{--                                <input type="hidden" name="type" value="print"/>--}}
{{--                                <button type="submit" class="btn btn-block btn-primary"><i class="bx bx-printer"></i> Print</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
{{--                    <h4 class="card-title text-primary">Cash Sale Invoices</h4>--}}
                    <div id="table" class="table-responsive p-1">
                        @include('backend.report.income.cash-sale-table')
{{--                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Sl</th>--}}
{{--                                <th>Date</th>--}}
{{--                                <th>Customer</th>--}}
{{--                                <th>Mobile</th>--}}
{{--                                <th class="text-right">Total</th>--}}
{{--                                <th class="text-right">Option</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($sales as $sale)--}}
{{--                                @php($sl = $loop->iteration)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ numberFormat($sl) }}</td>--}}
{{--                                    <td>{{ dateFormat($sale->created_at,'d/m/Y') }}</td>--}}
{{--                                    <td>{{ $sale->client_name }}</td>--}}
{{--                                    <td>{{ $sale->client_mobile }}</td>--}}
{{--                                    <td class="text-right">{{ numberFormat($sale->total,dp($sale->total)) }}</td>--}}
{{--                                    <td class="text-right">--}}
{{--                                        <a href="{{ route('invoice',['paymentId'=>$sale->payment_id]) }}" target="_blank" class="btn btn-sm btn-secondary" title="Invoice"><i class="fa fa-eye"></i></a>--}}
{{--                                        --}}{{--                                        <button onclick="edit('{{ $sale }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                                        <button onclick="itemDeleteConfirmation('{{ $sale->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th colspan="4" class="text-center">Total</th>--}}
{{--                                <th class="text-right">{{ numberFormat($sales->sum('total'),dp($sales->sum('total'))) }}</th>--}}
{{--                                <th class="text-right"></th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
{{--this script override all--}}
@section('script') @include('backend.report.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.report.style') @endsection


