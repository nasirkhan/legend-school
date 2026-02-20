<table id="datatable" class="table table-sm table-bordered table-hover table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px" class="text-center">Sl</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Exam</th>
        <th>Syllabus</th>
        <th>RW Link</th>
        <th style="width: 100px" class="text-center">Option</th>
    </tr>
    </thead>
    <tbody>
        @php($syllabi  = syllabusForTeacher(Session::get('year'),Session::get('teacherId'), Session::get('class_id'),Session::get('subject_id')))
        @foreach($syllabi as $syllabus)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $syllabus['class'] }}</td>
                <td>{{ $syllabus['subject'] }}</td>
                <td>{{ $syllabus['exam'] }}</td>
                <td>{!! $syllabus['syllabus'] !!}</td>
                <td>
                    @if($syllabus['rw'] == null)
                        <span class="badge badge-danger">Not Uploaded</span>
                    @else
                        <a target="_blank" href="{{ asset($syllabus['rw']) }}">Rev. W.S</a>
                    @endif
                </td>
                <td>
{{--                    <a href="{{ route('teacher-syllabus-review',['id'=>$syllabus['id']]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Open</a>--}}
                    <a href="{{ route('teacher-syllabus-edit',['id'=>$syllabus['id']]) }}" class="btn btn-block btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{ route('teacher-syllabus-status-update',['id'=>$syllabus['id']]) }}" class="btn btn-block btn-sm btn-{{ $syllabus['status']==1? 'success':'warning' }}">
                        <i class="fa fa-arrow-{{ $syllabus['status']==1? 'up':'down' }}"></i> {{ $syllabus['status'] == 1? 'Publish':'Unpublished' }}
                    </a>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
