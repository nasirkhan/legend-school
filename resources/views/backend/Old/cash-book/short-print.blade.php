@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত ক্যাশবুক' }} @endsection
@section('body')
    <table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr>
            <th>বিবরণ</th>
            <th class="text-right">পরিমাণ</th>
            <th class="text-right">মোট পরিমাণ</th>
        </tr>
        <tr>
            <th>আদায়ের পরিমাণ</th>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>পূর্বের ক্যাশ</td>
            <td class="text-right">{{ bengaliNumber($previousCash) }}</td>
            <td></td>
        </tr>
        <tr>
            <td>নগদ আদায়</td>
            @php($totalCashReceived = $receivedTransactions->sum('amount'))
            <td class="text-right">{{ bengaliNumber($totalCashReceived) }}</td>
            <td></td>
        </tr>
        <tr>
            <td>নগদ বিক্রয়</td>
            @php($totalCashSale = $cashSales->sum('total')-$cashSales->sum('discount'))
            <td class="text-right">{{ bengaliNumber($totalCashSale) }}</td>
            <td></td>
        </tr>
        <tr>
            <td>অন্যান্য আয়</td>
            @php($totalOtherIncome = $otherIncomes->sum('amount'))
            <td class="text-right">{{ bengaliNumber($totalOtherIncome) }}</td>
            <td></td>
        </tr>

        <tr>
            <th class="text-right">মোট নগদ ক্যাশ</th>
            <td></td>
            @php($totalCash = ($totalCashReceived+$totalCashSale+$totalOtherIncome+$previousCash))
            <th class="text-right">{{ bengaliNumber($totalCash) }}</th>
        </tr>

        <tr>
            <th>খরচের পরিমাণ</th>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>আমদানিকারককে পরিশোধ</td>
            @php($totalCashPayment = $paidTransactions->sum('amount'))
            <td class="text-right">{{ bengaliNumber($totalCashPayment) }}</td>
            <td></td>
        </tr>
        <tr>
            <td>অন্যান্য খরচ</td>
            @php($totalOtherExpense = $otherExpenses->sum('amount'))
            <td class="text-right">{{ bengaliNumber($totalOtherExpense) }}</td>
            <td></td>
        </tr>

        <tr>
            <th class="text-right">মোট খরচ</th>
            <td></td>
            @php($totalExpense = ($totalCashPayment+$totalOtherExpense))
            <th class="text-right">{{ bengaliNumber($totalExpense) }}</th>
        </tr>
        <tr class="text-primary">
            <th class="text-right">আজকের নগদ ক্যাশ</th>
            <td></td>
            @php($todayCash = ($totalCash-$totalExpense))
            <th class="text-right">{{ bengaliNumber($todayCash) }}</th>
        </tr>
    </table>
@endsection
