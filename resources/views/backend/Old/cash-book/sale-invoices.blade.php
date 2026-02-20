@extends('backend.master')
@section('document-title') Sale Invoice @endsection
@section('page-title') Sale Invoice Management @endsection
@section('active-breadcrumb-item') <a href="#">Sale Invoice</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{ 'Sale Invoice' }} List</h4>
                    <div id="table" class="table-responsive p-1">
                        <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Client</th>
                                <th>Mobile</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Received</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td class="text-center">{{ $sl = $loop->iteration }}</td>
                                    <td>{{ dateFormat($payment->created_at,'d/m/Y') }}</td>
                                    <td>
                                        @if($payment->row_id!=null)
                                            <span class="badge badge-pill badge-soft-{{ $payment->sale->sale_type=='Cash'?'success':'warning' }} font-size-12">{{ $payment->sale->sale_type }}</span>
                                        @else
                                            <span class="badge badge-pill badge-soft-info font-size-12">{{ 'Received' }}</span>
                                        @endif
                                    </td>
                                    @if($payment->row_id!=null)
                                        <td>{{ $payment->sale->client_id==null? $payment->sale->client_name : $payment->client->name }}</td>
                                        <td>{{ $payment->sale->client_id==null? $payment->sale->client_mobile : $payment->client->mobile }}</td>
                                        <td class="text-right">{{ numberFormat($payment->sale->total) }}</td>
                                    @else
                                        <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
                                        <td>{{ $payment->client_id!=null? $payment->client->mobile : '' }}</td>
                                        <td class="text-right"></td>
                                    @endif

                                    <td class="text-right">{{ numberFormat($payment->amount) }}</td>
                                    <td class="text-right">
                                        <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                                        {{--                <button onclick="statusUpdateConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $client->status==1?'success':'warning' }}">--}}
                                        {{--                    <i class="fa fa-arrow-{{ $client->status==1?'up':'down' }}"></i>--}}
                                        {{--                </button>--}}
{{--                                        <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                                        <button onclick="itemDeleteConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
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
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection


