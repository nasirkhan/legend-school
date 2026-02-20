<table id="datatable" class="table table-sm table-bordered table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px" class="text-center">Sl</th>
        <th>Student</th>
        <th>Status</th>
        <th>Date</th>
        <th style="width: 70px" class="text-center">Option</th>
    </tr>
    </thead>
    <tbody>
{{--        @php($homeWorks  = homeWorks(Session::get('year'),Session::get('class_id'),Session::get('subject_id')))--}}
        @foreach($homeWorks as $homeWork)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
{{--                <td>{{ isset($homeWork->student)? $homeWork->student->name:'' }}</td>--}}
                <td>{{ $homeWork->student->name }}</td>
                <td>
                    @if($homeWork->status == 2)
                        {{ 'Received' }}
                    @elseif($homeWork->status==1)
                        {{ 'Returned' }}
                    @endif
                </td>
                <td>
                    @if($homeWork->status == 2)
                        {{ dateFormat($homeWork->created_at,'jS M Y') }}
                    @elseif($homeWork->status==1)
                        {{ dateFormat($homeWork->updated_at,'jS M Y') }}
                    @endif

                </td>
                <td>
                    <a target="_blank" href="{{ route('open-hw-for-checking',['id'=>$homeWork->id]) }}" class="btn btn-sm btn-secondary">
                        <i class="fa fa-eye"></i>
                        @if($homeWork->status == 2)
                            Check
                        @elseif($homeWork->status==1)
                            Recheck
                        @endif
                    </a>
{{--                    <a href="" class="btn btn-sm btn-info"><i class="fa fa-paper-plane"></i> Return</a>--}}
                </td>
{{--                <td>--}}
{{--                    <a href="{{ route('teacher-hw-review',['id'=>$homeWork->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Open</a>--}}
{{--                    <a href="{{ route('teacher-hw-edit',['id'=>$homeWork->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>--}}
{{--                    <a href="{{ route('teacher-hw-status-update',['id'=>$homeWork->id]) }}" class="btn btn-sm btn-{{ $homeWork->status==1? 'success':'warning' }}">--}}
{{--                        <i class="fa fa-arrow-{{ $homeWork->status==1? 'up':'down' }}"></i> {{ $homeWork->status == 1? 'Publish':'Unpublished' }}--}}
{{--                    </a>--}}
{{--                </td>--}}
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

{{--<a href="{{ route('hw-review',['id'=>$homeWork->id]) }}">({{ $homeWork->submission_date }}) {{ $homeWork->title }}</a>--}}
