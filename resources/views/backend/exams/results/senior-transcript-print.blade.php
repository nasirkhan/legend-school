<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $student->name }}_{{ $exam->name }}_Transcript</title>

    @include('backend.exams.report-card.includes.style')

    <style>
        .student-font{
            font-size: 11px !important;
        }

        .mark-header-font{
            font-size: 11px !important;
        }
        .mark-font{
            font-size: 10px !important;
        }

        .eca-font{
            font-size: 10px !important;
        }
        .comment-font{
            font-size: 11px !important;
        }
    </style>
</head>
<body>
<div class="page">
    @include('sweetalert::alert')

    @include('backend.exams.results.includes.grade-system')
    <!-- Header Section -->
    <header>
        <img src="{{ asset(siteInfo('logo')) }}" alt="School Logo" class="logo">
        <h3 style="text-transform: uppercase; font-size: 22px; margin-bottom: -8px">{{ $exam->name }}</h3>
        <h3 style="font-size: 15px">SESSION: {{ $exam->year }} - {{ $exam->year+1 }}</h3>
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
                            <td class="student-font" style="text-align: left;"><b>Student ID:</b> {{ $student->roll }}</td>
                            <td class="student-font" style="text-align: left;" colspan="2"><b>Name:</b> {{ $student->name }}</td>
                        </tr>
                        <tr>
                            <td class="student-font" colspan="2" style="text-align: left;"><b>Class:</b> {{ $exam->classInfo->code }}</td>
                            <td class="student-font" style="text-align: left;"><b>Section:</b> {{ $exam->classInfo->section->name }}</td>
                        </tr>
                        <tr>
                            <td class="student-font" colspan="2" style="text-align: left;"><b>Total Number of Class :</b> {{ $meta['no_of_class'] }}</td>
                            <td class="student-font" style="text-align: left;"><b>Total Present:</b> {{ $meta['no_of_class_present'] }}</td>
                        </tr>
                        <tr>
                            <td class="student-font" colspan="2" style="text-align: left;"><b>Number of Parent-Teacher Meeting(PTM):</b> {{ $meta['ptm'] }}</td>
                            <td class="student-font" style="text-align: left;"><b>Attended:</b> {{ $meta['ptm_attended'] }}</td>
                        </tr>
                        </thead>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="b-w p-0">
                    @if($exam->hw_mark =='a' and $exam->cw_mark=='a')
                        @include('backend.exams.report-card.includes.senior-academic-report-with-auto-hw-cw-mark')
                    @else
{{--                        @php($hwTotalMark = 5)--}}
{{--                        @php($cwTotalMark = 10)--}}
                        <table class="report-card">
                            <thead>
                            <tr>
                                <td class="b-w" colspan="{{ 9+count($transcript->rules) }}"></td>
                            </tr>
                            <tr>
                                <th class="b-w" style="border-right: none; border-left: none; font-size: 12px" colspan="{{ 9+count($transcript->rules) }}">Subject Wise Performance</th>
                            </tr>

                            <tr>
                                <td class="bl-w br-w" colspan="{{ 9+count($transcript->rules) }}"></td>
                            </tr>

                            <tr>
                                <th rowspan="2" style="font-size: 12px;" class="bg-white mark-header-font">Sl.</th>
                                <th rowspan="2" style="font-size: 12px; text-align: left" class="bg-white mark-header-font">Subject Code & Name </th>

                                @foreach($transcript->rules as $rule)
                                    <th rowspan="2" style="font-size: 12px" class="bg-white mark-header-font">
                                        {{ $rule->exam->code }}
                                        <br>
                                        {{ $rule->forward_mark }}%
                                    </th>
                                @endforeach

