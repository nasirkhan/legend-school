<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OFFICIAL SCHOOL TRANSCRIPT || {{ $student->name }}</title>
    @include('backend.school-transcript.transcript-style')
</head>
<body>
<div class="page">
    @include('sweetalert::alert')
    <!-- Header Section -->
    <header>
        <img src="{{ asset(siteInfo('logo')) }}" alt="School Logo" class="logo">
        <h3 style="text-transform: uppercase">Grade: {{ 'XI-XII' }}</h3>
        <h3 style="">SESSION: {{ $student->year }} - {{ $student->year+1 }}</h3>
    </header>

    <!-- Table Section -->

    <main class="main">
        <table>
            <tr>
                <td class="b-w p-0">
                    <table class="student-info">
                        <thead style="text-align: left">
                        <tr>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Candidate Name: </b>
                                {{ $student->name }}
                            </td>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Candidate Number: </b>
                                {{ $student->candidate_no }}
                            </td>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Date of Birth: </b>
                                {{ dateFormat($student->date_of_birth,'jS-M-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Date of Admission to School: </b>
                                {{ dateFormat($student->date_of_admission,'jS-M-Y') }}
                            </td>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Date of Graduation: </b>
                                {{ dateFormat($student->date_of_graduation,'jS-M-Y') }}
                            </td>
                            <td class="txt-l b-w" style="width: 33.33%;">
                                <b>Nationality: </b>
                                {{ $student->nationality }}
                            </td>
                        </tr>
                        </thead>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="b-w p-0">
                    <table>
                        <tr>
                            <td class="p-0 b-n" style="width: 63%">

                                @yield('school-record')

                            </td>
                            <td class="b-n" style="width: 0.5%"></td>
                            <td class="p-0 b-n" style="width: 36.5%">

                                @yield('cambridge-result')

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="b-n">&nbsp;</td>
            </tr>

            <tr>
                <td class="b-n p-0">
                    <table class="report-card" style="font-weight: bold">
                        <tr>
                            <td class="txt-l">Grade Scale</td>
                            <td>A*=90-100/A=80-89</td>
                            <td>B=70-79</td>
                            <td>C=60-69</td>
                            <td>D=50-59</td>
                            <td>E=40-49</td>
                            <td>U=Below 40</td>
                        </tr>
                        <tr>
                            <td class="txt-l">Grade Point</td>
                            <td>A*/A=4.0</td>
                            <td>B=3.5</td>
                            <td>C=3.0</td>
                            <td>D=2.5</td>
                            <td>E=2.0</td>
                            <td>U=0</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="b-n">&nbsp;</td>
            </tr>

            @yield('gpa')

            <tr>
                <td class="b-n p-0">
                    <p style="text-align: justify; font-size: 13px; ">
                        All Ordinary and Advanced Level examinations were conducted under the Cambridge International Examinations (CIE), a UK-based examination board. However, starting from September 2024, CIE has changed its name to Cambridge Assessment International Education (CAIE).
                    </p>
                </td>
            </tr>
        </table>
    </main>

    @yield('signature')

    <div class="print-control">
        @yield('print-button')
    </div>

    <!-- Footer Section -->
    <footer>
        <p style="border-top: 1px solid black; padding-top: 10px">{{ siteInfo('address') }}
            Ph: {{ siteInfo('mobile') }}
            Email- {{ siteInfo('email') }}.
            Web: {{ 'www.legend.edu.bd' }}
        </p>
    </footer>
</div>
</body>
</html>
