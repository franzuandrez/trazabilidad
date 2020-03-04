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
@foreach( $reporte_detalle['headers']  as $key=> $header )
    @if (!$loop->first)
        <table class="table-headers">
            <tr>
                <th colspan="2" class="table-name">
                    {{$key}}
                </th>
            </tr>
            @foreach( $header as $h )
                @if($h!=null)
                    @if($h->value!="" && $h->value!=null)
                        <tr>
                            <th class="field">{{$h->field}}</th>
                            @if($h->value=="0")
                                <td>NO</td>
                            @elseif($h->value == "1")
                                <td>SI</td>
                            @else
                                <td>{{$h->value}}</td>
                            @endif

                        </tr>
                    @endif
                @endif
            @endforeach
        </table>
        <br>
    @endif
@endforeach

<br>


</body>
</html>
