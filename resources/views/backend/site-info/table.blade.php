<table id="datatable" class="table table-centered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl.</th>
        <th>Property</th>
        <th>Value</th>
        <th class="text-right">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($siteInfos as $info)
        <tr>
            <td>{{ $sl = $loop->iteration }}</td>
            <td>{{ $info->property }}</td>
            <td>{!! $info->value !!}</td>
            <td class="text-right">
                <a href="{{ route('site-info-edit',['id'=>$info->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
{{--                <button onclick="edit('{{ $info }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
