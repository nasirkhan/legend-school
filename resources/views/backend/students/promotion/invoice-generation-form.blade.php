@extends('backend.master')
@section('document-title') Invoice Generation Form @endsection
@section('page-title') Invoice Generation Form @endsection
@section('active-breadcrumb-item') <a href="{{ route('batches') }}">Invoice Generation Form</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary mb-0"><i class="fa fa-edit"></i> Generate Invoice For the Session {{ $data['next_year'].' - '.$data['next_year']+1 }}</h3>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
{{--this script override all--}}
@section('script') @include('backend.students.promotion.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.students.promotion.style') @endsection