{{--                                <th class="bg-white">CW </th>--}}
                                <th style="font-size: 12px" class="bg-white mark-header-font">
                                    Full
                                    <br>
                                    Marks
{{--                                    ({{ $transcript->forward_mark }})--}}
                                </th>

                                <th style="font-size: 12px" class="bg-white mark-header-font">Weight <br> %</th>
                                <th style="font-size: 12px" class="bg-white mark-header-font">Marks <br> Obtained</th>
                                <th style="font-size: 12px" class="bg-white mark-header-font">Total <br> Marks</th>
                                <th rowspan="2" style="font-size: 12px" class="bg-white mark-header-font">Highest <br> Score</th>
                                <th rowspan="2" style="font-size: 12px" class="bg-white mark-header-font">Grade</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="bg-white mark-header-font">{{ $transcript->forward_mark }}%</th>
                                <th class="bg-white mark-header-font">{{ 100 }}%</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i=1)
                            @foreach($classSubjects as $classSubject)
                                @php($status = subjectCheck($student->id,$data->class_id,$classSubject->subject_id))
                                @if($status===true)
                                    @php($subjectTotal = 0)
                                    @php($rowSpan = 1)
                                    <tr>
                                        <td class="mark-font" rowspan="{{ $rowSpan }}">{{ $i++ }}</td>
                                        <td class="mark-font" style="text-align: left"  rowspan="{{ $rowSpan }}">{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>
                                        @php($oldTotalWeightedScore = 0)
                                        @foreach($transcript->rules as $rule)
                                            @php($oldComponents = papers($rule->exam_id, $classSubject->subject_id))
                                            @php($oldExamMark = count($oldComponents)>0? $oldComponents->sum('mark') : 0)
                                            @php($pastResult = pastResultCheck($rule->exam_id,$classSubject->subject_id,$student->id))
                                            @php($oldObtainedMark = round($pastResult->sum('mark')))
                                            @php($oldWeightedMark=weightedResult($oldObtainedMark,$oldExamMark,$rule->forward_mark))
                                            @php($oldTotalWeightedScore += $oldWeightedMark)
                                            <td class="mark-font" rowspan="{{ $rowSpan }}">
                                              {{ $oldWeightedMark }}
                                            </td>
                                            @php($subjectTotal += $oldWeightedMark)
                                        @endforeach

                                        @php($components = papers($exam->id, $classSubject->subject_id, $student->id))
                                        <td class="mark-font" rowspan="{{ $rowSpan }}" style="padding: 0">
                                            @php($innerLoop = 1)
                                            @foreach($components as $component)
                                                <table>
                                                    <tr>
                                                        <td class="mark-font" style="text-align: left ; border-left: none; border-right: none; border-top: none; {{ count($components) == $innerLoop ? 'border-bottom: none;' : '' }}">
                                                            {{ $component->code }} : {{ $component->mark }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @php($innerLoop += 1)
                                            @endforeach
                                        </td>

                                        <td rowspan="{{ $rowSpan }}" style="padding: 0">

                                            @php($innerLoop1 = 1)
                                            @foreach($components as $component)
                                                @php($data->paper_id = $component->id)
                                                @php($data->subject_id = $classSubject->subject_id)
                                                <table>
                                                    <tr>
                                                        <td class="mark-font" style="text-align: center; border-left: none; border-right: none; border-top: none; {{ count($components) == $innerLoop1 ? 'border-bottom: none;' : '' }}">
                                                            {{ $component->weight }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @php($innerLoop1 += 1)
                                            @endforeach
                                        </td>

                                        <td rowspan="{{ $rowSpan }}" style="padding: 0">
                                            @php($innerLoop2 = 1)
                                            @php($examWeightedSubjectTotal = 0)
                                            @foreach($components as $component)
                                                @php($data->paper_id = $component->id)
                                                @php($data->subject_id = $classSubject->subject_id)
                                                @php($resultForWeight = resultCheck($data,$student->id))
                                                @php($newObtainedMark = isset($resultForWeight)? round($resultForWeight->mark) : 0)
                                                @php($newWeightedMark=weightedResult($newObtainedMark,$component->mark,$component->weight))
                                                @php($examWeightedSubjectTotal += $newWeightedMark)
                                                <table>
                                                    <tr>
                                                        <td class="mark-font" style="text-align: center; border-left: none; border-right: none; border-top: none; {{ count($components) == $innerLoop2 ? 'border-bottom: none;' : '' }}">
{{--                                                           {{ $newObtainedMark }}  | {{ $newWeightedMark }}--}}
                                                           {{ $newWeightedMark }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                @php($innerLoop2 += 1)
                                            @endforeach
{{--                                            @php($transcriptWeightedSubjectMark = weightedResult($examWeightedSubjectTotal,$components->sum('mark'),$transcript->forward_mark))--}}
{{--                                            @php($subjectTotal += $transcriptWeightedSubjectMark)--}}
                                            @php($subjectTotal += round(($examWeightedSubjectTotal/100)*$transcript->forward_mark))
                                        </td>
{{--                                        <td rowspan="{{ $rowSpan }}"></td>--}}

                                        @php($subjectWeightedMark = studentTotalWeightWeightedMark($exam->id,$classSubject->subject_id,$transcript->id,$student->id,[]))
                                        <td class="mark-font" rowspan="{{ $rowSpan }}">
{{--                                            {{ $subjectWeightedMark }} || --}}

                                            {{ $subjectTotal }}
                                        </td>
                                        @php($weightTopScore = weightedTopScoreForTranscript($exam->id,$classSubject->subject_id,$transcript->id,[]))
                                        <td class="mark-font" rowspan="{{ $rowSpan }}">{{ $weightTopScore }}</td>
                                        <td class="mark-font" rowspan="{{ $rowSpan }}">{{ grade($subjectTotal) }}</td>


                                    </tr>
                                @endif
                            @endforeach


                            @php($sl=1)
                            @foreach($classSubjects as $classSubject)
                                @php($status = false)
                                @if($status===true)
                                    @php($components = papers($exam->id, $classSubject->subject_id))
                                    <tr>
                                        <td class="mark-font">{{ $sl++ }}</td>
                                        <td class="mark-font" style="text-align: left">{{ $classSubject->sub_code }} : {{ $classSubject->subject->name }}</td>

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
                                            <td class="mark-font">
                                                {{ isset($result)? $result->mark : 0 }}
                                                {{--                        <b>of</b>  {{ $component->mark }}--}}
                                            </td>
                                            @php($totalMarkObtained += isset($result)? $result->mark : 0 )
                                        @endforeach
                                        <td class="mark-font">{{ $totalMarkObtained }}</td>
                                        <td class="mark-font">{{ $totalMark }}</td>
                                        <td class="mark-font">{{ $topScore }}</td>

                                        @php($average = avearge($totalMarkObtained,$totalMark))

                                        <td class="mark-font">{{ numberFormat($average,2) }}</td>

                                        <td class="mark-font">{{ grade($average) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>

                    @endif
                </td>
            </tr>

{{--            <tr><td class="b-w"></td></tr>--}}
            <tr><th class="b-w" style="margin: 10px 0; font-size: 12px">Teacher's Evaluation</th></tr>
{{--            <tr><td class="b-w"></td></tr>--}}

            <tr>
                <td class="p-0 b-w">
                    <table>
                        <tr>
                            <th class="bg-white" colspan="2" style="font-size: 12px">Extracurricular Activities/ Skill development</th>
                        </tr>
                        <tr>
                            <td class="p-0 eca-font" style="width: 55%;">
                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($sc->items)+1 }}" style="width: 28%;">{{ $sc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($sc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 62%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 10%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($lc->items)+1 }}" style="width: 28%;">{{ $lc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($lc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 62%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 10%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($tic->items)+1 }}" style="width: 28%;">{{ $tic->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($tic->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 62%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 10%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n bb-n eca-font" rowspan="{{ count($sic->items)+1 }}" style="width: 28%;">{{ $sic->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($sic->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l {{ $loopCount==count($sic->items)?'bb-n':'' }} eca-font" style="width: 62%;">{{ $item->name }}</td>
                                            <td class="{{ $loopCount==count($sic->items)?'bb-n':'-' }} eca-font" style="width: 10%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>
                            </td>

                            <td class="p-0" style="width: 45%">
                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($cpac->items)+2 }}" style="width: 30%;">{{ $cpac->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($cpac->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 58%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 12%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($csc->items)+1 }}" style="width: 30%;">{{ $csc->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($csc->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 58%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 12%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n eca-font" rowspan="{{ count($ac->items)+1 }}" style="width: 30%;">{{ $ac->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($ac->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l eca-font" style="width: 58%;">{{ $item->name }}</td>
                                            <td class="eca-font" style="width: 12%;">{{ isset($activity)? $activity->grade : '-' }}</td>
                                        </tr>
                                        @php($loopCount++)
                                    @endforeach
                                </table>

                                <table class="clubs">
                                    <tr>
                                        <td class="txt-l bl-n bb-n eca-font" rowspan="{{ count($olmp->items)+1 }}" style="width: 30%;">{{ $olmp->name }}</td>
                                    </tr>
                                    @php($loopCount = 1)
                                    @foreach($olmp->items as $item)
                                        @php($activity = ecaActivity($student->id,$exam->id,$item->id))
                                        <tr>
                                            <td class="txt-l {{ $loopCount==count($olmp->items)?'bb-n':'' }} eca-font" style="width: 58%;">{{ $item->name }}</td>
                                            <td class="{{ $loopCount==count($olmp->items)?'bb-n':'' }} pt-0 pb-0 eca-font" style="width: 12%;">
                                                {{ isset($activity)? $activity->grade : '-' }}
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
{{--            <tr><td class="b-w"></td></tr>--}}
            @if($exam->comment!='n')
                <tr>
                    <td class="p-0 b-w">
                        <table  style="margin-top: 2px">
                            <tr>
                                <th class="b-w txt-l comment-font">Class Teacher's Comment: </th>
                            </tr>
                            <tr>
                                <td class="b-w p-0 comment-font" style="text-align: justify;">
                                    {!! isset($comment) ? $comment->comment : '' !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif

            @if($exam->need_promo_status==1)
                <tr>
                    <td class="p-0 b-w">
                        <table  style="margin-top: 2px">
                            <tr>
                                <td class="b-w txt-l" style="font-size: 13px"><strong>Promotional Status:</strong> This is to state that <strong>{{ $student->name }}</strong> has been promoted to <strong>{{ $meta['promoted_class_name'] }}</strong> based on academic performance and overall progress</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif
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
                    <img style="max-height: 50px; margin-bottom: -10px" src="{{ asset($principalSign) }}" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <th style="font-size: 11px">&nbsp;&nbsp;&nbsp;Class Teacher&nbsp;&nbsp;&nbsp;</th>
            <th style="font-size: 11px">&nbsp;&nbsp;&nbsp;Vice Principal&nbsp;&nbsp;&nbsp;</th>
            <th style="font-size: 11px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Principal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
        // window.print()
    </script>
</div>
</body>
</html>
