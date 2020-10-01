<html>
<head>

</head>
<body style="width: auto; height: auto;">
<table style=" border-collapse: collapse;">
    @php
        $max_width = count($tipos_movimiento) + 6;
    @endphp
    <thead>
    <td colspan="1"><img src="img/empresa.png"></td>
    <td width="25"></td>
    <tr>
    </tr>
    <tr>
        <td style="border: 1px solid #000" colspan="{{$max_width}}" align="center"><b>EXISTENCIAS</b>
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid #000"><strong>GENERADO </strong></td>
        <td style="border: 1px solid #000"
            colspan="{{$max_width -1}}">{{\Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #000"><strong>USUARIO</strong></td>
        <td style="border: 1px solid #000" colspan="{{$max_width-1}}">{{\Auth::user()->nombre}}</td>
    </tr>
    @if($parametros->start != null && $parametros->end != null)
        <tr>
            <td style="border: 1px solid #000"><strong>FECHA</strong></td>
            <td style="border: 1px solid #000" colspan="{{$max_width-1}}">
                {{\Carbon\Carbon::createFromFormat('Y-m-d',$parametros->start)->format('d/m/Y')}}
                -
                {{\Carbon\Carbon::createFromFormat('Y-m-d',$parametros->end)->format('d/m/Y')}}
            </td>
        </tr>
    @endif

    @if($parametros->id_select_search!=null)
        @if($parametros->id_select_search==0)
            <tr>
                <td style="border: 1px solid #000"><strong>BODEGA</strong></td>
                <td style="border: 1px solid #000" colspan="{{$max_width-1}}">TRANSITO</td>
            </tr>
        @else
            <tr>
                <td style="border: 1px solid #000"><strong>BODEGA</strong></td>
                <td style="border: 1px solid #000" colspan="{{$max_width-1}}">{{$collection->first()->ubicacion}}</td>
            </tr>
        @endif
    @endif


    @if($parametros->lote !=null)
        <tr>
            <td style="border: 1px solid #000"><strong>LOTE</strong></td>
            <td style="border: 1px solid #000" colspan="{{$max_width-1}}">{{$parametros->lote}}</td>
        </tr>
    @endif

    </thead>
</table>
<table style=" border-collapse: collapse;">
    @php

        $colspan = count($tipos_movimiento);
    @endphp

    <thead>
    <tr style="border: 1px solid #000">
        <th width="35" style="border: 1px solid #000">CODIGO INTERNO</th>
        <th width="35" style="border: 1px solid #000">PRODUCTO</th>


        @if($parametros->id_select_search==null)
            <th width="20" style="border: 1px solid #000">UBICACION</th>
            @php
                $colspan -= 1;
            @endphp
        @endif
        @if($parametros->lote ==null)
            <th width="20" style="border: 1px solid #000">LOTE</th>
            @php
                $colspan -= 1;
            @endphp
        @endif

        <th width="35" style="border: 1px solid #000">MEDIDA</th>



        @foreach($tipos_movimiento as $tipo)
            <th width="20" style="border: 1px solid #000">{{ substr($tipo->descripcion,0,3)}}</th>
        @endforeach
        <th width="20" style="border: 1px solid #000" colspan="{{$colspan}}">FINAL</th>
    </tr>
    </thead>
    <tbody>


    @foreach($collection as $producto)
        <tr>

            <td style="border: 1px solid #000000">
                {{$producto->codigo_interno}}
            </td>
            <td style="border: 1px solid #000000">
                {{$producto->producto}}
            </td>


            @if($parametros->id_select_search==null)
                <td style="border: 1px solid #000000">
                    @if($producto->id_bodega == 0)
                        AREA TRANSITO
                    @else
                        {{$producto->ubicacion}}
                    @endif
                </td>
            @endif
            @if($parametros->lote ==null)
                <td style="border: 1px solid #000000">
                    {{$producto->lote}}
                </td>
            @endif
            <td style="border: 1px solid #000000">
                {{$producto->unidad_medida}}
            </td>


            @foreach($tipos_movimiento as $tipo)
                <td style="border: 1px solid #000000">
                    {{$producto->{$tipo->descripcion} }}
                </td>
            @endforeach
            <td colspan="{{$colspan}}" style="border: 1px solid #000000">
                {{$producto->total}}
            </td>
        </tr>
    @endforeach


    </tbody>
</table>
</body>
</html>
