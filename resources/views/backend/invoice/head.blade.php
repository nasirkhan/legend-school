<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title-tag')</title>
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/invoice/styles.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/invoice/style.css')}}">
    <style>
        .table tbody tr td, .table tr th, .table tr td{
            padding-top: 0.75em;
            padding-bottom: 0.75em;
            color: #000000 !important;
        }
        .text-dark{
            color: #000000;
        }

        @page {
            size: A4;
            margin: .5in;
        }

        @media only screen {
            table.paging>thead, table.paging>tfoot {
                display: none;
            }
        }

        @media print {
            .title {
                /*margin-top: 15mm;*/
                margin-top: -5mm;
            }

            table.paging thead td {
                height: 1.2in;
                display: block;
            }
            table.paging tfoot td {
                height: 0.5in;
                display: block;
            }
        }

        footer {
            width: 100%;
            height: .5in;
        }

        header {
            width: 100%;
            height: unset;
        }

        @media print {
            header{
                position: fixed;
                top: 0;
                left: 50%;
                transform: translateX(-50%);
                z-index: 99999;
            }
            footer {
                position: fixed;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
</head>
<body>
