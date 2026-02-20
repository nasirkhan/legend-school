@extends('backend.master')
@section('document-title') Invoice List @endsection
@section('page-title') {{ $client->name }} : {{ $client->type=='Supplier'? 'Product Purchase / Payment Voucher List':'Credit Sale / Received Invoice List' }} @endsection
@section('active-breadcrumb-item') <a href="{{ route('client',['type'=>$client->type]) }}">{{ $client->type =='Customer'? 'Customer List' : 'Supplier List' }} </a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered font-weight-bold" style="background-color: #dddddd; font-size: 15px;">
                        <tr>
                            <td>Name: {{ $client->name }}</td>
                            <td>Mobile: {{ $client->mobile }}</td>
                            <td>Address: {{ $client->address }}</td>
                            <td>Area: </td>
                        </tr>
                    </table>

                    <div id="table" class="table-responsive p-1">
                        @include('backend.client.client-details-table')
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


