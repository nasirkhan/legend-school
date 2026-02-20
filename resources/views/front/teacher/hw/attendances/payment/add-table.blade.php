<table id="datatable_" class="table table-centered table-sm table-bordered dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th style="width: 30px">Sl.</th>
        <th>Name</th>
        <th class="text-center" style="width: 40px">Photo</th>
        @foreach(months() as $month)
            <th class="text-center" style="width: 180px">{{ $month->code }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        @php($sl = $loop->iteration)
        <tr>
            <td class="text-center">{{ $sl }}</td>
            <td>{{ $student->name }}</td>
            <td class="text-center">
                <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                    <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                </a>
            </td>
            @foreach(months() as $month)
                @php($attendance = paymentAttendanceCheck($data,$month->id,$student->id))

                <td class="">
                    <div class="custom-control custom-radio custom-radio-success present">
                        <input
                            type="radio"
                            id="present{{ $student->id }}-{{ $month->id }}"
                            name="attendance[{{ $student->id }}][{{ $month->id }}]" value="1"
                            class="custom-control-input" {{ ($attendance != null and $attendance->status==1)?'checked':'' }}
                        />
                        <label class="custom-control-label" for="present{{ $student->id }}-{{ $month->id }}">Present</label>
                    </div>
                    <div class="custom-control custom-radio custom-radio-warning absent">
                        <input
                            type="radio"
                            id="absent{{ $student->id }}-{{ $month->id }}"
                            name="attendance[{{ $student->id }}][{{ $month->id }}]" value="2"
                            class="custom-control-input" {{ ($attendance != null and $attendance->status==2)?'checked':'' }}
                        />
                        <label class="custom-control-label" for="absent{{ $student->id }}-{{ $month->id }}">Absent</label>
                    </div>
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
    @if(count($students)>0)
    <tfoot>
    <tr>
        <th colspan="15">
            <button type="submit" name="btn" value="save" class="btn btn-sm font-weight-bold btn-block btn-primary"><i class="fa fa-save"></i> Payment Attendance Update</button>
        </th>
    </tr>
    </tfoot>
    @endif
</table>
<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
