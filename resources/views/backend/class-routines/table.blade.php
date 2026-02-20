<table id="datatable" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Class</th>
        <th>Link</th>
        <th class="text-center">Status</th>
        <th class="text-right">Option</th>
    </tr>
    </thead>
    <tbody>
    @foreach($classRoutines as $classRoutine)
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $classRoutine->classInfo->name }}</td>
            <td><a target="_blank" href="{{ asset($classRoutine->url) }}">Open</a></td>
            <td class="text-center">
                <span class="badge badge-pill badge-soft-{{ $classRoutine->status==1?'success':'danger' }} font-size-12">{{ $classRoutine->status==1?'Active':'Close' }}</span>
            </td>
            <td class="text-right">
                <a href="{{ route('update-class-routine-status',['id'=>$classRoutine->id]) }}" onclick="return confirm('If you want to update status, press OK')" class="btn btn-sm btn-{{ $classRoutine->status==1?'success':'warning' }}">
                    <i class="fa fa-arrow-{{ $classRoutine->status==1?'up':'down' }}"></i>
                </a>
                <a href="{{ route('class-routine-edit',['id'=>$classRoutine->id]) }}"  class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="{{ route('class-routine-delete',['id'=>$classRoutine->id]) }}" onclick="return confirm('If you want to delete this page, press OK')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
