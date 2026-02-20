<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Session</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sessions as $session)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $session->name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $session->status==1?'success':'danger' }} font-size-12">{{ $session->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $session->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $session->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $session->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $session }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $session->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
