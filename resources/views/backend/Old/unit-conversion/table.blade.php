<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>From</th>
        <th>To</th>
        <th>Factor</th>
{{--        <th class="text-center">Status</th>--}}
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($units as $unit)
        <tr>
            <td>{{ $sl = $loop->iteration }}</td>
            <td>{{ isset($unit->fromUnit)? $unit->fromUnit->name : 'Not found' }}</td>
            <td>{{ isset($unit->toUnit)? $unit->toUnit->name : 'Not Found' }}</td>
            <td>{{ $unit->times }}</td>
{{--            <td class="text-center">--}}
{{--                <span class="badge badge-pill badge-soft-{{ $unit->status==1?'success':'danger' }} font-size-12">{{ $unit->status==1?'Enabled':'Disabled' }}</span>--}}
{{--            </td>--}}
            <td class="text-right">
                <button onclick="edit('{{ $unit }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $unit->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
