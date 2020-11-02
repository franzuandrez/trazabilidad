@if($producto_trazabilidad!=null)
    <div class="row">
        <div class="col-md-12">
            <h4>EVENTOS</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    @foreach($trazabilidad_hacia_atras['controles'] as $control)
                        <tr>
                            <td>{{str_replace('_',' ', $control->tipo)}}</td>
                            <td>{{$control->fecha->format('d/m/Y H:i:s')}}</td>
                            <td><a href="{{$control->url}}"
                                   target="_blank"
                                   data-placement="top" title="Generar"
                                   data-toggle="tooltip"><img
                                        src="{{asset('imagenes_web/imprimir.png')}}" width="50" height="50"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <h4>INSUMOS</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td colspan="4"><b>PRODUCTO</b></td>
                        @foreach($producto_trazabilidad->detalle_insumos as $insumo)
                            <td>{{$insumo->producto->codigo_interno}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td colspan="4"><b>LOTE</b></td>
                        @foreach($producto_trazabilidad->detalle_insumos as $insumo)
                            <td>{{$insumo->lote}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td><b>FECHA </b></td>
                        <td><b>TIPO DOC </b></td>
                        <td><b>NO. DOC </b></td>
                        <td><b>RESPONSABLE</b></td>
                    </tr>
                    @foreach($trazabilidad_hacia_atras['insumos'] as  $key=>$event)
                        <tr>
                            <td>{{$event['event']->fecha_hora_movimiento->format('d/m/Y H:i:s')}}</td>
                            <td>

                                {{$event['event']->tipo_documento}}
                            </td>
                            <td>{{$event['event']->numero_documento}}</td>
                            <td>{{$event['event']->responsable->nombre}}</td>

                            @foreach($event['movements'] as  $mov)
                                @if($mov==null)
                                    <td>
                                        <span class="label label-danger"> <i class="fa fa-close"></i> </span>
                                    </td>
                                @else
                                    <td>
                                        <span class="label label-success"> <i class="fa fa-check"></i> </span>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endif
@if($producto_trazabilidad_pp!=null)
    @include('operaciones.trazabilidad.ajax_second',[
    'trazabilidad_hacia_atras'=>$trazabilidad_hacia_atras_pp,
    'trazabilidad_hacia_atras_pp'=>null,
    'producto_trazabilidad'=>$producto_trazabilidad_pp,
    'producto_trazabilidad_pp'=>null
])
@endif
