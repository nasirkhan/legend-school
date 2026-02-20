<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Date</th>
        <th>Type</th>
        <th>Client</th>
        <th class="text-right">Transport(Tk)</th>
        <th class="text-right">Labour(Tk)</th>
    </tr>
    </thead>
    <tbody>
    @php($i=1)
    @php($totalTransportCost=0)
    @php($totalLabourCost=0)
    @foreach($transactions as $transaction)
        @if($transaction->transport_cost>0 or $transaction->labour_cost>0)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ dateFormat($transaction->created_at,'d/m/Y') }}</td>
            <td>{{ $transaction->transaction_type }}</td>
            <td>{{ $transaction->client_id == null ? $transaction->client_name : $transaction->client->name }}</td>
            <td class="text-right">{{ numberFormat($transaction->transport_cost) }}</td>
            <td class="text-right">{{ numberFormat($transaction->labour_cost) }}</td>
        </tr>
        @php($totalTransportCost += $transaction->transport_cost)
        @php($totalLabourCost += $transaction->labour_cost)
        @endif
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th class="text-center" colspan="4">Total</th>
        <th class="text-right">{{ numberFormat($totalTransportCost) }}</th>
        <th class="text-right">{{ numberFormat($totalLabourCost) }}</th>
    </tr>
    </tfoot>
</table>
