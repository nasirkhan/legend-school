<table id="datatable" class="table table-sm table-bordered table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Subject</th>
        <th>Home Works</th>
    </tr>
    </thead>
    <tbody>
    @foreach($classSubjects as $classSubject)
        @php($homeWorks  = homeWorks($data['year'],$data['class_id'],$classSubject->subject_id))
        @php($sl = $loop->iteration)
        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>
            <td>
                <ol class="mb-0">
                    @foreach($homeWorks as $homeWork)
                        <li>
                            <a href="{{ route('hw-review',['id'=>$homeWork->id]) }}">({{ $homeWork->submission_date }}) {{ $homeWork->title }}</a>
                        </li>
                    @endforeach
                </ol>
            </td>
{{--            <td class="text-right">--}}
{{--                <button onclick="statusUpdateConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-{{ $teacher->status==1?'success':'warning' }}">--}}
{{--                    <i class="fa fa-arrow-{{ $teacher->status==1?'up':'down' }}"></i>--}}
{{--                </button>--}}
{{--                <a href="{{ route('teacher-edit',['id'=>$teacher->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>--}}
{{--                <button onclick="edit('{{ $teacher }}','{{ $sl }}')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>--}}
{{--                <button onclick="itemDeleteConfirmation('{{ $teacher->id }}','{{ $sl }}')" class="btn btn-sm btn-danger" id="sa-params"><i class="fa fa-trash-alt"></i></button>--}}
{{--            </td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
