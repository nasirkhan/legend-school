@php($hwTotalMark = 5)
@php($cwTotalMark = 10)
<table class="report-card">
    <thead>
    @php($colspanIncrease = 0)
    @if($exam->hw_mark =='a' and $exam->cw_mark=='a')
        @php($colspanIncrease = 4)
    @elseif($exam->hw_mark =='a' or $exam->cw_mark=='a')
        @php($colspanIncrease = 3)
    @endif
    <tr>
        <td class="b-w" colspan="{{ 7+$colspanIncrease }}"></td>
    </tr>
    <tr>
        <th class="b-w" colspan="{{ 7+$colspanIncrease }}">Subject Wise Performance</th>
    </tr>

    <tr>
        <td class="bl-w br-w" colspan="{{ 7+$colspanIncrease }}"></td>
    </tr>

    <tr>
        <th class="bg-white">Sl.</th>
        <th class="bg-white" style="text-align: left">Subject Name & Code</th>

        @if($exam->hw_mark=='a')<th class="bg-white">HW <br> ({{ $hwTotalMark }})</th>@endif
        @if($exam->cw_mark=='a')<th class="bg-white">CW <br> ({{ $cwTotalMark }})</th>@endif
        @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
            <th class="bg-white">Exam</th>
            <th class="bg-white">Out Of</th>
        @endif

        <th class="bg-white">Total <br> Score</th>
        <th class="bg-white">Out Of</th>
        <th class="bg-white">Highest <br> Score</th>
        <th class="bg-white">Average <br> (%)</th>
        <th class="bg-white">Grade</th>
    </tr>
    </thead>
    <tbody>

    @php($sl=1)
    @foreach($classSubjects as $classSubject)
        @php($status = subjectCheck($student->id,$data->class_id,$classSubject->subject_id))
        @if($status===true)
            @php($components = papers($exam->id, $classSubject->subject_id))
            <tr>
                <td>{{ $sl++ }}</td>
                <td style="text-align: left">{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>

                @php($totalMarkObtained = 0) @php($totalMark = count($components)>0? $components->sum('mark') : 1)
                @php($hwMark = 0) @php($cwMark = 0) @php($topScore = 0) @php($average = 0)
                @php($topScore = topScore($exam->id,$classSubject->subject_id))
                @php($topAverage = avearge($topScore,$totalMark))

                @foreach($components as $component)
                    @php($data->paper_id = $component->id)
                    @php($data->subject_id = $classSubject->subject_id)
                    @php($result = resultCheck($data,$student->id))
                    @php($totalMarkObtained += isset($result)? $result->mark : 0 )
                @endforeach


                @php($average = avearge($totalMarkObtained,$totalMark))

                @if($exam->hw_mark=='a')<td>{{ $hwMark = autoMark($average,$hwTotalMark) }}</td>@endif
                @if($exam->cw_mark=='a')<td>{{ $cwMark = autoMark($average,$cwTotalMark) }}</td>@endif

                @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
                    <td>{{ numberFormat($totalMarkObtained) }}</td>
                    <td>{{ $totalMark }}</td>
                @endif
                <td>
                    @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
                        {{ $totalMarkObtained = ($totalMarkObtained + $hwMark + $cwMark) }}
                    @else
                        {{ numberFormat($totalMarkObtained) }}
                    @endif
                </td>
                <td>
                    @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
                        {{ $totalMark = ($totalMark + $hwTotalMark + $cwTotalMark) }}
                    @else
                        {{ numberFormat($totalMark) }}
                    @endif
                </td>
                <td>
                    @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
                        @php($topHW = autoMark($topAverage,$hwTotalMark))
                        @php($topCW = autoMark($topAverage,$cwTotalMark))
                        {{ $topScore = ($topScore + $topHW + $topCW) }}
                    @else
                        {{ $topScore }}
                    @endif
                </td>
                <td>
                    @if($exam->hw_mark=='a' or $exam->cw_mark=='a')
                        {{ $average = avearge($totalMarkObtained,$totalMark) }}
                    @else
                        {{ $average }}
                    @endif
                </td>
                <td>{{ grade($average) }}</td>
            </tr>
            {{--                            @php($studentTotalMark += $totalMarkObtained)--}}
        @endif
    @endforeach
    {{--                        <tr>--}}
    {{--                            <th class="bg-white" colspan="{{ count($components)+2 }}">Combined Result</th>--}}
    {{--                            <th class="bg-white">{{ numberFormat($studentTotalMark,2) }}</th>--}}
    {{--                            <th class="bg-white">{{ $average = avearge($studentTotalMark,$examTotalMark,2) }}</th>--}}
    {{--                            <th class="bg-white">{{ grade($average) }}</th>--}}
    {{--                        </tr>--}}
    </tbody>
</table>
