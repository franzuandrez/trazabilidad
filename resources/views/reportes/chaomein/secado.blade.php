<html lang="es">
<head>

    <style>
        body{
            font-size: 12px;
        }
        .table-header,.table-detalle{
            width: 100%;
        }
        .table-header td,.table-header th,.table-detalle td,.table-detalle th {
            border: 1px solid #000000;

        }
        .title{
            font-size: 15px;
        }
        table{
            border-collapse: collapse;
            border-spacing: 2;
            margin-bottom: 5px;
            font-family: "Century Gothic";
        }
        table th {
            font-family: "Century Gothic";
            font-size: 10px;
            padding: 4px;
            color: #000;
            border: 1px solid #000;
            white-space: normal;
            font-weight: lighter;
            border-collapse: collapse;
            background-color: #fff;
            font-weight: bold;
        }
        .empresa {
            font-size: 20px;
            width: 150px;
        }
    </style>
</head>


<body>
@include('reportes.parcials.pdf.header')

<br>
@include('reportes.parcials.pdf.detalle')
<br>


</body>
</html>
