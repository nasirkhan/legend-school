@extends('backend.invoice.master')
@section('title') {{ bengaliString(dateFormat($data->from,'d/m/Y')).' থেকে'.bengaliString(dateFormat($data->to,'d/m/Y')).' পর্যন্ত লাভ-ক্ষতির রিপোর্ট' }} @endsection
@section('body')
    <table id="" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <tr class="text-primary">
            <th>বিবরণ</th>
            <th class="text-right">পরিমাণ</th>
            <th class="text-right">পরিমাণ</th>
            <th class="text-right">পরিমাণ</th>
        </tr>
        <tr>
            <th>মোট নগদ বিক্রয়</th>
            @php($totalCashSale = $cashSales->sum('total'))
            <td class="text-right">{{ bengaliNumber($totalCashSale,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th>মোট ক্রেডিট বিক্রয়</th>
            @php($totalCreditSale = $creditSales->sum('total'))
            <td class="text-right">{{ bengaliNumber($totalCreditSale,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th>মোট মজুদ</th>
            <td class="text-right">{{ bengaliNumber($totalStockPrice,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        @php($totalPurchase = $purchase->sum('total'))
        <tr>
            <th class="text-right" colspan="3">{{ bengaliNumber($totalCashSale+$totalCreditSale+$totalStockPrice,2) }}</th>
        </tr>

        <tr>
            <th>মোট ক্রয় মূল্য</th>
            <td class="text-right">{{ bengaliNumber($totalPurchase,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        @php($income = $totalCashSale+$totalCreditSale+$totalStockPrice-$totalPurchase)

        <tr>
            <th class="text-right" colspan="3">{{ bengaliNumber($income,2) }}</th>
            <th></th>
        </tr>

        <tr>
            <th class="" colspan="2">বিবিধ আয়</th>
            @php($totalOtherIncome = $otherIncomes->sum('amount'))
            <th class="text-right">{{ bengaliNumber($totalOtherIncome,2) }}</th>
            <th></th>
        </tr>

        @php($grossIncome = $totalOtherIncome+$income)

        <tr>
            <th class="text-right" colspan="2">মোট লাভ</th>
            <th></th>
            <th class="text-right">{{ bengaliNumber($grossIncome,2) }}</th>
        </tr>



        <tr>
            <th>খরচ</th>
            @php($expense = $otherExpenses->sum('amount'))
            <td class="text-right">{{ bengaliNumber($expense,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th>লেবার খরচ</th>
            @php($totalLabourCost = $cashSales->sum('labour_cost') + $creditSales->sum('labour_cost'))
            <td class="text-right">{{ bengaliNumber($totalLabourCost,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th>পরিবহণ খরচ</th>
            @php($totalTransportCost = $cashSales->sum('transport_cost') + $creditSales->sum('transport_cost'))
            <td class="text-right">{{ bengaliNumber($totalTransportCost,2) }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th>মোট ভ্যাট</th>
            @php($totalVat = $cashSales->sum('vat') + $creditSales->sum('vat'))
            <td class="text-right">{{ bengaliNumber($totalVat,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        @php($totalSaleCost = $totalLabourCost+$totalTransportCost+$totalVat)


        @php($netExpense = $totalSaleCost + $expense)

        <tr>
            <th class="text-right" colspan="2">নিট খরচ</th>
            <th></th>
            <th class="text-right">{{ bengaliNumber($netExpense,2) }}</th>
        </tr>
        @php($netIncome = $grossIncome - $netExpense)

        <tr>
            <th class="text-right" colspan="2">নিট লাভ</th>
            <th></th>
            <th class="text-right">{{ bengaliNumber($netIncome,2) }}</th>
        </tr>

    </table>
@endsection
