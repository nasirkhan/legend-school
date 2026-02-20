@extends('backend.master')
@section('document-title') Cash Sale @endsection
@section('page-title') Cash Sale Report @endsection
@section('active-breadcrumb-item') <a href="{{ route('cash-sale-report') }}">Cash Sale Report</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary"> List</h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sl = $loop->iteration }}</td>
                                    <td>{{ dateFormat($sale->created_at,'d/m/Y') }}</td>
                                    <td>{{ $sale->client_name }}</td>
                                    <td>{{ $sale->client_mobile }}</td>
                                    <td class="text-right">{{ $sale->total }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('invoice',['paymentId'=>$sale->payment_id]) }}" target="_blank" class="btn btn-sm btn-secondary" title="Invoice"><i class="fa fa-eye"></i></a>
                                        {{--                                        <button onclick="edit('{{ $sale }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                                        <button onclick="itemDeleteConfirmation('{{ $sale->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
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
@section('script') @include('backend.report.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.report.style') @endsection


