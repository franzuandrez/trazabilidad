@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-sign-in',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'recepcion/materia_prima/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="producto">MATERIA PRIMA</label>
        <div class="input-group">
            <input type="text" id="producto"
                   name="producto"
                   placeholder="BUSCAR..."
                   class="form-control">
            <span class="input-group-btn">
                <a href="javascript:buscar_producto();">
                    <button type="button"
                            class="btn btn-default"
                            id="buscar"
                            data-placement="top"
                            title="Buscar" data-toggle="tooltip"
                            data-loading-text="<i class='fa fa-refresh fa-spin '></i>">
                        <i class="fa fa-search"></i>
                    </button>
                </a>
                  <a href="javascript:limpiar()">
                   <button type="button" class="btn btn-default"
                           id="limpiar" data-placement="top"
                           title="Limpiar" data-toggle="tooltip">
                        <i class="fa fa-trash"></i>
                    </button>
                </a>
            </span>
        </div>
    </div>

    <input type="hidden" id="id_producto" name="id_producto">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <select name="id_proveedor" id="proveedores" class="form-control selectpicker">

                @if(old('id_proveedor'))
                    <option selected
                            value="{{old('id_proveedor')}}">{{$proveedores->where('id_proveedor',old('id_proveedor'))->first()->nombre_comercial}}</option>
                @else
                    <option value=""> SELECCIONE PROVEEDOR</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text" required name="documento_proveedor" value="{{old('documento_proveedor')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. DOCUMENTO</label>
            <input type="text" required name="orden_compra" value="{{old('orden_compra')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="false">
                        Documentos y Vehiculos
                    </a>
                </li>
                <li class="">
                    <a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="validacion_checks()">
                        Empaque y Etiqueta

                    </a>
                </li>

                <li class="">
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true" onclick="validacion_checks()">
                        Detalles de lotes
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">


                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   id="proveedor_aprobado"
                                   value="1"
                                   {{old('proveedor_aprobado')?'checked':''}}
                                   required
                                   name="proveedor_aprobado">
                            <label class="custom-control-label" for="proveedor_aprobado">Proveedor aprobado</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion"
                                   name="producto_acorde_compra"
                                   value="1"
                                   {{old('producto_acorde_compra')?'checked':''}}
                                   id="producto_acorde_compra"
                                   onclick="validacion_checks()"
                            >
                            <label class="custom-control-label" for="producto_acorde_compra">Producto acorde con Orden
                                de Compra</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion"
                                   value="1"
                                   {{old('cantidad_acorde_compra')?'checked':''}}
                                   name="cantidad_acorde_compra"
                                   id="cantidad_acorde_compra"
                                   onclick="validacion_checks()"
                            >
                            <label class="custom-control-label" for="cantidad_acorde_compra">Cantidad acorde con orden
                                de Compra</label>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Certificado de análisis</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="certificado_existente"
                                   value="1"
                                   {{old('certificado_existente')?'checked':''}}
                                   id="certificado_existente">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_existente">Existente</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="certificado_correspondiente_lote"
                                   value="1"
                                   {{old('certificado_correspondiente_lote')?'checked':''}}
                                   id="certificado_correspondiente_lote">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_correspondiente_lote">Correspondiente
                                a No. Lote</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   id="certificado_correspondiente_especificacion"
                                   {{old('certificado_correspondiente_especificacion')?'checked':''}}
                                   name="certificado_correspondiente_especificacion"
                                   value="1"
                            >
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_correspondiente_especificacion">
                                De acuerdo a especificación
                            </label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Limpieza interna de vehìculo</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input validacion" onclick="validacion_checks()"
                                   id="sin_polvo"
                                   {{old('sin_polvo')?'checked':''}}
                                   name="sin_polvo"
                                   value="1"
                            >
                            <label class="custom-control-label" style="font-weight: normal" for="sin_polvo">Sin polvo
                                y/o
                                suciedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   id="sin_material_ajeno"
                                   value="1"
                                   {{old('sin_material_ajeno')?'checked':''}}
                                   name="sin_material_ajeno">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_material_ajeno">Sin
                                Material
                                Ajeno</label>

                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Condiciones Internas vehiculos</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   value="1"
                                   {{old('ausencia_plagas')?'checked':''}}
                                   name="ausencia_plagas"
                                   id="ausencia_plagas">
                            <label class="custom-control-label" style="font-weight: normal" for="ausencia_plagas">Ausencia
                                de
                                Plagas</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   value="1"
                                   {{old('sin_humedad')?'checked':''}}
                                   id="sin_humedad"
                                   name="sin_humedad">

                            <label
                                class="custom-control-label" style="font-weight: normal" for="sin_humedad">Sin
                                Humedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="sin_oxido"
                                   value="1"
                                   {{old('sin_oxido')?'checked':''}}
                                   id="sin_oxido">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_oxido">Sin
                                óxido</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="ausencia_olores_extranios"
                                   value="1"
                                   {{old('ausencia_olores_extranios')?'checked':''}}
                                   id="ausencia_olores_extranios">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_olores_extranios">Ausencia de
                                olores extraños</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="ausencia_material_extranio"
                                   value="1"
                                   {{old('ausencia_material_extranio')?'checked':''}}
                                   id="ausencia_material_extranio">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_material_extranio">Ausencia de
                                material extraño</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="cerrado"
                                   value="1"
                                   {{old('cerrado')?'checked':''}}
                                   id="cerrado"> <label
                                class="custom-control-label" style="font-weight: normal" for="cerrado">Cerrado y
                                con llave</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input validacion" onclick="validacion_checks()"
                                   name="sin_agujeros"
                                   value="1"
                                   {{old('sin_agujeros')?'checked':''}}
                                   id="sin_agujeros">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_agujeros">Sin
                                agujeros</label>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_vehiculo">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="observaciones_vehiculo" value="{{old('observaciones_vehiculo')}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <label for="empaque">Empaque</label>

                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="no_golpeado"
                                   value="1"
                                   {{old('no_golpeado')?'checked':''}}
                                   required
                                   id="no_golpeado">
                            <label class="custom-control-label" style="font-weight: normal" for="no_golpeado">No
                                golpeado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="sin_roturas"
                                   value="1"
                                   {{old('sin_roturas')?'checked':''}}
                                   required
                                   id="sin_roturas">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_roturas">Sin
                                rotulas</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   required
                                   {{old('empaque_cerrado')?'checked':''}}
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="empaque_cerrado"
                                   value="1"
                                   id="empaque_cerrado">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="empaque_cerrado">Cerrado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="seco_limpio"
                                   {{old('seco_limpio')?'checked':''}}
                                   value="1"
                                   id="seco_limpio">
                            <label class="custom-control-label" style="font-weight: normal" for="seco_limpio">Seco y
                                Limpio</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   value="1"
                                   {{old('sin_material_extranio')?'checked':''}}
                                   name="sin_material_extranio"
                                   id="sin_material_extranio">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_material_extranio">Sin
                                material
                                extraño</label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   value="1"
                                   {{old('debidamente_identificado')?'checked':''}}
                                   name="debidamente_identificado"
                                   id="debidamente_identificado">
                            <label class="custom-control-label" for="debidamente_identificado">Producto debidamente
                                identificado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   {{old('debidamente_legible')?'checked':''}}
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="debidamente_legible"
                                   value="1"
                                   id="debidamente_legible">
                            <label class="custom-control-label" for="debidamente_legible">Identificación de producto
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   value="1"
                                   {{old('no_lote_presente')?'checked':''}}
                                   name="no_lote_presente"
                                   id="no_lote_presente">
                            <label class="custom-control-label" for="no_lote_presente">No. de lote presente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="no_lote_legible"
                                   value="1"
                                   {{old('no_lote_legible')?'checked':''}}
                                   id="no_lote_legible">
                            <label class="custom-control-label" for="no_lote_legible">No. de lote legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="fecha_vencimiento_legible"
                                   value="1"
                                   {{old('fecha_vencimiento_legible')?'checked':''}}
                                   id="fecha_vencimiento_legible">
                            <label class="custom-control-label" for="fecha_vencimiento_legible">Fecha de vencimiento
                                presente y
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="fecha_vencimiento_vigente"
                                   value="1"
                                   {{old('fecha_vencimiento_vigente')?'checked':''}}
                                   id="fecha_vencimiento_vigente">
                            <label class="custom-control-label" for="fecha_vencimiento_vigente">Fecha de vencimiento
                                vigente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input  validacion" onclick="validacion_checks()"
                                   name="contenido_neto_declarado"
                                   value="1"
                                   {{old('contenido_neto_declarado')?'checked':''}}
                                   id="contenido_neto_declarado">
                            <label class="custom-control-label" for="contenido_neto_declarado">Contenido Neto
                                declarado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_empaque">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="observaciones_empaque" value="{{old('observaciones_empaque')}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="col-lg-7 col-sm-10 col-md-10 col-xs-10">
                        <div class="form-group">
                            <label for="codigo_producto">Codigo</label>
                            <input id="codigo_producto" type="text"
                                   onkeydown="cargarInfoCodigoBarras(this)"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-md-2 col-xs-2">
                        <br>
                        <div class="form-group">
                            <button id="btnLimpiar" class="btn btn-default block" style="margin-top: 5px;"
                                    type="button">
                                <span class=" fa fa-trash"></span></button>
                        </div>
                    </div>
                    <input id="id_producto" type="hidden"
                           name="id_producto"
                           class="form-control">
                    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre_producto">Producto</label>
                            <input id="nombre_producto" type="text"
                                   readonly
                                   class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">No. de Lote</label>
                            <input id="lote" type="text"
                                   onkeydown="if(event.keyCode==13)document.getElementById('vencimiento').focus()"
                                   name="descripcion"

                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label>Fecha de Vencimiento</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="vencimiento"
                                       onkeydown="if(event.keyCode==13)document.getElementById('cantidad').focus()"
                                       type="text" class="form-control pull-right" id="datepicker">
                            </div>

                        </div>
                    </div>
                    <div class=" col-lg-3  col-sm-4 col-md-4 col-xs-10">
                        <div class="form-group">
                            <label for="nombre">Cantidad</label>
                            <input id="cantidad" type="number"
                                   onkeydown="if(event.keyCode==13)addToTable()"
                                   onkeypress="return justNumbers(event);" name="descripcion"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-md-2 col-xs-2">
                        <br>
                        <div class="form-group">
                            <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                                <span class=" fa fa-plus"></span></button>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>OPCION</th>
                            <th>PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>NO. LOTE</th>
                            <th>FECHA VENCIMIENTO</th>
                            </thead>
                            <tbody id="body-detalles">
                            @if(old('id_producto'))
                                @foreach( old('id_producto') as $key => $prod )
                                    <tr>
                                        <td>
                                            <button onclick=removeFromTable(this) type="button" class="btn btn-warning">
                                                x
                                            </button>
                                        </td>
                                        <td>
                                            <input type="hidden" value="{{old('id_producto')[$key]}}"
                                                   name="id_producto[]">
                                            <input type="hidden" value="{{old('descripcion_producto')[$key]}}"
                                                   name="descripcion_producto[]">
                                            {{old('descripcion_producto')[$key]}}
                                        </td>
                                        <td>
                                            <input type="hidden" value="{{old('cantidad')[$key]}}" name="cantidad[]">
                                            {{old('cantidad')[$key]}}
                                        </td>
                                        <td>
                                            <input type="hidden" value="{{old('no_lote')[$key]}}" name="no_lote[]">
                                            {{old('no_lote')[$key]}}
                                        </td>
                                        <td>
                                            <input type="hidden" value="{{old('fecha_vencimiento')[$key]}}"
                                                   name="fecha_vencimiento[]">
                                            {{old('fecha_vencimiento')[$key]}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" name="Bt_guardar" disabled id="Bt_guardar"
                    onclick="$('form').submit()"
                    type="button">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('recepcion/materia_prima')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    <div class="modal fade modal-slide-in-right" aria-hidden="true"
         role="dialog" tabindex="-1" id="not_found">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" align="center">PRODUCTO NO ENCONTRADO</h4>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                        ACEPTAR
                    </button>
                </div>
            </div>
        </div>

    </div>
    @include('recepcion.materia_prima.productos')
    {!!Form::close()!!}

@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.js')}}"></script>
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}"></script>
    <script>
        var formato = 'D/M/Y';

        $('.date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {

            $("#btnAdd").click(function () {
                addToTable();
            });

            $("#btnLimpiar").click(function () {
                limpiarProducto();
            });


            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#producto').keydown(function (event) {
                if (event.keyCode == 13) {
                    getCodigoProducto();
                }
            })

        });
    </script>
    <script>
        function limpiarProducto() {
            document.getElementById('id_producto').value = "";
            document.getElementById('codigo_producto').value = "";
            document.getElementById('nombre_producto').value = "";
            document.getElementById('lote').value = "";
            document.getElementById('vencimiento').value = "";
            document.getElementById('cantidad').value = "";
            document.getElementById('codigo_producto').focus();
        }

        function cargarProveedores(proveedores) {
            limpiarSelectProveedores()
            let option = '';
            var total = proveedores.length;

            proveedores.forEach(function (e) {
                if (total == 1) {
                    option += `<option  selected value='${e.id_proveedor}'>${e.nombre_comercial}</option>`;
                } else {
                    option += `<option   value='${e.id_proveedor}'>${e.nombre_comercial}</option>`;
                }
            });
            $('#proveedores').append(option);
            $('#proveedores').selectpicker('refresh');

        }

        function limpiarSelectProveedores() {
            $('#proveedores').find('option:not(:first)').remove();
            $('#proveedores').selectpicker('refresh');
        }

        let productosAgregados = [];

        function addToTable() {


            if ($("#id_producto").val() == "") {
                alert("Producto invalido");
                return;
            }
            if ($("#lote").val() == "") {
                alert("Lote en blanco");
                $("#lote").focus();
                return;
            }
            if ($("#vencimiento").val() == "") {
                alert("Fecha de vencimiento en blanco");
                $("#vencimiento").focus();
                return;
            }

            if ($("#cantidad").val() == "" || $("#cantidad").val() == 0) {
                alert("Cantidad invalida");
                $("#cantidad").focus();
                return;
            }

            if ($("#cantidad").val() != "" && $("#lote").val() != "" && $("#vencimiento").val() != "" && $("#id_producto").val() != "") {
                let cantidad = $("#cantidad");

                if (cantidad.val() == 0) {
                    alert("La cantidad debe ser mayor a cero");
                    return;
                }
                let lote = $("#lote");
                let fecha = $("#vencimiento");
                let codigo_producto = $("#codigo_producto");
                let nombre_producto = $("#nombre_producto");
                let id_producto = $("#id_producto");

                let isFechaVencimientoValida = moment(fecha.val(), formato).isValid() && moment(fecha.val(), formato).isAfter(moment());

                if (!isFechaVencimientoValida) {
                    alert("La fecha de vencimiento no es válida.");
                    return;
                }

                let existeLoteValido = findLote(id_producto.val(), lote.val().toUpperCase(), cantidad.val(), fecha.val());
                if (existeLoteValido == 0) { //No existe, lo agrego

                    let row =
                        `<tr class="row-producto-added" id='${id_producto.val()}-${lote.val().toUpperCase()}'>
                            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
                            <td><input type="hidden" name="descripcion_producto[]" value="${nombre_producto.val()}" > <input type="hidden" value='${id_producto.val()}' name=id_producto[]>${nombre_producto.val()}</td>
                            <td><input type="hidden" value='${cantidad.val()}' name=cantidad[]>${cantidad.val()}</td>
                            <td ><input type="hidden" value ='${lote.val().toUpperCase()}'  name=no_lote[] >${lote.val().toUpperCase()}</td>
                            <td ><input type="hidden" value ='${moment(fecha.val(), formato).format('Y-MM-DD')}'  name=fecha_vencimiento[] >${fecha.val()}</td>
                            </tr>`;
                    let producto = productosAgregados.find(producto => producto.id_producto == id_producto.val());
                    if (typeof producto != 'undefined') {
                        //agrego el lote
                        producto.lotes.push(lote.val().toUpperCase());
                    } else {
                        //agrego un nuevo registro
                        productosAgregados.push({id_producto: id_producto.val(), lotes: [lote.val().toUpperCase()]});
                    }

                    $("#detalles").append(row);
                    document.getElementById('Bt_guardar').disabled = false;

                    limpiarProducto();
                } else if (existeLoteValido == 1) { //Existe y tiene la fecha valida.
                    limpiarProducto();
                } else {//Existe y la fecha es invalida
                    fecha.focus();
                }
                $('#proveedores').find('option:not(:selected)').remove();
                $('#proveedores').selectpicker('refresh');

            }
        }

        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            let row = td.parent();
            row.remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();

            let id_producto = row[0].id.split('-')[0];
            let no_lote = row[0].id.split('-')[1];

            let producto = productosAgregados.find(p => p.id_producto == id_producto);
            let lotes = producto.lotes;

            var index = lotes.indexOf(no_lote);
            if (index > -1) {
                lotes.splice(index, 1);
            }
            validacion_checks();

        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        var allProducts = null;


        function buscar_producto(searchValue = null) {

            let productoElement = document.getElementById('producto');

            if (searchValue == null) {
                searchValue = productoElement.value;
            }
            searchValue = descomponerString(searchValue)[1];

            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + searchValue,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let productos = response;
                    let totalProductos = productos.length;

                    if (totalProductos == 0) {

                        mostrarAlertaNotFound();

                    } else if (totalProductos == 1) {

                        cargarProducto(productos[0]);

                    } else {
                        allProducts = productos;
                        cargarProductos(productos);
                        mostrarProductosCargados();
                    }


                },
                error: function (e) {

                    console.error(e);
                }

            })

        }


        function limpiar() {
            limpiarSelectProveedores();
            document.getElementById('id_producto').value = "";
            document.getElementById('producto').value = "";
            document.getElementById('producto').readOnly = false;
            document.getElementById('buscar').disabled = false;
            $("#body-detalles").empty();
            productosAgregados = [];
            $('#proveedores').find('option').remove();
            $('#proveedores').append('<option value="">SELECCIONE PROVEEDOR </option>')
            $('#proveedores').selectpicker('refresh');
        }


        function cargarProductos(productos) {

            $("#tbody-productos").empty();
            let row = "";

            productos.forEach(function (producto) {

                row += `<tr>
                    <td><input  onclick="habilitar()" type='radio' name='id_prod' value='${producto.id_producto}'  ></td>
                    <td> ${producto.codigo_barras} </td>
                    <td> ${producto.descripcion} </td>

                </tr> `;

            })

            $('#tbody-productos').append(row);

        }

        function cargarProducto(producto) {

            let productoElement = document.getElementById('producto');
            let idProductoElement = document.getElementById('id_producto');


            let btnBuscar = document.getElementById('buscar');
            if (Array.isArray(producto)) {
                idProductoElement.value = producto[0];
                productoElement.value = producto[1];
                productoElement.readOnly = true;
                btnBuscar.disabled = true;
                let proveedores = allProducts.find(p => p.id_producto == producto[0]).proveedores;
                cargarProveedores(proveedores);
            } else if (typeof producto === 'object') {
                idProductoElement.value = producto.id_producto;
                productoElement.value = producto.descripcion;
                productoElement.readOnly = true;
                btnBuscar.disabled = true;
                cargarProveedores(producto.proveedores);
            }

        }

        function mostrarProductosCargados() {

            setTimeout(function () {
                $('#modal-productos').modal();
            }, 1000);
        }

        function mostrarAlertaNotFound() {
            $('#not_found').modal();
        }

        function habilitar() {

            document.getElementById('aceptar_producto').disabled = false;

        }

        function setProducto() {

            let infoProd = getProductoSelected();
            if (infoProd.length != 0) {
                cargarProducto(infoProd);
            } else {


            }


        }

        function getProductoSelected() {
            var productos = document.getElementsByName('id_prod');
            var id_prod = null;
            var descripcion = null;

            var arrayProductos = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            });


            arrayProductos.forEach(function (prod) {
                if (prod[1].checked) {
                    var childrens = prod[1].parentElement.parentElement.children;
                    id_prod = childrens[0].firstChild.value;
                    descripcion = childrens[2].innerText;
                }
            });
            return [id_prod, descripcion];
        }


        function cargarInfoCodigoBarras(input) {


            let infoCodigoBarras = descomponerInput(input);
            if (event.keyCode == 13) {

                mostrarInfoCodigoBarras(infoCodigoBarras);
            }


        }

        function mostrarInfoCodigoBarras(infoCodigoBarras) {

            let producto = buscar_producto_by_codigo(infoCodigoBarras);


        }

        function buscar_producto_by_codigo(infoCodigoBarras) {
            const POSICION_CODIGO = 1;
            const POSICION_FECHA = 2;
            const POSICION_LOTE = 3;

            let fecha = infoCodigoBarras[POSICION_FECHA];
            let codigo = infoCodigoBarras[POSICION_CODIGO];
            let lote = infoCodigoBarras[POSICION_LOTE];

            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + codigo,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let productos = response;
                    let totalProductos = productos.length;

                    if (totalProductos == 0) {
                        mostrarAlertaNotFound();
                    } else {

                        let producto = productos[0];

                        var id_proveedor = $('#proveedores').val();
                        var proveedor = productos[0].proveedores.find(function (element) {
                            return element.id_proveedor == id_proveedor
                        });

                        if (typeof proveedor != 'undefined') {

                            if (lote != "") {
                                document.getElementById('nombre_producto').value = producto.descripcion;
                                document.getElementById('lote').value = lote;
                                document.getElementById('vencimiento').value = getDate(fecha);
                                document.getElementById('id_producto').value = producto.id_producto;
                                document.getElementById('cantidad').focus();
                            } else {
                                document.getElementById('nombre_producto').value = producto.descripcion;
                                document.getElementById('id_producto').value = producto.id_producto;
                                document.getElementById('lote').focus();
                            }

                        } else {
                            alert(" El producto no coincide con el proveedor ");
                        }


                    }


                },
                error: function (e) {

                    console.log(e);
                }

            })


        }

        function getDate(date) {
            var anio = "20" + date.substring(0, 2);
            var mes = date.substring(2, 4);
            var dia = date.substring(4);
            var newDate = dia + "/" + mes + "/" + anio;

            return newDate

        }

        function getCodigoProducto() {
            const POSICION_CODIGO = 1;
            var inputMateriaPrima = document.getElementById('producto');

            var infoCodigoBarras = descomponerInput(inputMateriaPrima);

            var codigo_producto = infoCodigoBarras[POSICION_CODIGO]
            console.log(codigo_producto);
            buscar_producto(codigo_producto);


        }

        /**
         *
         * @param id_producto
         * @param lote
         * @param nuevaCantidad
         *
         *
         *
         * Acumula la cantidad en caso de existir ya un producto con su lote
         */

        function findLote(id_producto, lote, nuevaCantidad, fecha_vencimiento) {
            var existe = 0;
            var producto = productosAgregados.find(p => p.id_producto == id_producto);
            const POSICION_CANTIDAD = 2;
            const POSICION_FECHA = 4;


            if (typeof producto != 'undefined') {

                var no_lote = producto.lotes.find(no_lote => no_lote == lote.toUpperCase());
                //Verifico si existe el producto con el lote.
                if (typeof no_lote != 'undefined') {

                    let row = document.getElementById(id_producto + '-' + lote.toUpperCase());


                    var inputCantidad = row.children[POSICION_CANTIDAD].firstChild;
                    var inputFechaVencimiento = row.children[POSICION_FECHA].firstChild;

                    if (inputFechaVencimiento.value == fecha_vencimiento) {
                        var cantidad = parseInt(inputCantidad.value);
                        cantidad = parseInt(nuevaCantidad) + parseInt(cantidad);
                        inputCantidad.value = cantidad;
                        row.children[POSICION_CANTIDAD].lastChild.textContent = cantidad;
                        existe = 1;
                    } else {
                        alert("La fecha de vencimiento no corresponde con el lote.");
                        existe = 2;
                    }

                }

            }


            return existe;
        }

        function prueba(e) {
            console.log(e);
        }

        function validacion_checks() {
            var detalleNoVacio = document.getElementById('body-detalles').children.length != 0;

            if (detalleNoVacio == true) {
                $("#Bt_guardar").attr('disabled', false);
            } else {
                $("#Bt_guardar").attr('disabled', true);
            }
        }
    </script>
@endsection
