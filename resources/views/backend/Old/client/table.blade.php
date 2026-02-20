<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th class="text-center">Sl</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Address</th>
        <th class="text-right">Payable</th>
        <th class="text-right">Receivable</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalDebit=0)
    @php($totalCredit=0)
    @foreach($clients as $client)
        @php($clientBalance = clientBalance($client->id))
        @if($clientBalance['title']=='Debit')
            @php($totalDebit += $clientBalance['balance'])
        @else
            @php($totalCredit += $clientBalance['balance'])
        @endif
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ $sl }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->mobile }}</td>
            <td>{{ $client->address }}</td>
            <td class="text-right">{{ $clientBalance['title']=='Debit'? numberFormat($clientBalance['balance'],2) :'' }}</td>
            <td class="text-right">{{ $clientBalance['title']=='Credit'? numberFormat($clientBalance['balance'],2) :'' }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $client->status==1?'success':'danger' }} font-size-12">{{ $client->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('client-details',['clientId'=>$client->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>

                <button onclick="edit('{{ $client }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                @if(role()->code=='developer')
                    <button onclick="statusUpdateConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $client->status==1?'success':'warning' }}">
                        <i class="fa fa-arrow-{{ $client->status==1?'up':'down' }}"></i>
                    </button>
                    <button onclick="itemDeleteConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th class="text-center" colspan="4">Total</th>
        <th class="text-right">{{ numberFormat($totalDebit,2) }}</th>
        <th class="text-right">{{ numberFormat($totalCredit,2) }}</th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>
