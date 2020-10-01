<br>
<br>
<br>
@if(count($reporte_encabezado->getFirmas())>0 )
    <table style=" border: none;">
        @foreach($reporte_encabezado->getFirmas() as $key=>$value)
            <tr style=" border: none;">
                <td style=" border: none;"><b>{{$key}}</b></td>
                <td style=" border: none;">F_______________________</td>
            </tr>
            <tr style=" border: none;">
                <td style=" border: none;"></td>
                <td style=" border: none;">{{$value}}</td>
            </tr>
            <tr>
                <td style=" border: none;">&nbsp;</td>
                <td style=" border: none;">&nbsp;</td>
            </tr>
            <tr>
                <td style=" border: none;">&nbsp;</td>
                <td style=" border: none;">&nbsp;</td>
            </tr>
        @endforeach

    </table>
@endif
