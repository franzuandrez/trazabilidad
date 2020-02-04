@foreach( $reporte_detalle['details'] as  $key=> $detail)
    <table class="table-detalle">
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
                    <td>
                        @if($row==="1")
                            SI
                        @elseif($row==="0")
                            NO
                        @else
                            {{$row}}
                        @endif

                    </td>
                @endforeach
            </tr>
        @endforeach

    </table>
    <br>
@endforeach
