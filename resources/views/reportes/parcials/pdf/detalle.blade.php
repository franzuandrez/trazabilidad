@foreach( $reporte_detalle['details'] as  $key=> $detail)
    <table>
        <tr>
            <th colspan="{{ $detail['headers']->count()}}">{{$key}}</th>
        </tr>
        <tr>
            @foreach( $detail['headers'] as  $header)
                <th>{{$header}}</th>
            @endforeach
        </tr>
        @foreach( $detail['detail'] as  $det)
            <tr>
                @foreach( $det as $row)
                    <td>{{$row}}</td>
                @endforeach
            </tr>
        @endforeach

    </table>
@endforeach
