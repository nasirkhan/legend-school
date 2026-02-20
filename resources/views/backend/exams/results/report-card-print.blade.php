<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Exam Report Card</title>

    @include('backend.exams.report-card.includes.style')
</head>
<body>
<div class="page">
    @include('sweetalert::alert')

    @include('backend.exams.results.includes.grade-system')

    <!-- Header Section -->
    <header>
        <img src="{{ asset(siteInfo('logo')) }}" alt="School Logo" class="logo">
        <h3 style="text-transform: uppercase">{{ $exam->name }}</h3>
        <h3 style="font-size: 18px">SESSION: {{ $exam->year }} - {{ $exam->year+1 }}</h3>
    </header>

    <!-- Table Section -->

    <main class="main">
        <img src="{{ asset(siteInfo('small_logo')) }}" style="position: absolute; opacity: 0.2; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 80%; height: auto" alt="">
        <table>
            <tr>
                <td class="b-w p-0">
                    <table class="student-info">
                        <thead style="text-align: left">
                        <tr>
                            <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
                            <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
                            <td style="width: 33.33%; border-top-color: white; border-left-color: white; border-right-color: white"></td>
                        </tr>
                        <tr>
                            <td style="text-align: left"><b>Student ID:</b> {{ $student->roll }}</td>
                            <td style="text-align: left" colspan="2"><b>Name:</b> {{ $student->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left"><b>Class:</b> {{ $exam->classInfo->code }}</td>
                            <td style="text-align: left"><b>Section:</b> {{ $exam->classInfo->section->name }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;"><b>Total Number of Class :</b> {{ $meta['no_of_class'] }}</td>
                            <td style="text-align: left;"><b>Total Present:</b> {{ $meta['no_of_class_present'] }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;"><b>Number of Parent-Teacher Meeting(PTM):</b> {{ $meta['ptm'] }}</td>
                            <td style="text-align: left;"><b>Attended:</b> {{ $meta['ptm_attended'] }}</td>
                        </tr>
                        </thead>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="b-w p-0">
                    <table class="report-card">
                        <thead>
                        <tr>
                            <td class="b-w" colspan="{{ count($components)+6 }}"></td>
                        </tr>
                        <tr>
                            <th class="b-w" colspan="{{ count($components)+6 }}">Subject Wise Performance</th>
                        </tr>

                        <tr>
                            <td class="bl-w br-w" colspan="{{ count($components)+6 }}"></td>
                        </tr>

                        <tr>
                            <th class="bg-white" rowspan="2">Sl.</th>
                            <th class="bg-white" rowspan="2" style="text-align: left">Subject Name & Code</th>
                            <th class="bg-white" colspan="{{ count($components) }}">{{ $exam->name }}</th>
                            <th class="bg-white" rowspan="2">Total({{ $totalMark = $components->sum('mark') }})</th>
                            <th class="bg-white" rowspan="2">Top <br> Score</th>
                            <th class="bg-white" rowspan="2">Average(%)</th>
                            <th class="bg-white" rowspan="2">Grade</th>
                        </tr>
                        <tr>
                            @foreach($components as $component)
                                <th class="bg-white">{{ $component->name }} ({{ $component->mark }})</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>

                        @php($studentTotalMark = 0) @php($examTotalMark = $components->sum('mark')*count($classSubjects))
                        @foreach($classSubjects as $classSubject)
                            @php($topScore = topScore($exam->id,$classSubject->subject_id))
                            @php($topAverage = avearge($topScore,$totalMark))
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>

                                @php($totalMarkObtained = 0)
                                @foreach($components as $component)
                                    @php($data->paper_id = $component->id)
                                    @php($data->subject_id = $classSubject->subject_id)
                                    @php($result = resultCheck($data,$student->id))
                                    <td>{{ numberFormat($result->mark,2) }}</td>
                                    @php($totalMarkObtained += $result->mark)
                                @endforeach
                                <td>{{ numberFormat($totalMarkObtained,2) }}</td>
                                <td>{{ numberFormat($topScore,2) }}</td>
                                <td>{{ $average = avearge($totalMarkObtained,$totalMark,2) }}</td>
                                <td>{{ grade($average) }}</td>
                            </tr>
                            @php($studentTotalMark += $totalMarkObtained)
                                @endforeach
                                <tr>
                                    <th class="bg-white" colspan="{{ count($components)+2 }}">Combined Result</th>
                                    <th class="bg-white">{{ numberFormat($studentTotalMark,2) }}</th>
                                    <td></td>
                                    <th class="bg-white">{{ $average = avearge($studentTotalMark,$examTotalMark,2) }}</th>
                                    <th class="bg-white">{{ grade($average) }}</th>
                                </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr><td class="b-w"></td></tr>
            <tr><th class="b-w" style="margin: 10px 0; font-size: 12px">Teacher's Evaluation</th></tr>
            <tr><td class="b-w"></td></tr>

            <tr>
                <td class="p-0 b-w">
                    <table>
                        <tr>
                            <th class="bg-white" colspan="2" style="font-size: 11px">Extracurricular Activities/ Skill development</th>
                        </tr>
                        <tr>
                            <td class="p-0" style="width: 55%">
                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($sc->items)+1 }}" style="width: 28%">{{ $sc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($sc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($lc->items)+1 }}" style="width: 28%">{{ $lc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($lc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($tic->items)+1 }}" style="width: 28%">{{ $tic->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($tic->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l" style="width: 62%">{{ $item->name }}</td>
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n bb-n" rowspan="{{ count($sic->items)+1 }}" style="width: 28%">{{ $sic->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($sic->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l {{ $loopCount==count($sic->items)?'bb-n':'' }}" style="width: 62%">{{ $item->name }}</td>
                                            <td class="{{ $loopCount==count($sic->items)?'bb-n':'n/a' }}" style="width: 10%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>
                            </td>

                            <td class="p-0" style="width: 45%">
                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($cpac->items)+2 }}" style="width: 30%">{{ $cpac->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($cpac->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l " style="width: 58%">{{ $item->name }}</td>
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($csc->items)+1 }}" style="width: 30%">{{ $csc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($csc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l" style="width: 58%">{{ $item->name }}</td>
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n" rowspan="{{ count($ac->items)+1 }}" style="width: 30%">{{ $ac->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($ac->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l" style="width: 58%">{{ $item->name }}</td>
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : 'n/a' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n bb-n" rowspan="{{ count($olmp->items)+1 }}" style="width: 30%">{{ $olmp->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($olmp->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l {{ $loopCount==count($olmp->items)?'bb-n':'' }}" style="width: 58%">{{ $item->name }}</td>
                                            <td class="{{ $loopCount==count($olmp->items)?'bb-n':'' }} pt-0 pb-0" style="width: 12%;">
                                                {{ isset($activity)? $activity->grade : 'n/a' }}
                                            </td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td class="b-w"></td></tr>
            <tr>
                <td class="p-0 b-w">
                    <table  style="margin-top: 2px">
                        <tr>
                            <th class="b-w txt-l" style="font-size: 12px">Class Teacher's Comment: </th>
                        </tr>
                        <tr>
                            <td class="b-w p-0" style="text-align: justify;">
                                {!! isset($comment) ? $comment->comment : '' !!}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>


    </main>

    <table class="signature">
        <tr>
            <td class="b-n p-0"></td>
            <td class="b-n p-0">
                @php($vpSign = siteInfo('vp_signature'))
                @if(isset($vpSign) and $vpSign != '')
                    <img src="{{ asset($vpSign) }}" alt="">
                @endif

            </td>
            <td class="b-n p-0">
                @php($principalSign = siteInfo('principal_signature'))
                @if(isset($principalSign) and $principalSign != '')
                    <img style="max-height: 70px" src="{{ asset($principalSign) }}" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;Class Teacher&nbsp;&nbsp;&nbsp;</th>
            <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;Vice Principal&nbsp;&nbsp;&nbsp;</th>
            <th style="font-size: 13px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Principal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>
    </table>

    <div class="print-control">
        <a href="#" onclick="event.preventDefault(); window.print()"> Print </a>
        {{--        <br>--}}
        <button onclick="window.close()">Close</button>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>{{ siteInfo('address') }}
            {{--            © {{ date('Y') }}--}}
            {{--            {{ siteInfo('name') }}. All Rights Reserved. | --}}
            Ph: {{ siteInfo('mobile') }}
            Email- {{ siteInfo('email') }}.
            Web: {{ 'www.legend.edu.bd' }}
        </p>
    </footer>

    <script>
        window.print()
    </script>
</div>
</body>
</html>
