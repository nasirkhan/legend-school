@extends('backend.school-transcript.master')
@section('school-record')
    <form action="{{ route('transcript-mark-save',['id'=>$student->id]) }}" method="POST">
        @csrf
        <table class="report-card">
            <thead style="font-weight: bold">
            <tr>
                <td colspan="4"><b>Higher Secondary School Record</b></td>
                <td colspan="1" class="p-0" style="padding-top: 0; padding-bottom: 0">
                    <button class="" type="submit" style="width: 100%; height: 100%; margin: 0; padding: 0; background-color: #0a58ca; color: white">Save Changes</button>
                </td>
            </tr>
            <tr>
                <td rowspan="3">Subject</td>
                <td colspan="2">Grade: XI</td>
                <td colspan="2">Grade: XII</td>
            </tr>
            <tr>
                <td colspan="1">Pre Qualifying <br> Exam</td>
                <td colspan="1">Qualifying Exam</td>
                <td colspan="1">Pre Qualifying <br> Exam</td>
                <td colspan="1">Qualifying Exam</td>
            </tr>
            <tr>
                <td>Marks</td>
                {{--            <td>Grade</td>--}}
                <td>Marks</td>
                {{--            <td>Grade</td>--}}
                <td>Marks</td>
                {{--            <td>Grade</td>--}}
                <td>Marks</td>
                {{--            <td>Grade</td>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)

                @php($status = false)
                @foreach($student->subjects as $tr)
                    @if($tr->subject_id == $subject->subject_id)
                        @php($status = true)
                        @break
                    @endif
                @endforeach

                @if($status)
                    @php($gXIPQmark = checkTranscriptMark($student->id,$subject->subject_id,'XI','pq'))
                    @php($gXIQmark = checkTranscriptMark($student->id,$subject->subject_id,'XI','q'))
                    @php($gXIIPQmark = checkTranscriptMark($student->id,$subject->subject_id,'XII','pq'))
                    @php($gXIIQmark = checkTranscriptMark($student->id,$subject->subject_id,'XII','q'))

                    <tr>
                        <td class="txt-l">{{ $subject->sub_code }} : {{ $subject->name }}</td>
                        <td>
                            <input class="txt-c" type="number" value="{{ isset($gXIPQmark)? $gXIPQmark->mark : '' }}" style="height: 100%; width: 100px" name="g_xi_pre_quali_marks[{{ $subject->subject_id }}]" step="0.01"/>
                        </td>
                        {{--                <td></td>--}}
                        <td>
                            <input class="txt-c" type="number" value="{{ isset($gXIQmark)? $gXIQmark->mark : '' }}" style="height: 100%; width: 100px" name="g_xi_quali_marks[{{ $subject->subject_id }}]" step="0.01"/>
                        </td>
                        {{--                <td></td>--}}
                        <td>
                            <input class="txt-c" type="number" value="{{ isset($gXIIPQmark)? $gXIIPQmark->mark : '' }}" style="height: 100%; width: 100px" name="g_xii_pre_quali_marks[{{ $subject->subject_id }}]" step="0.01"/>
                        </td>
                        {{--                <td></td>--}}
                        <td>
                            <input class="txt-c" type="number" value="{{ isset($gXIIQmark)? $gXIIQmark->mark : '' }}" value="" style="height: 100%; width: 100px" name="g_xii_quali_marks[{{ $subject->subject_id }}]" step="0.01"/>
                        </td>
                        {{--                <td></td>--}}
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </form>
@endsection

@section('cambridge-result')
    <form action="{{ route('cambridge-mark-save',['id'=>$student->id]) }}" method="POST">
        @csrf
        <table class="report-card">
            <thead style="font-weight: bold">
            <tr>
                <td colspan="2">CAIE Results</td>
                <td colspan="1" class="p-0" style="padding-top: 0; padding-bottom: 0">
                    <button class="" type="submit" style="width: 100%; height: 100%; margin: 0; padding: 0; background-color: #0a58ca; color: white">Save Changes</button>
                </td>
            </tr>
            <tr>
                <td rowspan="3">Subject</td>
                <td colspan="2">Advance Level</td>
            </tr>
            <tr>

                <td colspan="">AS Level <br> CAIE Grade</td>
                <td rowspan="2">Predicted <br> Grade Point</td>
            </tr>
            <tr>
                <td>Marks</td>
                {{--            <td>Grade</td>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                @php($cambStatus = false)
                @foreach($student->subjects as $tr)
                    @if($tr->subject_id == $subject->subject_id)
                        @php($cambStatus = true)
                        @break
                    @endif
                @endforeach


                @if($cambStatus)
                    @php($gASFmark = checkTranscriptMark($student->id,$subject->subject_id,'AS','f'))
                    @php($grade = checkPredictedGrade($student->id,$subject->subject_id))
                    <tr>
                        <td class="txt-l">{{ $subject->sub_code }} : {{ $subject->name }}</td>
                        <td class="p-0">
                            <input class="txt-c" type="number" value="{{ isset($gASFmark)? $gASFmark->mark : '' }}" style="height: 100%; width: 100px;" max="100" name="caie_marks[{{ $subject->subject_id }}]" step="0.01" />
                        </td>
                        {{--                <td></td>--}}
                        <td class="p-0">
                            <input class="txt-c" type="number" value="{{ isset($grade)? $grade->grade_point : '' }}" style="height: 100%; width: 100px" max="4" name="predicted_grades[{{ $subject->subject_id }}]" step="0.01" />
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </form>
@endsection

@section('print-button')
    <a target="_blank" href="{{ route('private-student-transcript-print',['id'=>$student->id]) }}"> Print </a>
    <a href="{{ route('school-transcript',['from'=>'private']) }}" class="back">Back</a>
{{--    <a href="#" onclick="event.preventDefault(); window.print()"> Print </a>--}}
@endsection

