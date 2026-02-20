<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Report : {{ $student->name }}</title>
    @include('backend.students.invoice.style')
</head>
<body>

<div class="invoice-page">

    <!-- Part 1: Student Copy -->
    <div class="part">
        @include('backend.students.invoice.header')

        <div class="copy-type">Student's Copy</div>

        @include('backend.students.invoice.report-body')

        @include('backend.students.invoice.footer')
    </div>

{{--    <!-- Part 2: School Copy -->--}}
    <div class="part mt-50">
        @include('backend.students.invoice.header')

        <div class="copy-type">School's Copy</div>

        @include('backend.students.invoice.report-body')

        @include('backend.students.invoice.footer')
    </div>

    <!-- Part 3: Bank Copy -->
{{--    <div class="part mt-50">--}}
{{--        @include('backend.students.invoice.header')--}}

{{--        <div class="copy-type">Bank's Copy</div>--}}

{{--        @include('backend.students.invoice.body')--}}

{{--        @include('backend.students.invoice.footer')--}}
{{--    </div>--}}
</div>

<div class="no-print" style="text-align:center; margin: 20px; position: fixed; right: 0; top: 20px;">
    <button style="border: 1px solid gray; border-radius: 1px; display:inline-block; height: 40px; width: 60px; font-size: 15px" onclick="window.print()"> Print </button> <br>
    <a style="padding: 10px 10px; display:inline-block; height: 40px; width: 60px; background-color: deepskyblue; border: 1px solid gray; border-radius: 1px; color: #FFFFFF; font-size: 15px; text-decoration: none" href="{{ url()->previous() }}">Back</a>
{{--    <br>--}}
{{--    <button style="border: 1px solid gray; border-radius: 1px; display:inline-block; height: 40px; width: 60px; background-color: indianred; color: #FFFFFF; font-size: 15px" onclick="window.close"> Close </button>--}}
</div>

@include('backend.students.invoice.script')

</body>
</html>
