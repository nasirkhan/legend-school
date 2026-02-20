<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $exam->name }} : {{ $student->name }}</title>

    @include('backend.exams.report-card.includes.style')
</head>
<body>
<div class="page">
    @include('sweetalert::alert')
    <!-- Header Section -->
    <header>
        <img src="{{ asset(siteInfo('logo')) }}" alt="School Logo" class="logo">
        <h3 style="text-transform: uppercase">{{ $exam->name }}</h3>
        <h3 style="font-size: 18px">SESSION: {{ $exam->year }} - {{ $exam->year+1 }}</h3>
    </header>

    <!-- Table Section -->

    <main class="main">
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
                            <td colspan="2" style="text-align: left"><b>Parent-Teacher Meeting(PTM):</b> 1</td>
                            <td style="text-align: left"><b>Attended:</b> 1</td>
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
                        @include('backend.exams.report-card.includes.senior-academic-report')
                    @endif
                </td>
            </tr>

            <tr><td class="b-w"></td></tr>
            <tr><th class="b-w" style="margin: 10px 0; font-size: 13px">Teacher's Evaluation</th></tr>
            <tr><td class="b-w"></td></tr>

            <tr>
                <td class="p-0 b-w">
                    <table>
                        <tr>
                            <th class="bg-white" colspan="2" style="font-size: 13px">Extracurricular Activities/ Skill development</th>
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
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="" style="width: 10%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="{{ $loopCount==count($sic->items)?'bb-n':'-' }}" style="width: 10%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
                                            <td class="" style="width: 12%">{{ isset($activity)? $activity->grade : '-' }}</td>
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
            <tr><td class="b-w"></td></tr>
            @if($exam->comment!='n')
            <tr>
                <td class="p-0 b-w">
                    <table  style="margin-top: 2px">
                        <tr>
                            <th class="b-w txt-l" style="font-size: 13px">Class Teacher's Comment: </th>
                        </tr>
                        <tr>
                            <td class="b-w p-0" style="text-align: justify;">
                                {!! isset($comment) ? $comment->comment : '' !!}
                            </td>
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
