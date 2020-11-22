<table class="table table-bordered table-responsive">
    <thead style="background-color: #f7b633;  color: #fff;">
    <tr>
        <th>

        </th>
        <th>
            Actividad
        </th>
        <th>
            Colaboradores
        </th>
    </tr>
    </thead>
    <tbody id="asociaciones">
    @isset($control)
        @foreach( $control->actividades as $actividad)
            <tr id="actividad-{{$actividad->id_actividad}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$actividad->actividad->descripcion}}</td>
                <td>
                    <table class="table table-bordered">
                        <thead>

                        </thead>
                        @php
                            $i = 0;
                        @endphp
                        <tbody id="asociacion-{{$actividad->id_actividad}}">
                        @foreach($control->asistencias as $asistencia )
                            @if($asistencia->id_actividad == $actividad->id_actividad)
                                <tr
                                    id="act-{{$actividad->id_actividad}}-col-{{$asistencia->colaborador->id_colaborador}}"
                                    class="{{$asistencia->fecha_hora_fin==null?'':'success'}}"
                                >
                                    <td>
                                        @if($asistencia->fecha_hora_fin == null)
                                            <button
                                                data-toggle="tooltip"
                                                title="Finalizar"
                                                onclick="finalizar_asistencia('{{$actividad->id_actividad}}','{{$asistencia->colaborador->id_colaborador}}')"
                                                type="button" class="btn btn-success colaborador_pendiente_finalizar">
                                                <span class="fa fa-check"></span>
                                            </button>
                                        @else
                                            {{$asistencia->fecha_hora_fin->format('h:i:s')}}
                                        @endif

                                    </td>
                                    <td>{{$asistencia->colaborador->nombre .' '. $asistencia->colaborador->apellido  }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        @endforeach
    @endisset
    </tbody>
</table>
