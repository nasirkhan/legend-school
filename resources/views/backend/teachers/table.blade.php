<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Designation</th>
        <th>Mobile</th>
        <th>Email</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($teachers as $teacher)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->designation->name }}</td>
            <td>{{ $teacher->mobile }}</td>
            <td>{{ $teacher->email }}</td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $teacher->status==1?'success':'danger' }} font-size-12">{{ $teacher->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <button onclick="statusUpdateConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $teacher->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $teacher->status==1?'up':'down' }}"></i>
                </button>
                <a href="{{ route('teacher-edit',['id'=>$teacher->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
{{--                <button onclick="edit('{{ $teacher }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
                <button onclick="itemDeleteConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>
                @if(role()->code=='developer')
{{--                    <button onclick="loginInfoReset('{{ $teacher->id }}')" class="btn btn-sm btn-info" title="Reset Login Info"><i class="fa fa-user-lock"></i></button>--}}
                    <a href="{{ route('create-teacher-login-info',['id'=>$teacher->id]) }}" class="btn btn-sm btn-info" title="Reset Login Info"><i class="fa fa-user-lock"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
