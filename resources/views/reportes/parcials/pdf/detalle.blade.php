@foreach( $reporte_detalle['details'] as  $key=> $detail)
    <table class="table-detalle">
        <tr>
            <th class="table-name"  colspan="{{ $detail['headers']->count()}}">{{$key}}</th>
        </tr>
        <tr>
            @foreach( $detail['headers'] as  $header)
                <th class="">{{$header}}</th>
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
@include('reportes.parcials.pdf.footer')
