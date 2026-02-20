<table id="datatable" class="table table-sm table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Item</th>
        <th>Use For</th>
        <th>Billing Cycle</th>
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
            @php($usedFor = null)
            @if($item->used_for==1)
                @php($usedFor = 'Students')
            @elseif($item->used_for==2)
                @php($usedFor = 'Office Staff')
            @endif
            <td>{{ $usedFor }}</td>

            @php($billingCycle = null)
            @if($item->billing_cycle==1)
                @php($billingCycle = 'One Time')
            @elseif($item->billing_cycle==2)
                @php($billingCycle = 'Yearly')
            @elseif($item->billing_cycle==3)
                @php($billingCycle = 'Monthly')
            @elseif($item->billing_cycle==4)
                @php($billingCycle = 'Any Time')
            @endif
            <td>{{ $billingCycle }}</td>
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
