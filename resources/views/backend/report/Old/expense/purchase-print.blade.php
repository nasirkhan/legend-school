@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত ক্রয় রিপোর্ট' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>ক্রম</th>
            <th>তারিখ</th>
            <th>ধরণ</th>
            <th>আমদানিকারক</th>
            <th>মোবাইল</th>
            <th class="text-right">মোট</th>
            <th class="text-right">পরিশোধ</th>
        </tr>
        @foreach($payments as $payment)
            @php($sl = $loop->iteration)
            <tr>
                <td class="">{{ bengaliNumber($sl) }}</td>
                <td>{{ bengaliString(dateFormat($payment->created_at,'d/m/Y')) }}</td>
                <td>
                    @if($payment->row_id!=null)
                        {{ 'পণ্য ক্রয়' }}
                    @else
                        {{ 'পরিশোধ' }}
                    @endif
                </td>

                <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
                <td>{{ $payment->client_id!=null? bengaliString($payment->client->mobile) : '' }}</td>
                <td class="text-right">{{ $payment->row_id != null? bengaliNumber($payment->purchase->total,dp($payment->purchase->total)) : '' }}</td>

                <td class="text-right">{{ bengaliNumber($payment->amount,dp($payment->amount)) }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="6" class="text-center">মোট</th>
            <th class="text-right">{{ bengaliNumber($payments->sum('amount'),dp($payments->sum('amount'))) }}</th>
        </tr>
    </table>
@endsection
