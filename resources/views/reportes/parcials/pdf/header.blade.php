<table>
    <tr>
        <th class="title" colspan="2">{{ strtoupper($reporte_encabezado->getTitle()) }}</th>
        <th>{{$reporte_encabezado->getCreatedAt()->format('d/m/Y H:i:s')}}</th>
    </tr>
    @foreach( $reporte_encabezado->getHeader() as $header )
        @if($header!=null)
            <tr>
                <td  class="field">{{$header->field}}</td>
                <td  class="value" colspan="2">{{$header->value}}</td>
            </tr>
        @endif
    @endforeach
</table>
