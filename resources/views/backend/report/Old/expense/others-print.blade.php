@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত দৈনিক খরচের রিপোর্ট' }} @endsection
@section('body')
    <table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>ক্রম</th>
            <th>তারিখ</th>
            <th>একাউন্ট</th>
            <th>খাত</th>
            <th>মন্তব্য</th>
            <th class="text-right">পরিমাণ</th>
        </tr>
        @foreach($transactions as $transaction)
            @php($sl = $loop->iteration)
            <tr>
                <td>{{ bengaliNumber($sl) }}</td>
                <td>{{ bengaliString(dateFormat($transaction->created_at,'d/m/Y')) }}</td>
                <td>{{ $transaction->item->account_name }}</td>
                <td>{{ $transaction->item->sector->name }}</td>
                <td>{{ $transaction->remark }}</td>
                <td class="text-right">{{ bengaliNumber($transaction->amount,dp($transaction->amount)) }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="5" class="text-center">মোট</th>
            <th class="text-right">{{ bengaliNumber($transactions->sum('amount'),dp($transactions->sum('amount'))) }}</th>
        </tr>
    </table>
@endsection

