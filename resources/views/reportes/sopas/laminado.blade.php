<html lang="es">
<head>
    @include('reportes.parcials.pdf.head')
    <style>
        .table-headers {
            width: 90%;
        }

        .table-headers {
            margin-left: 0;
            margin-top: 0;
        }

        .table-detalle th, .table-detalle td {
            font-size: 8px;
        }

        .table-name {
            font-size: 10px;
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
