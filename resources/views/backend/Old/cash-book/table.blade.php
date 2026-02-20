<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th class="text-center">Sl.</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Address</th>
        <th>Debit</th>
        <th>Credit</th>
        <th class="text-center">Status</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
{{--    @foreach($clients as $client)--}}
{{--        @php($clientBalance = clientBalance($client->id))--}}
{{--        <tr>--}}
{{--            <td class="text-center">{{ $sl = $loop->iteration }}</td>--}}
{{--            <td>{{ $client->name }}</td>--}}
{{--            <td>{{ $client->mobile }}</td>--}}
{{--            <td>{{ $client->address }}</td>--}}
{{--            <td>{{ $clientBalance['title']=='Debit'? $clientBalance['balance'] :'' }}</td>--}}
{{--            <td>{{ $clientBalance['title']=='Credit'? $clientBalance['balance'] :'' }}</td>--}}
{{--            <td class="text-center">--}}
{{--                <span class="badge badge-pill badge-soft-{{ $client->status==1?'success':'danger' }} font-size-12">{{ $client->status==1?'Enabled':'Disabled' }}</span>--}}
{{--            </td>--}}
{{--            <td class="text-right">--}}
{{--                <a href="{{ route('client-details',['clientId'=>$client->id]) }}" class="btn btn-secondary btn-sm" title="Details"><i class="fa fa-eye"></i></a>--}}
{{--                <button onclick="statusUpdateConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $client->status==1?'success':'warning' }}">--}}
{{--                    <i class="fa fa-arrow-{{ $client->status==1?'up':'down' }}"></i>--}}
{{--                </button>--}}
{{--                <button onclick="edit('{{ $client }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                <button onclick="itemDeleteConfirmation('{{ $client->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
    </tbody>
</table>
