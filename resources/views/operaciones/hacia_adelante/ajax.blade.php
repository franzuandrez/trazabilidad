<div class="row">
    @include('operaciones.trazabilidad.search')
</div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Informacion General</h3>
        @if(count($trazabilidad_hacia_adelante['productos']))
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>PRODUCTO</th>
                    <td>
                        {{$trazabilidad_hacia_adelante['productos']->first()->producto->descripcion}}
                    </td>
                </tr>
                <tr>
                    <th>LOTE</th>
                    <td>
                        {{$trazabilidad_hacia_adelante['productos']->first()->no_lote}}
                    </td>
                </tr>
                <tr>
                    <th>DOCUMENTO</th>
                    <td>   {{$trazabilidad_hacia_adelante['productos']->first()->recepcion->orden_compra}}</td>
                </tr>
                <tr>
                    <th>PROVEEDOR</th>
                    <td>   {{$trazabilidad_hacia_adelante['productos']->first()->recepcion->proveedor->razon_social}}</td>
                </tr>
                <tr>
                    <th>FECHA RECEPCION</th>
                    <td>   {{$trazabilidad_hacia_adelante['productos']->first()->recepcion->fecha_ingreso->format('d/m/Y H:i:s')}}</td>
                </tr>

                </tbody>
            </table>
        @endif
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Productos Finales</h3>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>FECHA</th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>CANTIDAD UTILIZADA</th>
                <th></th>
            </tr>
            @foreach($trazabilidad_hacia_adelante['insumos'] as $insumo)
                <tr>
                    <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$insumo->created_at)->format('d/m/Y H:i:s')}}</td>
                    <td>{{$insumo->producto->codigo_interno}}</td>
                    <td>{{$insumo->lote}}</td>
                    <td>{{$insumo->cantidad_utilizada}}</td>
                    <td>
                        <a
                            target="_blank"
                            href="{{url('operaciones/consultas/trazabilidad?search=').$insumo->lote}}">
                            <button class="btn btn-default"><i class=" fa fa-eye"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Movimientos de Inventario
        </h3>
        <table class="table table-bordered">
            <tbody>
            <tr>
                <th>FECHA</th>
                <th>DOCUMENTO</th>
                <th>TIPO DOC</th>
                <th>TIPO MOVIMIENTO</th>
                <th>BODEGA</th>
                <th>CANTIDAD</th>
            </tr>
            @php
                $total = 0;
            @endphp
            @foreach($trazabilidad_hacia_adelante['movimientos'] as $mov)
                <tr>
                    <td>{{$mov->fecha_hora_movimiento->format('d/m/Y H:i:s')}}</td>
                    <td>
                        @include('operaciones.get_url_by_tipo_documento',[
                            'tipo_documento'=>$mov->tipo_documento,
                            'documento'=>$mov->numero_documento
                        ])
                    </td>
                    <td>
                        {{$mov->tipo_documento}}
                    </td>
                    <td>{{$mov->movimiento}}</td>
                    <td>{{$mov->bodega}}</td>
                    <td>{{$mov->factor>0?'+':'-'}}  {{$mov->cantidad}}</td>
                    @php
                        $total = ($mov->cantidad*$mov->factor ) + $total;
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="5"><strong>TOTAL</strong></td>
                <td>
                    {{ number_format($total,3,'.',',') }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
