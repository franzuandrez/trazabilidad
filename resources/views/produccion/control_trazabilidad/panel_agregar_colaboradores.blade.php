<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
        <label for="actividades">ACTIVIDADES</label>
        <select name="actividades"
                onchange="next('colaborador')"
                id="actividades" class="form-control selectpicker">
            <option value="">SELECCIONE ACTIVIDAD</option>
            @foreach( $actividades  as $actividad)
                <option value="{{$actividad->id_actividad}}">{{$actividad->descripcion}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <label for="colaborador"> COLABORADOR</label>
    <div class="input-group">
        <input type="text"
               name="colaborador"
               id="colaborador"
               onkeydown="if(event.keyCode==13)buscar_colaborador()"
               class="form-control">
        <div class="input-group-btn">
            <button
                onclick="buscar_colaborador()"
                onkeydown="buscar_colaborador()"
                type="button" class="btn btn-default">
                <i class="fa fa-search"
                   aria-hidden="true"></i>
            </button>
            <button type="button"
                    id="btn_agregar"
                    onclick="agregar_asociacion()"
                    onkeydown="agregar_asociacion()"
                    class="btn btn-default">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <button type="button"
                    id="btn_limpiar"
                    onclick="limpiar()"
                    onkeydown="limpiar()"
                    class="btn btn-default">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <input type="hidden" id="id_colaborador">
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <table class="table table-bordered table-responsive">
        <thead style="background-color: #01579B;  color: #fff;">
        <tr>
            <th>

            </th>
            <th>
                ACTIVIDAD
            </th>
            <th>
                COLABORADORES
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
                                                    type="button" class="btn btn-success">
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
</div>
