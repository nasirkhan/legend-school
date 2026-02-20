<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Category</th>
        <th>Sub-Category</th>
        <th>Company</th>
        <th class="text-center">Purchase Unit</th>
        <th class="text-center">Sale Unit</th>
        <th class="text-right">Sale Price</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $product->name }}</td>
            <td>
                @if(isset($product->category))
                    {{ $product->category->name }}
                @else
                    <span class="text-danger">Category not found</span>
                @endif
            </td>
            <td>
                @if(isset($product->subCategory))
                    {{ $product->subCategory->name }}
                @else
                    <span class="text-danger">Category not found</span>
                @endif
            </td>
            <td>{{ $product->brand->name }}</td>
            <td class="text-center">
                @if(isset($product->unit))
                    {{ $product->unit->name }}/{{ $product->unit->code }}
                @else
                    <span class="text-danger">Unit not found</span>
                @endif
            </td>
            <td class="text-center">
                @if(isset($product->secondaryUnit))
                    {{ $product->secondaryUnit->name }}/{{ $product->secondaryUnit->code }}
                @else
                    <span class="text-danger">Unit not found</span>
                @endif
            </td>
            <td class="text-right">{{ $product->sale_rate }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $product->status==1?'success':'danger' }} font-size-12">{{ $product->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $product->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $product->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $product->status==1?'up':'down' }}"></i>
                </button>
                <button onclick="edit('{{ $product }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                <button onclick="itemDeleteConfirmation('{{ $product->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
