<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Annotator</title>
    <style>
        canvas {
            border: 1px solid black;
        }
        #toolbar {
            margin: 10px;
        }
    </style>
{{--    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>--}}
    <script src="{{ asset('assets/plugins/pdfjs/build/pdf.js') }}"></script>
</head>
<body>

<div id="toolbar">
    <button id="clear">Clear Annotations</button>
    <label for="color">Select Color: </label>
    <input type="color" id="color" value="#FF0000">
    <label for="size">Brush Size: </label>
    <input type="range" id="size" min="1" max="10" value="3">
</div>

<canvas id="pdf-render"></canvas>

{{--<script src="annotate.js"></script>--}}
@include('backend.pdf.annotate')
</body>
</html>
