<table id="datatable" class="table table-sm table-bordered table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px" class="text-center">Sl</th>
        <th>Date</th>
        <th>Chapter</th>
        <th>Description</th>
        <th style="width: 200px" class="text-center">Option</th>
    </tr>
    </thead>
    <tbody>
        @php($cws  = classWorks(Session::get('year'),Session::get('teacherId'), Session::get('class_id'),Session::get('subject_id')))
        @foreach($cws as $cw)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ dateFormat($cw->date,'jS M Y') }}</td>
                <td>{{ $cw->chapter }}</td>
                <td>{!! $cw->cw_detail !!}</td>
                <td>
                    <a href="{{ route('teacher-cw-review',['id'=>$cw->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Open</a>
                    <a href="{{ route('teacher-cw-edit',['id'=>$cw->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ route('teacher-cw-status-update',['id'=>$cw->id]) }}" class="btn btn-sm btn-{{ $cw->status==1? 'success':'warning' }}">
                        <i class="fa fa-arrow-{{ $cw->status==1? 'up':'down' }}"></i> {{ $cw->status == 1? 'Publish':'Unpublished' }}
                    </a>
                </td>
{{--                <td class="text-right">--}}
{{--                    <button onclick="statusUpdateConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $teacher->status==1?'success':'warning' }}">--}}
{{--                        <i class="fa fa-arrow-{{ $teacher->status==1?'up':'down' }}"></i>--}}
{{--                    </button>--}}
{{--                    <a href="{{ route('teacher-edit',['id'=>$teacher->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>--}}
{{--                    <button onclick="edit('{{ $teacher }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                    <button onclick="itemDeleteConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--                </td>--}}
            </tr>
        @endforeach

    </tbody>
</table>

{{--<a href="{{ route('hw-review',['id'=>$cw->id]) }}">({{ $cw->submission_date }}) {{ $cw->title }}</a>--}}
