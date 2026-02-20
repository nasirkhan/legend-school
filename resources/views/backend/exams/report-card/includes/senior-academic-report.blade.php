@php($hwTotalMark = 5)
@php($cwTotalMark = 10)
<table class="report-card">
    <thead>
    <tr>
        <td class="b-w" colspan="{{ 7+3 }}"></td>
    </tr>
    <tr>
        <th class="b-w" colspan="{{ 7+3 }}">Subject Wise Performance</th>
    </tr>

    <tr>
        <td class="bl-w br-w" colspan="{{ 7+3 }}"></td>
    </tr>

    <tr>
        <th class="bg-white">Sl.</th>
        <th class="bg-white" style="text-align: left">Subject Name & Code</th>
        @php($header = papersForCTReportCard($exam->id))
        @if($header['status'])
            @foreach($header['papers'] as $paper)
                <th class="bg-white">{{ $paper->name }} <br> ({{ $paper->mark }})</th>
            @endforeach
        @else
            <th class="bg-white">HW </th>
            <th class="bg-white">CW </th>
            <th class="bg-white">Written</th>
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

                @php($totalMarkObtained = 0)
                @php($totalMark = count($components)>0? $components->sum('mark') : 1)
                @php($hwMark = 0)
                @php($cwMark = 0)
                @php($topScore = 0)
                @php($average = 0)

                @php($topScore = topScore($exam->id,$classSubject->subject_id))
                @php($topAverage = avearge($topScore,$totalMark))

                @foreach($components as $component)
                    @php($data->paper_id = $component->id)
                    @php($data->subject_id = $classSubject->subject_id)
                    @php($result = resultCheck($data,$student->id))
                    <td>
                        {{ isset($result)? $result->mark : 0 }}
{{--                        <b>of</b>  {{ $component->mark }}--}}
                    </td>
                    @php($totalMarkObtained += isset($result)? $result->mark : 0 )
                @endforeach
                <td>{{ $totalMarkObtained }}</td>
                <td>{{ $totalMark }}</td>
                <td>{{ $topScore }}</td>
                @php($average = avearge($totalMarkObtained,$totalMark))

                <td>{{ numberFormat($average,2) }}</td>

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
