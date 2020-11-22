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
                type="button" class="btn btn-primary">
                <i class="fa fa-search"
                   aria-hidden="true"></i>
            </button>
            <button type="button"
                    id="btn_agregar"
                    onclick="agregar_asociacion()"
                    onkeydown="agregar_asociacion()"
                    class="btn btn-primary">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <button type="button"
                    id="btn_limpiar"
                    onclick="limpiar()"
                    onkeydown="limpiar()"
                    class="btn btn-primary">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <input type="hidden" id="id_colaborador">
</div>

<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    @include('produccion.control_trazabilidad.listado_colaboradores')
</div>
