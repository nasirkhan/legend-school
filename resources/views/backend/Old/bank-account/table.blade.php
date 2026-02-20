<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Bank Name</th>
        <th>Account Name</th>
        <th>Account No.</th>
        <th>Branch</th>
        <th>Address</th>
        <th>Mobile</th>
        <th class="text-right">Balance</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach(activeBankAccounts() as $account)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ numberFormat($sl) }}</td>
            <td>{{ $account->bank->code }}</td>
            <td>{{ $account->ac_name }}</td>
            <td>{{ $account->ac_no }}</td>
            <td>{{ $account->branch }}</td>
            <td>{{ $account->address }}</td>
            <td>{{ bengaliString($account->contact_no) }}</td>
            @php($bankBalance = bankBalance($account->id))
            <td class="text-right">{{ numberFormat($bankBalance,dp($bankBalance)) }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $account->status==1?'success':'danger' }} font-size-12">{{ $account->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('bank-account-details',['id'=>$account->id]) }}" title="Details" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i></a>
{{--                <button onclick="statusUpdateConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $account->status==1?'success':'warning' }}">--}}
{{--                    <i class="fa fa-arrow-{{ $account->status==1?'up':'down' }}"></i>--}}
{{--                </button>--}}
                <button onclick="edit('{{ $account }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
