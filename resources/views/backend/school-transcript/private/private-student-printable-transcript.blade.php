@extends('backend.school-transcript.master')

@section('school-record')
    <table class="report-card">
        <thead style="font-weight: bold">
        <tr>
            <td colspan="9"><b>Higher Secondary School Record</b></td>
        </tr>
        <tr>
            <td rowspan="3">Subject</td>
            <td colspan="4">Grade: XI</td>
            <td colspan="4">Grade: XII</td>
        </tr>
        <tr>
            <td colspan="2">Pre Qualifying <br> Exam</td>
            <td colspan="2">Qualifying Exam</td>
            <td colspan="2">Pre Qualifying <br> Exam</td>
            <td colspan="2">Qualifying Exam</td>
        </tr>
        <tr>
            <td>Marks</td>
            <td>Grade</td>
            <td>Marks</td>
            <td>Grade</td>
            <td>Marks</td>
            <td>Grade</td>
            <td>Marks</td>
            <td>Grade</td>
        </tr>
        </thead>
        <tbody> @php($totalGradePoint = 0) @php($totalExamCount = 0)
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

                @if(isset($gXIPQmark) or isset($gXIQmark) or isset($gXIIPQmark) or isset($gXIIQmark))
                    <tr>
                        <td class="txt-l">{{ $subject->sub_code }} : {{ $subject->name }}</td>
                        <td>{{ (isset($gXIPQmark) and $gXIPQmark->mark>0) ? $gXIPQmark->mark : '' }}</td>
                        <td>{{ (isset($gXIPQmark) and $gXIPQmark->mark>0) ? $gXIPQGrade = grade($gXIPQmark->mark) : '' }}</td>

                        @if(isset($gXIPQmark) and $gXIPQmark->mark>0)
                            @php($totalGradePoint += GradeToPoint($gXIPQGrade)) @php($totalExamCount += 1)
                        @endif

                        <td>{{ (isset($gXIQmark) and $gXIQmark->mark>0)? $gXIQmark->mark : '' }}</td>
                        <td>{{ (isset($gXIQmark) and $gXIQmark->mark>0)? $gXIQGrade = grade($gXIQmark->mark) : '' }}</td>

                        @if(isset($gXIQmark) and $gXIQmark->mark>0)
                            @php($totalGradePoint += GradeToPoint($gXIQGrade)) @php($totalExamCount += 1)
                        @endif

                        <td>{{ (isset($gXIIPQmark) and $gXIIPQmark->mark>0)? $gXIIPQmark->mark : '' }}</td>
                        <td>{{ (isset($gXIIPQmark) and $gXIIPQmark->mark>0)? $gXIIPQGrade = grade($gXIIPQmark->mark) : '' }}</td>

                        @if(isset($gXIIPQmark) and $gXIIPQmark->mark>0)
                            @php($totalGradePoint += GradeToPoint($gXIIPQGrade)) @php($totalExamCount += 1)
                        @endif

                        <td>{{ (isset($gXIIQmark) and $gXIIQmark->mark>0)? $gXIIQmark->mark : '' }}</td>
                        <td>{{ (isset($gXIIQmark) and $gXIIQmark->mark>0)? $gXIIQGrade = grade($gXIIQmark->mark) : '' }}</td>

                        @if(isset($gXIIQmark) and $gXIIQmark->mark>0)
                            @php($totalGradePoint += GradeToPoint($gXIIQGrade)) @php($totalExamCount += 1)
                        @endif
                    </tr>
                @endif
            @endif
        @endforeach
        </tbody>
    </table>
@endsection

@section('cambridge-result')
    <table class="report-card">
        <thead style="font-weight: bold">
        <tr>
            <td colspan="4">CAIE Results</td>
        </tr>
        <tr>
            <td rowspan="3">Subject</td>
            <td colspan="3">Advance Level</td>
        </tr>
        <tr>

            <td colspan="2">AS Level <br> CAIE Grade</td>
            <td rowspan="2" style="width: 80px">Predicted Grade</td>
        </tr>
        <tr>
            <td>Marks</td>
            <td>Grade</td>
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
                @if(isset($gASFmark) or isset($grade))
                    <tr>
                        <td class="txt-l">{{ $subject->sub_code }} : {{ $subject->name }}</td>
                        <td>{{ (isset($gASFmark) and $gASFmark->mark>0)? $gASFmark->mark : '' }}</td>
                        <td>{{ (isset($gASFmark) and $gASFmark->mark>0)? $gASFGrade = grade($gASFmark->mark,'AS') : '' }}</td>

                        @if(isset($gASFmark) and $gASFmark->mark>0)
                            @php($totalGradePoint += GradeToPoint($gASFGrade)) @php($totalExamCount += 1)
                        @endif

                        <td>{{ isset($grade)? $predictedGrade = pointToGrade($grade->grade_point): '' }}</td>
                    </tr>
                @endif
            @endif
        @endforeach
        </tbody>
    </table>
@endsection

@section('gpa')
    <tr>
        <td class="b-n p-0">

            <table class="report-card" style="font-weight: bold">
                <tr>
                    <td style="width: 50%" class="txt-l">GPA of Student</td>
                    @php($gpa = numberFormat(($totalGradePoint/$totalExamCount),2))
                    <td>{{ $gpa }}</td>
                </tr>
            </table>
        </td>
    </tr>
@endsection

@section('signature')
    <table class="signature">
        <tr>
            <th class="txt-l" style="font-size: 13px"> Principal </th>
            {{--            <th class="txt-l" style="font-size: 13px">&nbsp; <br> Principal <br>&nbsp;</th>--}}
            <td>Fayez Ahmed Jahangir Masud</td>
        </tr>
        <tr>
            <th class="txt-l" style="font-size: 13px">Head of Academics</th>
            {{--            <th class="txt-l" style="font-size: 13px"> &nbsp; <br> Vice Principal <br>&nbsp;</th>--}}
            <td>Md. Shahriar Parvez</td>
        </tr>
    </table>
@endsection

@section('print-button')
    <a href="#" onclick="event.preventDefault(); window.print()"> Print </a>
    <button onclick="window.close()">Close</button>
    <script>
        // window.print()
    </script>
@endsection
