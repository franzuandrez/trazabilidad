@if($tipo_documento =='REQUISICION')
    <a
        target="_blank"
        href=" {{url('produccion/requisiciones/reporte/documento/'.$documento)}}">
        {{$documento}}
    </a>
@elseif($tipo_documento=='RECEPCION')
    <a
        target="_blank"
        href=" {{url('recepcion/materia_prima/reporte/documento/'.$documento)}}">
        {{$documento}}
    </a>
@elseif($tipo_documento=='DESPACHO')
    <a
        target="_blank"
        href=" {{url('produccion/requisiciones/reporte/'.$documento)}}">
        {{$documento}}
    </a>
@elseif($tipo_documento=='TRAZABILIDAD')
    <a
        target="_blank"
        href=" {{url('/produccion/trazabilidad_chao_mein/reporte/'.$documento)}}">
        {{$documento}}
    </a>
@endif
