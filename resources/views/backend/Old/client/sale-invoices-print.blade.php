@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত বিক্রয় রিপোর্ট' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th class="text-center">ক্রম</th>
            <th>তারিখ</th>
            <th>ধরণ</th>
            <th>কাস্টমার</th>
            <th class="text-center">মোবাইল</th>
            <th class="text-right">মোট</th>
            <th class="text-right">আদায়</th>
        </tr>
        @foreach($payments as $payment)
            @php($sl = $loop->iteration)
            <tr>
                <td class="text-center">{{ bengaliNumber($sl) }}</td>
                <td>{{ bengaliString(dateFormat($payment->created_at,'d/m/Y')) }}</td>
                <td>
                    @if($payment->row_id!=null)
                        {{ $payment->sale->sale_type =='Credit'? 'ক্রেডিট বিক্রয়' : 'নগদ বিক্রয়' }}
                    @else
                        {{ 'আদায়' }}
                    @endif
                </td>
                @if($payment->row_id!=null)
                    <td>{{ $payment->sale->client_id==null? $payment->sale->client_name : $payment->client->name }}</td>
                    <td class="text-center">{{ $payment->sale->client_id==null? bengaliString($payment->sale->client_mobile) : bengaliString($payment->client->mobile) }}</td>
                    <td class="text-right">{{ bengaliNumber($payment->sale->total,dp($payment->sale->total)) }}</td>
                @else
                    <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
                    <td class="text-center">{{ $payment->client_id!=null? bengaliString($payment->client->mobile) : '' }}</td>
                    <td class="text-right"></td>
                @endif

                <td class="text-right">{{ bengaliNumber($payment->amount,dp($payment->amount)) }}</td>
            </tr>
        @endforeach
    </table>
@endsection

