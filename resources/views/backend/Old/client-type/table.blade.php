<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Client Type</th>
        <th>ক্লাইন্টের ধরণ</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clientTypes as $type)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ numberFormat($sl) }}</td>
            <td>{{ $type->name }}</td>
            <td>{{ $type->bn_name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $type->status==1?'success':'danger' }} font-size-12">{{ $type->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $type->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $type->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $type->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $type }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $type->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
