@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত ব্যালেন্স সামারি' }} @endsection
@section('body')
    <table id="" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr class="text-primary">
            <th colspan="2" class="text-center f-s-small">সম্পদ</th>
            <th colspan="2" class="text-center f-s-small">দায়</th>
        </tr>
        @php($totalAsset=0) @php($totalLiability=0)
        <tr>
            <td>নগদ</td><td class="text-right">{{ bengaliNumber($cash,2) }}</td>
            <td>আমদানিকারকের কাছে দেনা</td><td class="text-right">{{ bengaliNumber($supplierDue['Debit'],2) }}</td></tr>
        @php($totalAsset += $cash) @php($totalLiability += $supplierDue['Debit'])
        <tr>
            <td>ব্যাংক ব্যালেন্স</td><td class="text-right">{{ bengaliNumber($bankBalance,2) }}</td>
            <td>সিসি-লোন (প্রিঞ্চিপাল ব্যালেন্স)</td><td class="text-right">{{ bengaliNumber($loanPrincipal,2) }}</td>
            @php($totalAsset += $bankBalance) @php($totalLiability += $loanPrincipal)
        </tr>
        <tr>
            <td>কাস্টমারের কাছে পাওনা</td><td class="text-right">{{ bengaliNumber($customerDue['Credit'],2) }}</td>
            <td>অগ্রীম বিক্রয়</td><td class="text-right">{{ bengaliNumber($customerDue['Debit'],2) }}</td>
            @php($totalAsset += $customerDue['Credit']) @php($totalLiability += $customerDue['Debit'])
        </tr>
        <tr>
            <td>বর্তমান মজুদ</td><td class="text-right">{{ bengaliNumber($stock,2) }}</td>
            <td></td><td></td></tr>
        @php($totalAsset += $stock) @php($totalLiability += 0)
        <tr>
            <td>অগ্রীম ক্রয়</td><td class="text-right">{{ bengaliNumber($supplierDue['Credit'],2) }}</td>
            <td></td><td></td>
            @php($totalAsset += $supplierDue['Credit']) @php($totalLiability += 0)
        </tr>
        <tr>
            <th class="text-center f-s-small">মোট</th><td class="text-right f-s-small">{{ bengaliNumber($totalAsset,2) }}</td>
            <th class="text-center f-s-small">মোট</th><td class="text-right f-s-small">{{ bengaliNumber($totalLiability,2) }}</td>
        </tr>
    </table>
@endsection
