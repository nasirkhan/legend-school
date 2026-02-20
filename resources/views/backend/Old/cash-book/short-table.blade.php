<table id="datatable" class="table table-bordered table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Description</th>
        <th class="text-right">Amount</th>
        <th class="text-right">Total Amount</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <th>Received Amount</th>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>Old Cash</td>
        <td class="text-right">{{ numberFormat($previousCash,2) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Bank Withdrawal</td>
        <td class="text-right">{{ numberFormat($bankWithdrawal) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Cash Received</td>
        @php($totalCashReceived = $receivedTransactions->sum('amount'))
        <td class="text-right">{{ numberFormat($totalCashReceived,2) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Cash Sale</td>
        @php($totalCashSale = $cashSales->sum('total')-$cashSales->sum('discount'))
        <td class="text-right">{{ numberFormat($totalCashSale,2) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Others Income</td>
        @php($totalOtherIncome = $otherIncomes->sum('amount'))
        <td class="text-right">{{ numberFormat($totalOtherIncome,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <th class="text-right">Total Cash</th>
        <td></td>
        @php($totalCash = ($totalCashReceived+$totalCashSale+$totalOtherIncome+$previousCash+$bankWithdrawal))
        <th class="text-right">{{ numberFormat($totalCash,2) }}</th>
    </tr>

    <tr>
        <th>Expense Amount</th>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Bank Deposit</td>
        <td class="text-right">{{ numberFormat($bankDeposit) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Supplier Payment</td>
        @php($totalCashPayment = $paidTransactions->sum('amount'))
        <td class="text-right">{{ numberFormat($totalCashPayment,2) }}</td>
        <td></td>
    </tr>
    <tr>
        <td>Other Expense</td>
        @php($totalOtherExpense = $otherExpenses->sum('amount'))
        <td class="text-right">{{ numberFormat($totalOtherExpense,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <td>Purchase Transport Cost</td>
        <td class="text-right">{{ numberFormat($purchaseTransportCost,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <td>Purchase Labour Cost</td>
        <td class="text-right">{{ numberFormat($purchaseLabourCost,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <td>Sale Transport Cost</td>
        <td class="text-right">{{ numberFormat($saleTransportCost,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <td>Sale Labour Cost</td>
        <td class="text-right">{{ numberFormat($saleLabourCost,2) }}</td>
        <td></td>
    </tr>

    <tr>
        <th class="text-right">Total Expense</th>
        <td></td>
        @php($totalExpense = ($totalCashPayment+$totalOtherExpense+$purchaseTransportCost+$purchaseLabourCost+$saleTransportCost+$saleLabourCost+$bankDeposit))
        <th class="text-right">{{ numberFormat($totalExpense,2) }}</th>
    </tr>
    <tr class="text-primary">
        <th class="text-right">Today Cash</th>
        <td></td>
        @php($todayCash = ($totalCash-$totalExpense))
        <th class="text-right">{{ numberFormat($todayCash,2) }}</th>
    </tr>
    </tbody>
    {{--                            <tfoot>--}}
    {{--                            <tr class="text-primary">--}}
    {{--                                <td></td>--}}
    {{--                                <th class="text-right">Today's Cash</th>--}}
    {{--                                <td></td>--}}
    {{--                                @php($todayCash = ($totalCash-$totalExpense))--}}
    {{--                                <th class="text-right">{{ numberFormat($todayCash) }}</th>--}}
    {{--                            </tr>--}}
    {{--                            </tfoot>--}}
</table>
