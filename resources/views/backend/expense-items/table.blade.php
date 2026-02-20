<table id="datatable" class="table table-sm table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Item</th>
        <th>Type</th>
        <th class="text-center">Status</th>
        @if($role=='developer' or $role=='s_admin')
            <th class="text-right" style="width: 80px">Option</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $item->name }}</td>
            <td class="text-capitalize">{{ $item->type }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $item->status==1?'success':'danger' }} font-size-12">{{ $item->status==1?'Active':'Close' }}</span>
            </td>

            @if($role=='developer' or $role=='s_admin')
                <td class="text-right">
                    <button onclick="statusUpdateConfirmation('{{ $item->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $item->status==1?'success':'warning' }} mb-sm-1">
                        <i class="fa fa-arrow-{{ $item->status==1?'up':'down' }}"></i>
                    </button>

                    <button onclick="edit({
                item: JSON.stringify({{ $item }})
                })" class="btn btn-sm btn-primary mb-sm-1">
                        <i class="fa fa-edit"></i>
                    </button>

                    <button onclick="itemDeleteConfirmation('{{ $item->id }}','{{ $sl }}')" class="btn btn-sm btn-danger mb-sm-1" id="sa-params">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
