<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Month Name</th>
        <th>Month Code</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($months as $month)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $month->name }}</td>
            <td>{{ $month->code }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $month->status==1?'success':'danger' }} font-size-12">{{ $month->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $month->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $month->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $month->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $month }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
{{--                <button onclick="itemDeleteConfirmation('{{ $month->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
