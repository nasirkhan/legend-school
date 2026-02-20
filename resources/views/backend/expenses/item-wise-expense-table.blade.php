<table id="datatable" class="table table-bordered table-sm table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th class="text-center" style="width: 40px">Sl</th>
        <th>Item</th>
{{--        <th>Month</th>--}}
{{--        <th>Beneficiary</th>--}}
{{--        <th>Contact</th>--}}
{{--        <th>Date</th>--}}
{{--        <th>Media</th>--}}
{{--        <th>Note</th>--}}
        <th class="text-right">Amount(Tk)</th>
        <th class="text-center" style="width: 80px">Details</th>
    </tr>
    </thead>
    <tbody>
    @php($totalExpense = 0)
    @foreach($expenses as $expenseGroup)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ $sl }}</td>
            <td>{{ $expenseGroup[0]->item->name }}</td>
{{--            <td>{{ $expense->month->name }}-{{ $expense->year }}</td>--}}
{{--            <td>{{ $expense->receiver_name }}</td>--}}
{{--            <td>{{ $expense->contact_no }}</td>--}}
{{--            <td>{{ date_format($expense->created_at,'d/m/Y') }}</td>--}}
{{--            <td>{{ $method = paymentMethod($expense->payment_method) }} @if($method!='Cash') : {{ $expense->reference }} @endif </td>--}}
{{--            <td>{{ $expense->note }}</td>--}}
            <td class="text-right">{{ number_format($expenseAmount = $expenseGroup->sum('amount')) }}</td>
            <td class="text-center">
                <button
                    type="button"
                    class="btn btn-sm btn-secondary"
                    onclick="detailExpenses({
                    expenses: {{ $expenseGroup }},
                    item:  `{{ $expenseGroup[0]->item->name }}`,
                    year: `{{ $year }}`,
                    month: `{{ $month }}`
                    })"
                >
                    <i class="fa fa-eye"></i> View
                </button>
            </td>
        </tr>
        @php($totalExpense+=$expenseAmount)
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2" class="text-center">Total</th>
        <th class="text-right">{{ number_format($totalExpense) }}</th>
        <th></th>
    </tr>
    </tfoot>
</table>

{{--<table id="datatable_" class="table table-bordered table-sm dt-responsive mb-0">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th class="text-center" style="width: 40px">Sl</th>--}}
{{--                <th>Month</th>--}}
{{--                <th>Beneficiary</th>--}}
{{--                <th>Contact</th>--}}
{{--                <th>Date</th>--}}
{{--                <th>Media</th>--}}
{{--                <th>Note</th>--}}
{{--        <th class="text-right">Amount(Tk)</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    <tr>--}}
{{--        <td class="text-center"></td>--}}
{{--        <td></td>--}}
{{--        <td></td>--}}
{{--        <td></td>--}}
{{--        <td></td>--}}
{{--        <td></td>--}}
{{--        <td></td>--}}
{{--        <td class="text-right"></td>--}}
{{--    </tr>--}}
{{--    </tbody>--}}
{{--    <tfoot>--}}
{{--    <tr>--}}
{{--        <th colspan="7" class="text-center">Total</th>--}}
{{--        <th class="text-right"></th>--}}
{{--    </tr>--}}
{{--    </tfoot>--}}
{{--</table>--}}
