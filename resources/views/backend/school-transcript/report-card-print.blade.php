<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Exam Report Card</title>
{{--    <style>--}}
{{--        *{box-sizing: border-box;}--}}
{{--        /* Set A4 page size and print margins */--}}
{{--        @page {--}}
{{--            size: A4;--}}
{{--            margin: 2.5cm;--}}
{{--        }--}}

{{--        body {--}}
{{--            font-family: Arial, sans-serif;--}}
{{--            height: 29.7cm;--}}
{{--            width: 21cm;--}}
{{--            margin: 0 auto;--}}
{{--            padding: 0;--}}
{{--            background: #fff;--}}
{{--            border: 1px solid #aaaaaa;--}}

{{--        }--}}

{{--        .page {--}}
{{--            width: 100%;--}}
{{--            height: 100%;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            justify-content: space-between;--}}
{{--            padding:1.0cm 1.0cm 0;--}}
{{--            box-sizing: border-box;--}}
{{--            position: relative;--}}
{{--        }--}}

{{--        /* Header */--}}
{{--        header {--}}
{{--            text-align: center;--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}

{{--        .logo {--}}
{{--            height: 60px;--}}
{{--            width: auto;--}}
{{--            position: absolute;--}}
{{--            right: 1.0cm;--}}
{{--            top: 1.0cm;--}}
{{--        }--}}

{{--        h1 {--}}
{{--            font-size: 24px;--}}
{{--            margin: 0;--}}
{{--        }--}}

{{--        /* Table styling */--}}
{{--        table {--}}
{{--            width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--            /*margin-bottom: 20px;*/--}}
{{--        }--}}

{{--        th, td {--}}
{{--            border: 1px solid #000;--}}
{{--            padding: 5px;--}}
{{--            text-align: center;--}}
{{--            font-size: 14px;--}}
{{--        }--}}

{{--        th {--}}
{{--            background-color: #f4f4f4;--}}
{{--        }--}}

{{--        /*main{*/--}}
{{--        /*    position: relative;*/--}}
{{--        /*}*/--}}

{{--        .student-info{--}}

{{--        }--}}

{{--        .student-info th{--}}
{{--            background-color: white;--}}
{{--        }--}}

{{--        .main{--}}
{{--            width: 90.5%;--}}
{{--            position: absolute;--}}
{{--            top: 3.2cm;--}}
{{--            /*left: 0;*/--}}
{{--            /*padding-left: 1.0cm ;*/--}}
{{--        }--}}

{{--        .signature{--}}
{{--            width: 90.5%;--}}
{{--            position: absolute;--}}
{{--            bottom: 1.2cm;--}}
{{--            /*left: 0;*/--}}
{{--            padding-left: 1.0cm ;--}}
{{--        }--}}

{{--        .signature th{--}}
{{--            border: 1px solid #ffffff;--}}
{{--            background-color: #ffffff;--}}
{{--            text-align: center;--}}
{{--            width: 33%;--}}
{{--            text-decoration: overline;--}}
{{--        }--}}

{{--        /* Footer */--}}
{{--        footer {--}}
{{--            text-align: center;--}}
{{--            font-size: 12px;--}}
{{--            margin-top: 20px;--}}
{{--            padding: 10px 0;--}}
{{--            border-top: 1px solid #000;--}}
{{--        }--}}

{{--        .bg-white{ background-color: white;}--}}
{{--        .b-w{border-color: white}--}}
{{--        .bl-w{border-left-color: white}--}}
{{--        .br-w{border-right-color: white}--}}
{{--        .bt-w{border-top-color: white}--}}
{{--        .bb-w{border-bottom-color: white}--}}

{{--        .p-0{padding: 0;}--}}
{{--        .txt-l{text-align: left;}--}}
{{--        .txt-r{text-align: right;}--}}
{{--        .txt-c{text-align: center;}--}}

{{--        .report-card th{font-size: 13px}--}}
{{--        .report-card td{font-size: 13px}--}}

{{--        .clubs{--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}
{{--        .clubs td{--}}
{{--            font-size: 12px;--}}
{{--            padding-top: 2px;--}}
{{--            padding-bottom: 2px;--}}
{{--            border-top: none;--}}
{{--            border-right: none;--}}
{{--        }--}}

{{--        .clubs td input{ font-size: 12px; }--}}

{{--        .bt-n{border-top: none}--}}
{{--        .bb-n{border-bottom: none}--}}
{{--        .bl-n{border-left: none}--}}
{{--        .br-n{border-right: none}--}}
{{--        .b-n{border:none}--}}

{{--        .print-control{--}}
{{--            position: fixed;--}}
{{--            right: 10px;--}}
{{--            top: 10px;--}}
{{--            border: 1px solid black;--}}
{{--            padding: 10px;--}}
{{--            padding-bottom: 5px;--}}
{{--        }--}}

{{--        .print-control button{--}}
{{--            font-size: 15px;--}}
{{--            display: block;--}}
{{--            width: 100px;--}}
{{--            border-radius: 0;--}}
{{--            font-weight: bold;--}}
{{--            margin-bottom: 5px;--}}
{{--            background-color: #444444;--}}
{{--            color: white;--}}
{{--            text-align: center;--}}
{{--            padding: 10px;--}}
{{--        }--}}

{{--        .print-control a{--}}
{{--            font-size: 15px;--}}
{{--            display: block;--}}
{{--            width: 100px;--}}
{{--            border-radius: 0;--}}
{{--            font-weight: bold;--}}
{{--            margin-bottom: 5px;--}}
{{--            text-decoration: none;--}}
{{--            background-color: navy;--}}
{{--            color: white;--}}
{{--            text-align: center;--}}
{{--            padding: 10px;--}}
{{--        }--}}
{{--        @media print{--}}
{{--            .print-control{--}}
{{--                display: none;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
    <style>
        *{box-sizing: border-box;}
        /* Set A4 page size and print margins */
        @page {
            size: A4;
            margin: 2.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            height: 29.7cm;
            width: 21cm;
            margin: 0 auto;
            padding: 0;
            background: #fff;
            border: 1px solid #aaaaaa;
        }

        .page {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding:1.0cm 1.0cm 0;
            box-sizing: border-box;
            position: relative;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            height: 60px;
            width: auto;
            position: absolute;
            right: 1.0cm;
            top: 1.0cm;
        }

        h1 {
            font-size: 24px;
            margin: 0;
        }

        h3{
            margin-top: 10px;
            margin-bottom: 0;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            /*margin-bottom: 20px;*/
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #f4f4f4;
        }

        /*main{*/
        /*    position: relative;*/
        /*}*/

        .student-info{

        }

        .student-info td{
            padding-top: 3px;
            padding-bottom: 3px;
        }

        .main{
            width: 90.5%;
            position: absolute;
            top: 2.8cm;
            /*left: 0;*/
            /*padding-left: 1.0cm ;*/
        }

        .signature{
            width: 90.5%;
            position: absolute;
            bottom: 1.2cm;
            /*left: 0;*/
            padding-left: 1.0cm ;
        }

        .signature th{
            border: 1px solid #ffffff;
            background-color: #ffffff;
            text-align: center;
            width: 33%;
            text-decoration: overline;
        }

        /* Footer */
        footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            padding: 10px 0;
            border-top: 1px solid #000;
        }

        .bg-white{ background-color: white;}
        .b-w{border-color: white}
        .bl-w{border-left-color: white}
        .br-w{border-right-color: white}
        .bt-w{border-top-color: white}
        .bb-w{border-bottom-color: white}

        .p-0{padding: 0;}
        .txt-l{text-align: left;}
        .txt-r{text-align: right;}
        .txt-c{text-align: center;}

        .report-card th{font-size: 13px; padding-top: 3px; padding-bottom: 2px}
        .report-card td{font-size: 13px; padding-top: 3px; padding-bottom: 2px}

        .clubs{
            box-sizing: border-box;
        }
        .clubs td{
            font-size: 12px;
            padding-top: 2px;
            padding-bottom: 2px;
            border-top: none;
            border-right: none;
        }

        .clubs td input{ font-size: 12px; }

        .bt-n{border-top: none}
        .bb-n{border-bottom: none}
        .bl-n{border-left: none}
        .br-n{border-right: none}
        .b-n{border:none}

        .print-control{
            position: fixed;
            right: 10px;
            top: 10px;
            border: 1px solid black;
            padding: 10px;
            padding-bottom: 5px;
        }

        .print-control button{
            font-size: 15px;
            display: block;
            width: 100px;
            border-radius: 0;
            font-weight: bold;
            margin-bottom: 5px;
            background-color: #444444;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .print-control a{
            font-size: 15px;
            display: block;
            width: 100px;
            border-radius: 0;
            font-weight: bold;
            margin-bottom: 5px;
            text-decoration: none;
            background-color: navy;
            color: white;
            text-align: center;
            padding: 10px;
        }

        @media print{
            .print-control{
                display: none;
            }
        }
    </style>
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
                    <table class="report-card">
                        <thead>
                        <tr>
                            <td class="b-w" colspan="{{ count($components)+5 }}"></td>
                        </tr>
                        <tr>
                            <th class="b-w" colspan="{{ count($components)+5 }}">Subject Wise Performance</th>
                        </tr>

                        <tr>
                            <td class="bl-w br-w" colspan="{{ count($components)+5 }}"></td>
                        </tr>

                        <tr>
                            <th class="bg-white" rowspan="2">Sl.</th>
                            <th class="bg-white" rowspan="2" style="text-align: left">Subject Name & Code</th>
                            <th class="bg-white" colspan="{{ count($components) }}">{{ $exam->name }}</th>
                            <th class="bg-white" rowspan="2">Total({{ $totalMark = $components->sum('mark') }})</th>
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
                                <td>{{ $average = avearge($totalMarkObtained,$totalMark,2) }}</td>
                                <td>{{ grade($average) }}</td>
                            </tr>
                            @php($studentTotalMark += $totalMarkObtained)
                                @endforeach
                                <tr>
                                    <th class="bg-white" colspan="{{ count($components)+2 }}">Combined Result</th>
                                    <th class="bg-white">{{ numberFormat($studentTotalMark,2) }}</th>
                                    <th class="bg-white">{{ $average = avearge($studentTotalMark,$examTotalMark,2) }}</th>
                                    <th class="bg-white">{{ grade($average) }}</th>
                                </tr>
                        </tbody>
                    </table>
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
