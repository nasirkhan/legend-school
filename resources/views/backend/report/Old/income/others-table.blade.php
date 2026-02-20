<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Account</th>
        <th>Sector</th>
        <th>Remark</th>
        <th class="text-right">Amount</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ numberFormat($sl) }}</td>
            <td>{{ dateFormat($transaction->created_at,'d/m/Y') }}</td>
            <td>{{ $transaction->item->account_name }}</td>
            <td>{{ $transaction->item->sector->name }}</td>
            <td>{{ $transaction->remark }}</td>
            <td class="text-right">{{ numberFormat($transaction->amount,dp($transaction->amount)) }}</td>
            <td class="text-right">
                <button onclick="edit('{{ $transaction }}','{{ $transaction->item }}','{{ $transaction->item->sector->accounts }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="transactionDeleteConfirmation('{{ $transaction->id }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5" class="text-center">Total</th>
        <th class="text-right">{{ numberFormat($transactions->sum('amount'),dp($transactions->sum('amount'))) }}</th>
        <th class="text-right"></th>
    </tr>
    </tfoot>
</table>
