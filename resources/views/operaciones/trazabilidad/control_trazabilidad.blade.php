<li class="">
    <i class="fa  fa fa fa-list-alt    bg-green"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>{{$evento->evento->created_at->format('H:i:s')}}</span>
        <h3 class="timeline-header"

        ><a href="#" style="color: #01579b !important; ">
                Control de Trazabilidad
            </a> {{$evento->evento->id_control}}</h3>
        <div class="timeline-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Ordenes de Produccion</th>
                            <td colspan="2">{{

                      substr_replace(
                $evento->evento->requisiciones->reduce(function($carry,$item){
                    return $item->no_orden_produccion." , ".$carry;
                     }),"",-1
                )
                    }}</td>
                        </tr>
                        <tr>
                            <th>Creado por</th>
                            <td colspan="2"> {{$evento->evento->creado_por->nombre}} </td>
                        </tr>
                        <tr>
                            <th>Producto</th>
                            <td colspan="2">{{$evento->evento->producto->codigo_interno}}</td>
                        </tr>
                        <tr>
                            <th>Lote</th>
                            <td colspan="2">{{$evento->evento->lote}}</td>
                        </tr>

                        <tr>
                            <th rowspan="3">Cantidad</th>
                        </tr>
                        <tr>
                            <th> Producida</th>
                            <td>{{$evento->evento->cantidad_producida}}</td>
                        </tr>
                        <tr>
                            <th> Programada</th>
                            <td>{{$evento->evento->cantidad_programada}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    @include('operaciones.trazabilidad.detalle_control_trazabilidad')
                </div>
            </div>
        </div>


    </div>

</li>
