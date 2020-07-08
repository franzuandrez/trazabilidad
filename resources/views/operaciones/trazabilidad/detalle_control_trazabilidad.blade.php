<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#insumos" data-toggle="tab">Insumos</a></li>
        <li><a href="#colaboradores" data-toggle="tab">Colaboradores</a></li>

    </ul>
    <div class="tab-content">
        <div class="active tab-pane event-detail" id="insumos">
            <table class="table">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Lote</th>
                    <th>Cantidad Utilizada</th>
                </tr>
                </thead>

                @foreach($evento->evento->detalle_insumos as $insumo)
                    <tr>
                        <td>{{$insumo->producto->codigo_interno}}</td>
                        <td>{{$insumo->lote}}</td>
                        <td>{{$insumo->cantidad_utilizada}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="tab-pane event-detail " id="colaboradores"
        >
            <table class="table">
                <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Colaborador</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                </tr>
                </thead>
                @foreach($evento->evento->actividades as $actividad)
                    <tr>
                        <td>{{$actividad->actividad->descripcion}}</td>
                        <td colspan="3">
                            <table class="table">
                                @foreach($evento->evento->asistencias as $asistencia )
                                    @if($asistencia->id_actividad == $actividad->id_actividad)
                                        <tr>
                                            <td>
                                                {{$asistencia->colaborador->nombre}}
                                            </td>
                                            <td>
                                                {{$asistencia->fecha_hora_asociacion->format('H:i:s')}}
                                            </td>
                                            <td>
                                                {{$asistencia->fecha_hora_fin->format('H:i:s')}}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

</div>
