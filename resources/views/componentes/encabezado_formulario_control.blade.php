
<input type="hidden" id="id_control" name="id_control">

<div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
    <label for="turno">NO ORDEN DE PRODUCCION</label>
    <div class="input-group">
        <input type="text" name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
               id="no_orden_produccion"
               onkeydown="if(event.keyCode==13)buscar_no_orden_produccion_local()"
               class="form-control">
        <div class="input-group-btn">
            <button
                id="btn_buscar_orden"
                onclick="buscar_no_orden_produccion_local()"
                onkeydown="buscar_no_orden_produccion_local()"
                type="button" class="btn btn-default">
                <i class="fa fa-search"
                   aria-hidden="true"></i>
            </button>
            <button
                onclick="ver_ordenes_sugeridas()"
                onkeydown="ver_ordenes_sugeridas()"
                type="button" class="btn btn-default">
                <i class="fa fa-info"
                   aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>
<div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
    <div class="form-group">
        <label for="turno">TURNO</label>
        <select class="form-control selectpicker"
                id="id_turno"
                name="id_turno" disabled>
            <option value="" selected>SELECCIONE UN TURNO</option>
            <option value="1">TURNO 1</option>
            <option value="2">TURNO 2</option>
        </select>
    </div>
</div>


<div class="col-lg-6 col-sm-4 col-md-6 col-xs-12">
    <div class="form-group">
        <label for="id_producto">PRODUCTO</label>
        <select class="form-control selectpicker valor"
                disabled
                required
                id="id_producto" name="id_producto">
            <option value="" selected>SELECCIONE UN PRODUCTO</option>
        </select>
    </div>
</div>

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <label for="lote">LOTE</label>
    <div class="input-group">
        <input class="form-control selectpicker valor"
               disabled
               required
               id="lote" name="lote">
        <div class="input-group-btn">
            <button
                onclick="inicia_formulario_local()"
                onkeydown="inicia_formulario_local()"
                type="button" class="btn btn-default">
                <i class="fa fa-check"
                   aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>


<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <hr>
</div>
