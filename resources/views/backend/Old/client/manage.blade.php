@extends('backend.master')
@section('document-title') {{ siteInfo('language')=='bengali'? $type->bn_name : $type->name }} @endsection
@section('page-title') {{ siteInfo('language')=='bengali'? $type->bn_name : $type->name }}  @endsection
@section('active-breadcrumb-item') <a href="{{ route('client',['type'=>$type->name]) }}">{{ siteInfo('language')=='bengali'? $type->bn_name : $type->name }}</a> @endsection
{{--This file must be included if Bootstrap Datatable is needed--}}
@include('backend.includes.data-table')
{{--Main Content of the page goes here--}}
@section('content')
    @include('backend.client.table-container')
@endsection

@section('modal')
    @include('backend.client.edit-form')
@endsection

{{--this script override all--}}
@section('script') @include('backend.client.script') @endsection
{{--this style override all--}}
@section('style') @include('backend.client.style') @endsection


