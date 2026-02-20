<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>Sector</th>
        <th>Account</th>
        <th>Type</th>
        <th class="text-center">Status</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactionItems as $item)
        <tr>
            <td>{{ $sl = $loop->iteration }}</td>
            <td>{{ $item->sector->name }}</td>
            <td>{{ $item->account_name }}</td>
            <td>{{ $item->account_type }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $item->status==1?'success':'danger' }} font-size-12">{{ $item->status==1?'Enabled':'Disabled' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $item->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $item->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $item->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $item }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $item->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
