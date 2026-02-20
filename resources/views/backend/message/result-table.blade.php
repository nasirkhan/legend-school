@if(isset($attendances))
    @if(count($attendances)>0)
        @php($examTotal = $papers->sum('mark'))
        @php($topScore = topScore($data->exam_id))
        <table class="table table-sm table-centered table-bordered">
            <tr class="text-primary">
                <th>Highest : {{ $topTotal = $topScore['results']->sum('mark') }}</th>
                <th class="text-center">Avg : {{ $avg = numberFormat(($topTotal/$examTotal)*100,2) }} %</th>
                <th class="text-center">Grade : {{ grade($avg) }}</th>
                <th class="text-center">Scorer : {{ $topScore['student']->name }}</th>
                <th class="text-center pt-1 pb-1">
                    <a class="image-popup-no-margins" href="{{ isset($topScore['student']->photo)? asset($topScore['student']->photo->url) : '' }}">
                        <img class="img-fluid" alt="Image" src="{{ isset($topScore['student']->photo)? asset($topScore['student']->photo->url) : '' }}" width="25">
                    </a>
                </th>
                <th class="text-center">Batch : {{ $topScore['student']->batch->name }}</th>
                <th class="text-center">School : {{ $topScore['student']->school->name }}</th>
                <th class="text-right">Mobile : {{ $topScore['student']->mobile }}</th>
            </tr>
        </table>

        <table id="datatable" class="table table-centered table-bordered table-nowrap dt-responsive mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th style="width: 30px">Sl.</th>
                <th>Name</th>
                <th>Nick Name</th>
                <th class="text-center" style="width: 100px">Photo</th>
                <th>Mobile</th>
                <th>School</th>
                <th>Batch</th>
                @foreach($papers as $paper)
                    <th class="text-center">{{ $paper->code }} : {{ $paper->mark }}</th>
                @endforeach
                <th class="text-center">Total : {{ $examTotal }}</th>
                <th>Avg(%)</th>
                <th>Grade</th>
                <th class="text-center"><input type="checkbox" id="all"/></th>
            </tr>
            </thead>
            <tbody>
            @php($totalPresent = 0) @php($totalAbsent = 0) @php($result = null)
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

                <tr class="{{ $status? '':'text-danger' }}">
                    <td class="pt-1 pb-1">{{ $sl }}</td>
                    <td class="pt-1 pb-1">{{ $student->name }}</td>
                    <td class="pt-1 pb-1">{{ $student->nick_name }}</td>
                    <td class="text-center pt-1 pb-1">
                        <a class="image-popup-no-margins" href="{{ isset($student->photo)? asset($student->photo->url) : '' }}">
                            <img class="img-fluid" alt="Image" src="{{ isset($student->photo)? asset($student->photo->url) : '' }}" width="25">
                        </a>
                    </td>
                    <td class="pt-1 pb-1">{{ $student->mobile }}</td>
                    <td class="pt-1 pb-1">{{ isset($student->school)? $student->school->name : 'Not Found' }}</td>
                    <td class="pt-1 pb-1">{{ isset($student->batch)? $student->batch->name : 'Not Found' }}</td>
                    @php($total=0)
                    @foreach($papers as $paper)
                        @if($status)
                            @php($data->paper_id = $paper->id)
                            @php($result = resultCheck($data,$student->id))
                            <td class="text-center pt-1 pb-1">{{ $result!=null? $result->mark : '<span class="text-danger">Absent</span>' }}</td>
                            @php($result!=null? $total +=$result->mark : $total +=0)
                        @else
                            <td class="text-center pt-1 pb-1">Absent</td>
                        @endif
                    @endforeach

                    @if($status)
                        <td class="text-center pt-1 pb-1">{{ $total }}</td>
                        @php($avg = numberFormat(($total/$examTotal)*100,2))
                        <td class="text-center pt-1 pb-1">{{ $avg }}</td>
                        <td class="text-center pt-1 pb-1">{{ grade($avg) }}</td>
                        <td class="text-center"><input type="checkbox" name="students[{{ $student->id }}]" class="check"/></td>
                    @else
                        <td class="text-center pt-1 pb-1">Absent</td>
                        <td class="text-center pt-1 pb-1">--</td>
                        <td class="text-center pt-1 pb-1">--</td>
                        <td class="text-center">--</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" class="text-primary">Total Number Of Student : {{ $totalPresent+$totalAbsent }}</th>
                <th colspan="3" class="text-success text-center">Present : <span id="studentPresent">{{ $totalPresent }}</span></th>
                @php($lastColspan = 2+count($papers))
                <th colspan="{{ $lastColspan }}" class="text-danger text-center">Absent : <span id="studentAbsent">{{ $totalAbsent }}</span></th>
                <th class="p-1" colspan="2">
                    <button type="submit" class="btn  btn-success btn-block"> Send <i class="bx bx-send"></i></button>
                </th>
            </tr>
            </tfoot>
        </table>
    @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Alert !!!</strong> Result was not found. Please check . . . . . .
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@else
    <h1 class="text-info text-center">Please select all field above to see result !!!</h1>
@endif

<script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
<script>
    $("#all").change(function () {
        if ($(this).prop('checked')){
            $('.check').prop('checked',true);
        }else {
            $('.check').prop('checked',false);
        }
    });
</script>
