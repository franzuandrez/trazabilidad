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
        <td style="border: 1px solid #000" colspan="7" align="center"><b>EXISTENCIAS</b></td>
    </tr>
    <tr>
        <td style="border: 1px solid #000"><strong>GENERADO </strong></td>
        <td style="border: 1px solid #000" colspan="6">{{\Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #000"><strong>USUARIO</strong></td>
        <td style="border: 1px solid #000" colspan="6">{{\Auth::user()->nombre}}</td>
    </tr>
    @if($parametros->start != null && $parametros->end != null)
        <tr>
            <td style="border: 1px solid #000"><strong>FECHA</strong></td>
            <td style="border: 1px solid #000" colspan="6">
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
                <td style="border: 1px solid #000" colspan="6">TRANSITO</td>
            </tr>
        @else
            <tr>
                <td style="border: 1px solid #000"><strong>BODEGA</strong></td>
                <td style="border: 1px solid #000" colspan="6">{{$collection->first()->bodega}}</td>
            </tr>
        @endif
    @endif


    @if($parametros->lote !=null)
        <tr>
            <td style="border: 1px solid #000"><strong>LOTE</strong></td>
            <td style="border: 1px solid #000" colspan="6">{{$parametros->lote}}</td>
        </tr>
    @endif

    </thead>
</table>
<table style=" border-collapse: collapse;">
    @php

        $colspan = 3;
    @endphp

    <thead>
    <tr style="border: 1px solid #000">
        @if($parametros->id_select_search==null)
            <th width="20" style="border: 1px solid #000">BODEGA</th>
            @php
                $colspan -= 1;
            @endphp
        @endif
        <th width="35" style="border: 1px solid #000">PRODUCTO</th>
        <th width="35" style="border: 1px solid #000">MEDIDA</th>

        @if($parametros->lote ==null)
            <th width="20" style="border: 1px solid #000">LOTE</th>
            @php
                $colspan -= 1;
            @endphp
        @endif
        <th width="20" style="border: 1px solid #000">ENT</th>
        <th width="20" style="border: 1px solid #000">SAL</th>
        <th width="20" style="border: 1px solid #000" colspan="{{$colspan}}">FINAL</th>
    </tr>
    </thead>
    <tbody>


    @foreach($collection as $producto)
        <tr>
            @if($parametros->id_select_search==null)
                <td style="border: 1px solid #000000">
                    @if($producto->id_bodega == 0)
                        BODEGA TRANSITO
                    @else
                        {{$producto->bodega}}
                    @endif
                </td>
            @endif
            <td style="border: 1px solid #000000">
                {{$producto->producto}}
            </td>
                <td style="border: 1px solid #000000">
                    {{$producto->unidad_medida}}
                </td>

            @if($parametros->lote ==null)
                <td style="border: 1px solid #000000">
                    {{$producto->lote}}
                </td>
            @endif
            <td style="border: 1px solid #000000">
                {{$producto->entrada}}
            </td>
            <td style="border: 1px solid #000000">
                {{$producto->salida}}
            </td>
            <td colspan="{{$colspan}}" style="border: 1px solid #000000">
                {{$producto->total}}
            </td>
        </tr>
    @endforeach


    </tbody>
</table>
</body>
</html>
