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
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    <table class="table table-bordered table-responsive">
        <thead style="background-color: #01579B;  color: #fff;">
        <tr>
            <th>MP</th>
            <th>COLOR</th>
            <th>OLOR</th>
            <th>IMPRESION</th>
            <th>AUSENCIA M.E.</th>
            <th>NO LOTE</th>
            <th>CANTIDAD</th>
            <th>FECHA VENC.</th>
        </tr>
        </thead>
        <tbody id="tbody_insumos">
        @isset($control)
            @foreach($control->detalle_insumos as $insumo)
                <tr>
                    <td>
                        {{$insumo->producto->descripcion}}
                    </td>
                    <td>
                        @if($insumo->color==1)
                            <input type="checkbox" checked onclick="return false">
                        @else
                            <input type="checkbox" onclick="return false">
                        @endif
                    </td>
                    <td>
                        @if($insumo->olor==1)
                            <input type="checkbox" checked onclick="return false">
                        @else
                            <input type="checkbox" onclick="return false">
                        @endif
                    </td>
                    <td>
                        @if($insumo->impresion==1)
                            <input type="checkbox" checked onclick="return false">
                        @else
                            <input type="checkbox" onclick="return false">
                        @endif
                    </td>
                    <td>
                        @if($insumo->ausencia_material_extranio==1)
                            <input type="checkbox" checked onclick="return false">
                        @else
                            <input type="checkbox" onclick="return false">
                        @endif
                    </td>
                    <td>
                        {{$insumo->lote}}
                    </td>
                    <td>
                        {{$insumo->cantidad}}
                    </td>
                    <td>
                        {{$insumo->fecha_vencimiento->format('d/m/Y')}}
                    </td>

                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
</div>
