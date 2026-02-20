<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Category</th>
        <th>Sub-Category</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subCategories as $subCategory)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ bengaliNumber($sl = $loop->iteration) }}</td>
            <td>{{ $subCategory->category->name }}</td>
            <td>{{ $subCategory->name }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $subCategory->status==1?'success':'danger' }} font-size-12">{{ $subCategory->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $subCategory->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $subCategory->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $subCategory->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $subCategory }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $subCategory->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
