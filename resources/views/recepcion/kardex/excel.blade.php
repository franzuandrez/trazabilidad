<html>
<head>

</head>
<body style="width: auto; height: auto;">
<table style=" border-collapse: collapse;">
    <thead>
    <td colspan="1"><img src="img/empresa.png"></td>
    <td width="25"></td>
    <tr>
    </tr>
    <tr>
        <td style="border: 1px solid #000" colspan="4" align="center"><b>EXISTENCIAS</b></td>
    </tr>
    <tr>
        <td style="border: 1px solid #000"><strong>Fecha </strong></td>
        <td style="border: 1px solid #000" colspan="3">{{\Carbon\Carbon::now()}}</td>
    </tr>
    </thead>
</table>
<table style=" border-collapse: collapse;">


    <thead>
    <tr style="border: 1px solid #000">
        <th width="20" style="border: 1px solid #000">BODEGA</th>
        <th width="35" style="border: 1px solid #000">PRODUCTO</th>
        <th width="20" style="border: 1px solid #000">LOTE</th>
        <th width="20" style="border: 1px solid #000">CANTIDAD</th>
    </tr>
    </thead>
    <tbody>


    @foreach($collection as $producto)
        <tr>
            <td style="border: 1px solid #000000">
                @if($producto->ubicacion == 0)
                    BODEGA TRANSITO
                @else
                    {{$producto->bodega}}
                @endif
            </td>
            <td style="border: 1px solid #000000">
                {{$producto->producto}}
            </td>
            <td style="border: 1px solid #000000">
                {{$producto->lote}}
            </td>
            <td style="border: 1px solid #000000">
                {{$producto->total}}
            </td>
        </tr>
    @endforeach


    </tbody>
</table>
</body>
</html>
