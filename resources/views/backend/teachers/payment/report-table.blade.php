<table id="datatable" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Nick Name</th>
        <th>Mobile</th>
        <th>School</th>
        <th class="text-center" style="width: 100px">Photo</th>
        <th class="text-center" style="width: 50px">Present</th>
        <th class="text-center" style="width: 50px">Absent</th>
        <th class="text-center" style="width: 50px">Total</th>
        <th class="text-center" style="width: 60px">Option</th>
    </tr>
    </thead>
    <tbody>
    @php($totalPresent = 0) @php($totalAbsent = 0)
    @foreach($students as $student)
        @php($sl = $loop->iteration)
        @php($attendance = attendanceCheck($data,$student->id))
        @if($attendance!=null and $attendance->status==1)
            @php($status=true)
            @php($totalPresent++)
        @else
            @php($status=false)
            @php($totalAbsent++)
        @endif

        <tr>
            <td>{{ $sl }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->nick_name }}</td>
            <td>{{ $student->mobile }}</td>
            <td>{{ isset($student->school)? $student->school->name : 'Not Found' }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                </a>
            </td>
            <td class="text-center">{{ $present = attendanceCount($data,$student->id,1) }}</td>
            <td class="text-center">{{ $absent = attendanceCount($data,$student->id,2) }}</td>
            <td class="text-center">{{ $present + $absent }}</td>
            <td class="text-center">
{{--                @php($data->student_id = $student->id)--}}
                <button type="button" onclick="attendanceDetail({
                year: '{{ $data->year }}',
                session_id: {{ $data->session_id }},
                class_id: {{ $data->class_id }},
                batch_id: {{ $data->batch_id }},
                start: '{{ $data->start }}',
                end: '{{ $data->end }}',
                student_id: {{ $student->id }},
                })" class="btn btn-sm btn-secondary"><i class="fa fa-eye"></i> Detail</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
