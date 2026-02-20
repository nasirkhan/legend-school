<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
          integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
          crossorigin="anonymous"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
    </script>
    <title>{{ $hw->student->name }}-{{ $hw->hw->title }}</title>
    <script src="{{ asset('assets/plugins/pdfjs/build/pdf.js') }}"></script>
    <!--    Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    @include('annotation.includes.css')
</head>
<body>
@if(Session::get('teacherId'))
    @include('annotation.includes.teacher-menu')
@elseif(Session::get('studentId'))
    @include('annotation.includes.student-menu')
@endif

<div class="canvasWrapper">
    <canvas id="canvas"></canvas>
    <canvas id="annotation"></canvas>
</div>

@include('backend.includes.loader')
@include('annotation.includes.js')
</body>
</html>

