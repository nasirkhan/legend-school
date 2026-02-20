<table id="datatable" class="table table-centered table-bordered table-sm dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Candidate No</th>
        <th>Session</th>
        <th style="width: 183px" class="text-center">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->candidate_no }}</td>
            <td>{{ $student->year.'-'.$student->year+1 }}</td>
            <td>
                <button onclick="privateStudentEditForm(JSON.stringify({{ $student  }}))" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</button>
                <a href="{{ route('private-student-transcript',['id'=>$student->id]) }}" class="btn btn-sm btn-secondary"><i class="fa fa-file-alt"></i> Transcript</a>
                <a target="_blank" href="{{ route('private-student-transcript-print',['id'=>$student->id]) }}" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
