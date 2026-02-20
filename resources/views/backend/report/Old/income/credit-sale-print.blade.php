@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত বাকী বিক্রয় রিপোর্ট' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>ক্রম</th>
            <th>তারিখ</th>
            <th>ধরণ</th>
            <th>কাস্টমার</th>
            <th>মোবাইল</th>
            <th class="text-right">মোট</th>
            <th class="text-right">আদায়</th>
            <th class="text-right">অপশন</th>
        </tr>
        @foreach($payments as $payment)
            @php($sl = $loop->iteration)
            <tr>
                <td class="text-center">{{ bengaliNumber($sl) }}</td>
                <td>{{ bengaliString(dateFormat($payment->created_at,'d/m/Y')) }}</td>
                <td>
                    @if($payment->row_id!=null)
                        {{ $payment->sale->sale_type == 'Credit' ? 'বিক্রয়' : '' }}
                    @else
                        {{ 'আদায়' }}
                    @endif
                </td>
                @if($payment->row_id!=null)
                    <td>{{ $payment->sale->client_id==null? $payment->sale->client_name : $payment->client->name }}</td>
                    <td>{{ $payment->sale->client_id==null? bengaliString($payment->sale->client_mobile) : bengaliString($payment->client->mobile) }}</td>
                    <td class="text-right">{{ bengaliNumber($payment->sale->total,dp($payment->sale->total)) }}</td>
                @else
                    <td>{{ $payment->client_id!=null? $payment->client->name : '' }}</td>
                    <td>{{ $payment->client_id!=null? bengaliString($payment->client->mobile) : '' }}</td>
                    <td class="text-right"></td>
                @endif

                <td class="text-right">{{ bengaliNumber($payment->amount,dp($payment->amount)) }}</td>
                <td class="text-right">
                    <a target="_blank" href="{{ route('invoice',['paymentId'=>$payment->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
        <tr>
            <th colspan="6" class="text-center">মোট</th>
            <th class="text-right">{{ bengaliNumber($payments->sum('amount'),dp($payments->sum('amount'))) }}</th>
            <th class="text-right"></th>
        </tr>
    </table>
@endsection

