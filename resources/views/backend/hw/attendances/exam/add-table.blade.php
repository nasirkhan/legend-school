<table id="datatable_" class="table table-centered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th>Nick Name</th>
        <th>Mobile</th>
        <th>School</th>
        <th class="text-center" style="width: 100px">Photo</th>
        <th class="text-center" style="width: 180px">Status</th>
    </tr>
    </thead>
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

        <tr>
            <td>{{ $sl }}</td>
            <td>
                <label onmouseup="attendanceCount('{{ $student->id }}','present')" class="col-form-label p-0 present" for="present{{ $student->id }}">{{ $student->name }}</label>
            </td>
            <td>
                <label onmouseup="attendanceCount('{{ $student->id }}','present')" class="col-form-label p-0 present" for="present{{ $student->id }}">{{ $student->nick_name }}</label>
            </td>
            <td>{{ $student->mobile }}</td>
            <td>{{ isset($student->school)? $student->school->name : 'Not Found' }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                </a>
            </td>
            <td class="text-center">
                <div class="row">
                    <div class="col pr-0 custom-control custom-radio custom-radio-success present" onmouseup="attendanceCount('{{ $student->id }}','present')">
                        <input type="radio" id="present{{ $student->id }}" name="attendance[{{ $student->id }}]" value="1" class="custom-control-input" {{ $status? 'checked' : '' }}>
                        <label class="custom-control-label" for="present{{ $student->id }}">Present</label>
                    </div>
                    <div class="col custom-control custom-radio custom-radio-warning absent" onmouseup="attendanceCount('{{ $student->id }}','absent')">
                        <input type="radio" id="absent{{ $student->id }}" name="attendance[{{ $student->id }}]" value="2" class="custom-control-input" {{ $status? '' : 'checked' }} >
                        <label class="custom-control-label" for="absent{{ $student->id }}">Absent</label>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2" class="text-primary">Total Number Of Student</th>
        <th colspan="" class="text-success">Present : <span id="studentPresent">{{ $totalPresent }}</span></th>
        <th colspan="" class="text-danger">Absent : <span id="studentAbsent">{{ $totalAbsent }}</span></th>
        <th colspan="3">
            <div class="row">
                <div class="col-lg text-right">
                    <button type="submit" name="btn" value="save" class="btn btn-success mr-lg-2"><i class="fa fa-save"></i> Save Without Message</button>
                    <button type="submit" name="btn" value="save_and_send" class="btn btn-primary"><i class="fa fa-save"></i> Save With Message <i class="bx bx-message"></i></button>
                </div>
            </div>
        </th>
    </tr>
    </tfoot>
</table>

<script> totalAbsent = {{ $totalAbsent }}; totalPresent = {{ $totalPresent }};</script>
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
