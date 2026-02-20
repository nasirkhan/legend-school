<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>Sector</th>
        <th class="text-center">Status</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactionSectors as $sector)
        <tr>
            <td>{{ $sl = $loop->iteration }}</td>
            <td>{{ $sector->name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $sector->status==1?'success':'danger' }} font-size-12">{{ $sector->status==1?'Enabled':'Disabled' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $sector->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $sector->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $sector->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $sector }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $sector->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
