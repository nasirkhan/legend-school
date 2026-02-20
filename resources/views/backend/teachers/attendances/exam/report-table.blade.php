<table id="datatable" class="table table-sm table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Nick Name</th>
        <th>Mobile</th>
        <th>School</th>
        <th class="text-center" style="width: 100px">Photo</th>
        <th class="text-center" style="width: 60px">Option</th>
    </tr>
    </thead>
    @if(isset($attendances) and count($attendances)>0)
        <tbody>
        @php($totalPresent = 0) @php($totalAbsent = 0)
        @foreach($students as $student)
            @php($sl = $loop->iteration)
            @php($attendance = examAttendanceCheck($data,$student->id))
            @if($attendance!=null and $attendance->status==1)
                @php($status=true)
                @php($totalPresent++)
            @else
                @php($status=false)
                @php($totalAbsent++)
            @endif

            <tr class="{{ $status?'':'text-danger' }}">
                <td>{{ $sl }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->nick_name }}
                </td>
                <td>{{ $student->mobile }}</td>
                <td>{{ isset($student->school)? $student->school->name : 'Not Found' }}</td>
                <td class="text-center">
                    <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                        <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                    </a>
                </td>
                <td class="text-center">{{ $status?'Present':'Absent' }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th colspan="2" class="text-primary">Total Student : {{ $totalPresent + $totalAbsent }}</th>
            <th colspan="2" class="text-success">Present : {{ $totalPresent }}</th>
            <th colspan="3" class="text-danger">Absent : {{ $totalAbsent }}</th>
        </tr>
        </tfoot>
    @else
        <tbody>
        <tr>
            <th colspan="7" class="text-danger text-center">Exam attendance report is not available !!!</th>
        </tr>
        </tbody>
    @endif
</table>
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
