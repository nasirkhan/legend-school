<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Section</th>
        <th>Name</th>
        <th>Code</th>
        <th>Start</th>
        <th>End</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($periods as $period)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $period->section->name }}</td>
            <td>{{ $period->name }}</td>
            <td>{{ $period->code }}</td>
            <td>{{ dateFormat($period->start,'g:i a') }}</td>
            <td>{{ dateFormat($period->end,'g:i a') }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $period->status==1?'success':'danger' }} font-size-12">{{ $period->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $period->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $period->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $period->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $period }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $period->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
