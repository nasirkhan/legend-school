<table id="" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="text-primary">
        <th colspan="2" class="text-center f-s-small">Assets</th>
        <th colspan="2" class="text-center f-s-small">Liabilities</th>
    </tr>
    </thead>
    @php($totalAsset=0) @php($totalLiability=0)
    <tbody>
    <tr>
        <td>Cash</td><td class="text-right">{{ numberFormat($cash,2) }}</td>
        <td>Supplier's Payable</td><td class="text-right">{{ numberFormat($supplierDue['Debit'],2) }}</td></tr>
    @php($totalAsset += $cash) @php($totalLiability += $supplierDue['Debit'])
    <tr>
        <td>Bank Balanced</td><td class="text-right">{{ numberFormat($bankBalance,2) }}</td>
        <td></td><td class="text-right"></td>
{{--        <td>সিসি-লোন (প্রিঞ্চিপাল ব্যালেন্স)</td><td class="text-right">{{ bengaliNumber($loanPrincipal,2) }}</td>--}}
        @php($totalAsset += $bankBalance) @php($totalLiability += $loanPrincipal)
    </tr>
    <tr>
        <td>Customer's Receivable</td><td class="text-right">{{ numberFormat($customerDue['Credit'],2) }}</td>
        <td>Advance Sale</td><td class="text-right">{{ numberFormat($customerDue['Debit'],2) }}</td>
        @php($totalAsset += $customerDue['Credit']) @php($totalLiability += $customerDue['Debit'])
    </tr>
    <tr>
        <td>Present Stock</td><td class="text-right">{{ numberFormat($stock,2) }}</td>
        <td></td><td></td></tr>
    @php($totalAsset += $stock) @php($totalLiability += 0)
    <tr>
        <td>Advance Purchase</td><td class="text-right">{{ numberFormat($supplierDue['Credit'],2) }}</td>
        <td></td><td></td>
        @php($totalAsset += $supplierDue['Credit']) @php($totalLiability += 0)
    </tr>
    <tr>
        <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{ numberFormat($totalAsset,2) }}</td>
        <th class="text-center f-s-small">Total</th><td class="text-right f-s-small">{{ numberFormat($totalLiability,2) }}</td>
    </tr>

    {{--                            <tr>--}}
    {{--                                <th>Total Cash Sale</th>--}}
    {{--                                @php($totalCashSale = $cashSales->sum('total'))--}}
    {{--                                <td class="text-right">{{ numberFormat($totalCashSale) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th>Total Credit Sale</th>--}}
    {{--                                @php($totalCreditSale = $creditSales->sum('total'))--}}
    {{--                                <td class="text-right">{{ numberFormat($totalCreditSale) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th>Total Stock</th>--}}
    {{--                                <td class="text-right">{{ numberFormat($totalStockPrice) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}
    {{--                            @php($totalPurchase = $purchase->sum('total'))--}}
    {{--                            <tr>--}}
    {{--                                <th class="text-right" colspan="3">{{ numberFormat($totalCashSale+$totalCreditSale+$totalStockPrice) }}</th>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th>Total Purchase Cost</th>--}}
    {{--                                <td class="text-right">{{ numberFormat($totalPurchase) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            @php($income = $totalCashSale+$totalCreditSale+$totalStockPrice-$totalPurchase)--}}

    {{--                            <tr>--}}
    {{--                                <th class="text-right" colspan="3">{{ numberFormat($income) }}</th>--}}
    {{--                                <th></th>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th class="" colspan="2">Other Income</th>--}}
    {{--                                @php($totalOtherIncome = $otherIncomes->sum('amount'))--}}
    {{--                                <th class="text-right">{{ numberFormat($totalOtherIncome) }}</th>--}}
    {{--                                <th></th>--}}
    {{--                            </tr>--}}

    {{--                            @php($grossIncome = $totalOtherIncome+$income)--}}

    {{--                            <tr>--}}
    {{--                                <th class="text-right" colspan="2">Gross Profit</th>--}}
    {{--                                <th></th>--}}
    {{--                                <th class="text-right">{{ numberFormat($grossIncome) }}</th>--}}
    {{--                            </tr>--}}



    {{--                            <tr>--}}
    {{--                                <th>Expenses</th>--}}
    {{--                                @php($expense = $otherExpenses->sum('amount'))--}}
    {{--                                <td class="text-right">{{ numberFormat($expense) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th>Total Labour Cost</th>--}}
    {{--                                @php($totalLabourCost = $cashSales->sum('labour_cost') + $creditSales->sum('labour_cost'))--}}
    {{--                                <td class="text-right">{{ numberFormat($totalLabourCost) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            <tr>--}}
    {{--                                <th>Total Transport Cost</th>--}}
    {{--                                @php($totalTransportCost = $cashSales->sum('transport_cost') + $creditSales->sum('transport_cost'))--}}
    {{--                                <td class="text-right">{{ numberFormat($totalTransportCost) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}
    {{--                            <tr>--}}
    {{--                                <th>Total Vat</th>--}}
    {{--                                @php($totalVat = $cashSales->sum('vat') + $creditSales->sum('vat'))--}}
    {{--                                <td class="text-right">{{ numberFormat($totalVat) }}</td>--}}
    {{--                                <td></td>--}}
    {{--                                <td></td>--}}
    {{--                            </tr>--}}

    {{--                            @php($totalSaleCost = $totalLabourCost+$totalTransportCost+$totalVat)--}}


    {{--                            @php($netExpense = $totalSaleCost + $expense)--}}

    {{--                            <tr>--}}
    {{--                                <th class="text-right" colspan="2">Net Expense</th>--}}
    {{--                                <th></th>--}}
    {{--                                <th class="text-right">{{ numberFormat($netExpense) }}</th>--}}
    {{--                            </tr>--}}
    {{--                            @php($netIncome = $grossIncome - $netExpense)--}}

    {{--                            <tr>--}}
    {{--                                <th class="text-right" colspan="2">Net Profit</th>--}}
    {{--                                <th></th>--}}
    {{--                                <th class="text-right">{{ numberFormat($netIncome) }}</th>--}}
    {{--                            </tr>--}}

    </tbody>
    <tfoot>

    </tfoot>
</table>
