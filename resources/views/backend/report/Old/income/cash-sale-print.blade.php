@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত নগদ বিক্রয় রিপোর্ট' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>ক্রম</th>
            <th>তারিখ</th>
            <th>কাস্টমার</th>
            <th>মোবাইল</th>
            <th class="text-right">মোট</th>
        </tr>
        @foreach($sales as $sale)
            @php($sl = $loop->iteration)
            <tr>
                <td>{{ bengaliNumber($sl) }}</td>
                <td>{{ bengaliString(dateFormat($sale->created_at,'d/m/Y')) }}</td>
                <td>{{ $sale->client_name }}</td>
                <td>{{ bengaliString($sale->client_mobile) }}</td>
                <td class="text-right">{{ bengaliNumber($sale->total,dp($sale->total)) }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4" class="text-center">মোট</th>
            <th class="text-right">{{ bengaliNumber($sales->sum('total'),dp($sales->sum('total'))) }}</th>
        </tr>
    </table>
@endsection
