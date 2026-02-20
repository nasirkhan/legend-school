<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th rowspan="2">Sl.</th>
        <th rowspan="2">Bank Name</th>
        <th rowspan="2">AC Name</th>
        <th rowspan="2">AC Number</th>
        <th rowspan="2">Branch</th>
        <th rowspan="2">Address</th>
        <th rowspan="2">Contact No</th>
        <th colspan="2" class="text-center">Balance</th>
        <th  rowspan="2" class="text-center">Status</th>
        <th  rowspan="2" class="text-right">Action</th>
    </tr>
    <tr>
        <th class="text-right">Debit</th>
        <th class="text-right">Credit</th>
    </tr>
    </thead>
    <tbody>
    @foreach(activeBankAccounts() as $account)
        <tr>
            <td>{{ $sl = $loop->iteration }}</td>
            <td>{{ $account->bank->code }}</td>
            <td>{{ $account->ac_name }}</td>
            <td>{{ $account->ac_no }}</td>
            <td>{{ $account->branch }}</td>
            <td>{{ $account->address }}</td>
            <td>{{ $account->contact_no }}</td>
            @php($bankBalance = bankBalance($account->id))
            <td>{{ $bankBalance['title']=='Debit'?$bankBalance['balance']:'' }}</td>
            <td>{{ $bankBalance['title']=='Credit'?$bankBalance['balance']:'' }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $account->status==1?'success':'danger' }} font-size-12">{{ $account->status==1?'Enabled':'Disabled' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $account->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $account->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $account }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $account->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
