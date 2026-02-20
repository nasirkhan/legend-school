<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th class="">Component</th>
        <th class="text-center">Code</th>
        <th class="text-center">Mark</th>
        <th class="text-center">Weight</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($papers as $paper)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $paper->name }}</td>
            <td class="text-center">{{ $paper->code }}</td>
            <td class="text-center">{{ $paper->mark }}</td>
            <td class="text-center">{{ $paper->weight }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $paper->status==1?'success':'danger' }} font-size-12">{{ $paper->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $paper->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $paper->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $paper->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $paper }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $paper->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
