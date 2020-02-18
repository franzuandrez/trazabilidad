<html lang="es">
<head>
    @include('reportes.parcials.pdf.head')
    <style>
        .table-headers{
            width: 90%;
        }
        .table-headers{
            margin-left: 0;
            margin-top: 0;
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
