<table id="datatable" class="table table-hover table-bordered table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Item</th>
        <th>Billing Cycle</th>
        <th class="text-right">Amount</th>
        <th class="text-center">Status</th>
        @if($role=='developer' or $role=='s_admin')
            <th class="text-right" style="width: 80px">Option</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($classItems as $classItem)
        @php($item = $classItem->item)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $item->name }}</td>
{{--            @php($usedFor = null)--}}
{{--            @if($item->used_for==1)--}}
{{--                @php($usedFor = 'Students')--}}
{{--            @elseif($item->used_for==2)--}}
{{--                @php($usedFor = 'Office Staff')--}}
{{--            @endif--}}
{{--            <td>{{ $usedFor }}</td>--}}

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
            <td class="text-right">
                {{ $classItem->amount!==null? numberFormat($classItem->amount) : '' }}
            </td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $classItem->status==1?'success':'danger' }} font-size-12">{{ $classItem->status==1?'Active':'Close' }}</span>
            </td>

            @if($role=='developer' or $role=='s_admin')
                <td class="text-right">
                    <button onclick="statusUpdateConfirmation('{{ $classItem->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $classItem->status==1?'success':'warning' }}">
                        <i class="fa fa-arrow-{{ $classItem->status==1?'up':'down' }}"></i>
                    </button>

                    <button onclick="edit({
                item: JSON.stringify({{ $classItem }})
                })" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit"></i>
                    </button>

                    <button onclick="itemDeleteConfirmation('{{ $classItem->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
