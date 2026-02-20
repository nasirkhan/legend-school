<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title','Student Exam Report Card')
    </title>

    @include('backend.exams.report-card.includes.style')
</head>
<body>
<div class="page">
    @include('sweetalert::alert')
    <!-- Header Section -->
    <header>
        @include('backend.exams.report-card.includes.logo')
        <h3 style="text-transform: uppercase">@yield('exam-name','Unknown')</h3>
        <h3 style="font-size: 18px">SESSION: @yield('session')</h3>
    </header>

    <!-- Table Section -->

    <main class="main">
        <table>
            <tr>
                <td class="b-w p-0">
                    @include('backend.exams.report-card.includes.student-info')
                </td>
            </tr>

            <tr>
                <td class="b-w p-0">
                    @include('backend.exams.report-card.includes.senior-academic-report')
                </td>
            </tr>

            @yield('teachers-evaluation')
        </table>


    </main>

    @yield('signature')

    <div class="print-control">
        <a href="{{ route('student-report-card-print',[
    'student_id'=>$student->id, 'exam_id'=>$data->exam_id, 'class_id'=>$data->class_id,'year'=>$data->year
]) }}"> Print </a>
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
</div>
</body>
</html>
