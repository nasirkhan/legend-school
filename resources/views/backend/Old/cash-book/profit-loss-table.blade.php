<table id="" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr class="text-primary">
        <th>Description</th>
        <th class="text-right">Amount</th>
        <th class="text-right">Amount</th>
        <th class="text-right">Amount</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th>Total Cash Sale</th>
        @php($totalCashSale = $cashSales->sum('product_cost')+$cashSales->sum('vat')-$cashSales->sum('discount'))
        <td class="text-right">{{ numberFormat($totalCashSale,2) }}</td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <th>Total Credit Sale</th>
        @php($totalCreditSale = $creditSales->sum('product_cost')+$creditSales->sum('vat')-$creditSales->sum('discount'))
            <td class="text-right">{{ numberFormat($totalCreditSale,2) }}</td>
            <td></td>
            <td></td>
    </tr>

    <tr>
        <th>Total Stock</th>
        <td class="text-right">{{ numberFormat($totalStockPrice,2) }}</td>
        <td></td>
        <td></td>
    </tr>
    @php($totalPurchase = $purchase->sum('total')-$purchase->sum('transport_cost')-$purchase->sum('labour_cost')-$purchase->sum('discount'))
    <tr>
        <th class="text-right" colspan="3">{{ numberFormat($totalCashSale+$totalCreditSale+$totalStockPrice,2) }}</th>
    </tr>

    <tr>
        <th>Total Purchase</th>
        <td class="text-right">{{ numberFormat($totalPurchase,2) }}</td>
        <td></td>
        <td></td>
    </tr>

    @php($income = $totalCashSale+$totalCreditSale+$totalStockPrice-$totalPurchase)

        <tr>
            <th class="text-right" colspan="3">{{ numberFormat($income,2) }}</th>
            <th></th>
        </tr>

        <tr>
            <th class="" colspan="2">Others Income</th>
            @php($totalOtherIncome = $otherIncomes->sum('amount'))
            <th class="text-right">{{ numberFormat($totalOtherIncome,2) }}</th>
            <th></th>
        </tr>

        @php($grossIncome = $totalOtherIncome+$income)

        <tr>
            <th class="text-right" colspan="2">Gross Profit</th>
            <th></th>
            <th class="text-right">{{ numberFormat($grossIncome,2) }}</th>
        </tr>



        <tr>
            <th>Expense</th>
            @php($expense = $otherExpenses->sum('amount'))
                <td class="text-right">{{ numberFormat($expense,2) }}</td>
                <td></td>
                <td></td>
        </tr>

        <tr>
            <th>Labour Cost</th>
            @php($totalLabourCost = $saleLabourCost + $purchaseLabourCost)
            <td class="text-right">{{ numberFormat($totalLabourCost,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <th>Transport Cost</th>
            @php($totalTransportCost = $saleTransportCost + $purchaseTransportCost)
                <td class="text-right">{{ numberFormat($totalTransportCost,2) }}</td>
                <td></td>
                <td></td>
        </tr>
        <tr>
            <th>Total Vat</th>
            @php($totalVat = $cashSales->sum('vat') + $creditSales->sum('vat'))
            <td class="text-right">{{ numberFormat($totalVat,2) }}</td>
            <td></td>
            <td></td>
        </tr>

        @php($totalSaleCost = $totalLabourCost+$totalTransportCost+$totalVat)


            @php($netExpense = $totalSaleCost + $expense)

            <tr>
                <th class="text-right" colspan="2">Net Expense</th>
                <th></th>
                <th class="text-right">{{ numberFormat($netExpense,2) }}</th>
            </tr>
            @php($netIncome = $grossIncome - $netExpense)

            <tr>
                <th class="text-right" colspan="2">Net Profit</th>
                <th></th>
                <th class="text-right">{{ numberFormat($netIncome,2) }}</th>
            </tr>
    </tbody>
    <tfoot>

    </tfoot>
</table>
