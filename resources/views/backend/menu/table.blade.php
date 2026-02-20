<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Menu Title</th>
        <th class="text-center">Position</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($menus as $menu)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $menu->name }}</td>
            <td class="text-center">{{ $menu->position }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $menu->status==1?'success':'danger' }} font-size-12">{{ $menu->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $menu->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $menu->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $menu->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $menu }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
{{--                <button onclick="itemDeleteConfirmation('{{ $menu->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
