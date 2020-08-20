<div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
    <label for="tipo_producto">TIPO PRODUCTO</label>
    <select class="form-control selectpicker"
            onchange="seleccionar_tipo_producto()"
            id="tipo_producto">
        <option value="MP">MATERIA PRIMA</option>
        <option value="PP">PRODUCTO PROCESO</option>
    </select>
</div>
<div id="modulo_materia_prima">
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto_mp"
                   id="codigo_producto_mp"
                   onkeydown="if(event.keyCode==13)buscar_producto_mp_pp()"
                   placeholder="CODIGO PRODUCTO"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_producto_mp">LOTE</label>
            <input type="text"
                   readonly
                   name="lote_producto_mp"
                   id="lote_producto_mp"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion_producto_mp">DESCRIPCION</label>
            <input type="text"
                   readonly
                   name="descripcion_producto_mp"
                   id="descripcion_producto_mp"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <label for="cantidad_producto_mp">CANTIDAD</label>
        <div class="input-group">
            <input type="text"
                   readonly
                   onkeydown="if(event.keyCode==13)verificar_existencia_lote()"
                   name="cantidad_producto_mp"
                   id="cantidad_producto_mp"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    type="button"
                    onclick="verificar_existencia_lote()"
                    class="btn btn-default">
                    <i class="fa fa-plus"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div id="modulo_proceso" style="display: none">
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto_pp"
                   id="codigo_producto_pp"

                   placeholder="CODIGO PRODUCTO"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_producto_pp">LOTE</label>
            <input type="text"
                   name="lote_producto_pp"
                   placeholder="LOTE"
                   onkeydown="if(event.keyCode==13)buscar_producto_pp()"
                   id="lote_producto_pp"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion_producto_pp">DESCRIPCION</label>
            <input type="text"
                   readonly
                   name="descripcion_producto_pp"
                   id="descripcion_producto_pp"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <label for="cantidad_producto_pp">CANTIDAD</label>
        <div class="input-group">
            <input type="text"
                   readonly
                   onkeydown="if(event.keyCode==13)verificar_existencia_lote_pp()"
                   name="cantidad_producto_pp"
                   id="cantidad_producto_pp"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    type="button"
                    onclick="verificar_existencia_lote_pp()"
                    class="btn btn-default">
                    <i class="fa fa-plus"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
