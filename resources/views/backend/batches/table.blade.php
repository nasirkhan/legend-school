<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Class</th>
        <th>Section</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($batches as $batch)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td class="{{ $batch->className->status != 1 ? 'text-danger':'' }}">{{ $batch->className->name }}</td>
            <td>{{ $batch->name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $batch->status==1?'success':'danger' }} font-size-12">{{ $batch->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $batch->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $batch->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $batch->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $batch }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $batch->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
