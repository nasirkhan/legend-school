<style>
    *{box-sizing: border-box;}
    /* Set A4 page size and print margins */
    @page {
        size: A4 landscape;
        margin: 2.5cm;
    }

    body {
        font-family: Arial, sans-serif;
        /*height: 29.7cm;*/
        width: 29.7cm;
        /*width: 21cm;*/
        height: 21cm;
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
        /*right: 1.0cm;*/
        left:1.0cm;
        top: 1.0cm;
    }

    h1 {
        font-size: 24px;
        margin: 0;
    }

    h3{
        font-size: 16px;
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
        width: 93%;
        position: absolute;
        top: 2.8cm;
        left: 50%;
        transform: translateX(-50%);
        /*border: 1px solid red;*/
    }

    .signature{
        width: 30%;
        position: absolute;
        bottom: 2.0cm;
        left: 3.5%;
        /*left: 50%;*/
        /*transform: translateX(-50%);*/
        padding-left: 1.0cm ;
    }

    .signature th{
        /*border: 1px solid #ffffff;*/
        background-color: #ffffff;
        text-align: left;
        /*width: 30%;*/
        padding-top: 10px ;
        padding-bottom: 10px ;
        /*text-decoration: overline;*/
    }

    /* Footer */
    footer {
        text-align: center;
        font-size: 12px;
        margin-top: 20px;
        padding: 10px 0;
        /*border-top: 1px solid #000;*/
    }

    .bg-white{ background-color: white;}
    .b-w{border-color: white}
    .bl-w{border-left-color: white}
    .br-w{border-right-color: white}
    .bt-w{border-top-color: white}
    .bb-w{border-bottom-color: white}
    .b-n{border:none}

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

    .print-control .back{
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
    @media print {
        .print-control{
            display: none;
        }
    }
</style>
