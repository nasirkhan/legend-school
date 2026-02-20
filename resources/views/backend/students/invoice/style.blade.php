<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    @page {
        size: A4;
        margin: 1.5cm;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0 auto;
        /*padding-top: 1.5cm;*/
        padding: 1.5cm 1.0cm;
        width: 19cm;
        /*width: 18cm;*/
        /*height: 29.7cm;*/
        height: 31.7cm;
        /*height: 28.2cm;*/
        border: 1pt solid #000;
    }

    .b-none{
        border: none !important;
    }
    .b-x-none{
        border-left: none !important;
        border-right: none !important;
    }

    .b-l-none{border-left: none !important;}
    .b-r-none{border-right: none !important;}

    .b-y-none{
        border-top: none !important;
        border-bottom: none !important;
    }

    .b-t-none{border-top: none !important;}
    .b-b-none{border-bottom: none !important;}



    .f-w-bold{
        font-weight: bold;
    }
    .mt-50{
        margin-top: 50pt;
    }

    .invoice-page {
        width: 100%;
        page-break-inside: avoid;
    }

    .header, .footer {
        text-align: center;
        margin-bottom: 10pt;
    }

    .header {
        position: relative;
    }

    .logo {
        float: left;
        width: 100pt;
        position: absolute;
        top: 0;
        left: 0;
    }

    .header-title {
        font-size: 12pt;
        font-weight: bold;
        margin-top: 0;
    }

    .address{
        font-size: 10pt;
        margin: 0;
        margin-top: 3pt;
    }

    .copy-type {
        font-size: 10pt;
        font-weight: bold;
        margin-top: 10pt;
        text-align: right;
        position: absolute;
        top: 0;
        right: 0;
        border: 1pt solid #000;
        padding: 5pt;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5pt;
        margin-bottom: 10pt;
    }

    .invoice-table th, .invoice-table td {
        border: 1pt solid #000;
        padding: 3pt 4pt;
        font-size: 10pt;
        text-align: left;
    }

    .footer {
        border-top: 1pt dashed #000;
        font-size: 9pt;
        margin-top: 10pt;
        padding-top: 5pt;
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    .part {
        margin-bottom: 20pt;
        position: relative;
    }

    .part:last-child {
        margin-bottom: 0;
    }

    .text-right{
        text-align: right !important;
    }

    .text-center{
        text-align: center !important;
    }

    .text-uppercase{
        text-transform: uppercase !important;
    }

    @media print {
        .no-print {
            display: none;
        }

        body{
            padding: 0;
            /*width: 21cm;*/
            width: 20cm;
            /*height: 29.7cm;*/
            height: 29.5cm;
            border: none;
        }

        .header, .footer {
            margin-bottom: 10pt;
        }

        .logo {
            width: 120pt;
            margin-top: -2pt;
        }

        .header-title {
            font-size: 12pt;
        }

        .address{
            font-size: 10pt;
        }

        .copy-type {
            font-size: 10pt;
        }

        .invoice-table th, .invoice-table td {
            font-size: 10pt;
        }

        .footer {
            font-size: 9pt;
        }
    }
</style>
