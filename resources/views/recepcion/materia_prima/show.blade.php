@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-sign-in',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text"
                   readonly
                   name="documento_proveedor"
                   value="{{$recepcion->documento_proveedor}}"
                   class="form-control">
        </div>
    </div>

    <input type="hidden" id="id_proveedor" name="id_proveedor" value="{{$recepcion->proveedor->id_proveedor}}">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="proveedor">PROVEEDOR</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->razon_social}}"
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
                    <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                        Empaque y Etiqueta
                    </a>
                </li>
                <li class="">
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">
                        Detalles de lotes
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="proveedor_aprobado"
                                   value="1"
                                   onclick="return false;"
                                   @if($recepcion->inspeccion_vehiculos->proveedor_aprobado == 1 )
                                   checked
                                   @endif
                                   name="proveedor_aprobado">
                            <label class="custom-control-label" for="proveedor_aprobado">Proveedor aprobado</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="producto_acorde_compra"
                                   onclick="return false;"
                                   value="1"
                                   @if($recepcion->inspeccion_vehiculos->producto_acorde_compra == 1)
                                   checked
                                   @endif
                                   id="producto_acorde_compra">
                            <label class="custom-control-label" for="producto_acorde_compra">Producto acorde con Orden
                                de Compra</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->cantidad_acorde_compra == 1)
                                   checked
                                   @endif
                                   name="cantidad_acorde_compra"
                                   id="cantidad_acorde_compra">
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
                                   class="custom-control-input"
                                   name="certificado_existente"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->certificado_existente == 1)
                                   checked
                                   @endif
                                   id="certificado_existente">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_existente">Existente</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="certificado_correspondiente_lote"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->certificado_correspondiente_lote == 1)
                                   checked
                                   @endif
                                   id="certificado_correspondiente_lote">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="certificado_correspondiente_lote">Correspondiente
                                a No. Lote</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="opcion6"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->certificado_correspondiente_especificacion == 1)
                                   checked
                                   @endif
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
                            <input type="checkbox" class="custom-control-input"
                                   id="sin_polvo"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->sin_polvo == 1)
                                   checked
                                   @endif
                                   name="sin_polvo"
                                   value="1"
                            >
                            <label class="custom-control-label" style="font-weight: normal" for="sin_polvo">Sin polvo
                                y/o
                                suciedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="sin_material_ajeno"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->sin_material_ajeno == 1)
                                   checked
                                   @endif
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
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->ausencia_plagas == 1)
                                   checked
                                   @endif
                                   name="ausencia_plagas"
                                   id="ausencia_plagas">
                            <label class="custom-control-label" style="font-weight: normal" for="ausencia_plagas">Ausencia
                                de
                                Plagas</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->sin_humedad == 1)
                                   checked
                                   @endif
                                   id="sin_humedad"
                                   name="sin_humedad">

                            <label
                                    class="custom-control-label" style="font-weight: normal" for="sin_humedad">Sin
                                Humedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   name="sin_oxido"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->sin_oxido == 1)
                                   checked
                                   @endif
                                   id="sin_oxido">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_oxido">Sin
                                óxido</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="ausencia_olores_extranios"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->ausencia_olores_extranios == 1)
                                   checked
                                   @endif
                                   id="ausencia_olores_extranios">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_olores_extranios">Ausencia de
                                olores extraños</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="ausencia_material_extranio"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->ausencia_material_extranio == 1)
                                   checked
                                   @endif
                                   id="ausencia_material_extranio">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="ausencia_material_extranio">Ausencia de
                                material extraño</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input"
                                   name="cerrado"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->cerrado == 1)
                                   checked
                                   @endif
                                   id="cerrado"> <label
                                    class="custom-control-label" style="font-weight: normal" for="cerrado">Cerrado y
                                con llave</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                   name="sin_agujeros"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_vehiculos->sin_agujeros == 1)
                                   checked
                                   @endif
                                   id="sin_agujeros">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_agujeros">Sin
                                agujeros</label>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_vehiculo">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text"
                                   readonly
                                   name="observaciones_vehiculo"
                                   value="{{$recepcion->inspeccion_vehiculos->observaciones}}"
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
                                   class="custom-control-input"
                                   name="no_golpeado"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->no_golpeado == 1 )
                                   checked
                                   @endif
                                   id="no_golpeado">
                            <label class="custom-control-label" style="font-weight: normal" for="no_golpeado">No
                                golpeado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="sin_roturas"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->sin_roturas == 1 )
                                   checked
                                   @endif
                                   id="sin_roturas">
                            <label class="custom-control-label" style="font-weight: normal" for="sin_roturas">Sin
                                rotulas</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->cerrado == 1 )
                                   checked
                                   @endif
                                   name="empaque_cerrado"
                                   id="empaque_cerrado">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="empaque_cerrado">Cerrado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="seco_limpio"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->seco_limpio == 1 )
                                   checked
                                   @endif
                                   id="seco_limpio">
                            <label class="custom-control-label" style="font-weight: normal" for="seco_limpio">Seco y
                                Limpio</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->sin_material_extranio == 1 )
                                   checked
                                   @endif
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
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->debidamente_identificado == 1 )
                                   checked
                                   @endif
                                   name="debidamente_identificado"
                                   id="debidamente_identificado">
                            <label class="custom-control-label" for="debidamente_identificado">Producto debidamente
                                identificado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="debidamente_legible"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->identificacion_legible == 1 )
                                   checked
                                   @endif
                                   id="debidamente_legible">
                            <label class="custom-control-label" for="debidamente_legible">Identificación de producto
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->no_lote_presente == 1 )
                                   checked
                                   @endif
                                   name="no_lote_presente"
                                   id="no_lote_presente">
                            <label class="custom-control-label" for="no_lote_presente">No. de lote presente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="no_lote_legible"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->no_lote_legible == 1 )
                                   checked
                                   @endif
                                   id="no_lote_legible">
                            <label class="custom-control-label" for="no_lote_legible">No. de lote legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="fecha_vencimiento_legible"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->fecha_vencimiento_legible == 1 )
                                   checked
                                   @endif
                                   id="fecha_vencimiento_legible">
                            <label class="custom-control-label" for="fecha_vencimiento_legible">Fecha de vencimiento
                                presente y
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->fecha_vencimiento_vigente == 1 )
                                   checked
                                   @endif
                                   name="fecha_vencimiento_vigente"
                                   value="1"
                                   id="fecha_vencimiento_vigente">
                            <label class="custom-control-label" for="fecha_vencimiento_vigente">Fecha de vencimiento
                                vigente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   name="contenido_neto_declarado"
                                   value="1"
                                   onclick="return false"
                                   @if($recepcion->inspeccion_empaque->contenido_neto_declarado == 1 )
                                   checked
                                   @endif
                                   id="contenido_neto_declarado">
                            <label class="custom-control-label" for="contenido_neto_declarado">Contenido Neto
                                declarado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="observaciones_empaque">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text"
                                   readonly
                                   name="observaciones_empaque"
                                   value="{{$recepcion->inspeccion_empaque->observaciones}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">


                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>CANTIDAD</th>
                            <th>NO. LOTE</th>
                            <th>FECHA VENCIMIENTO</th>
                            </thead>
                            <tbody>
                            @foreach( $recepcion->detalle_lotes as $lote )
                                <tr>
                                    <td>{{$lote->cantidad}}</td>
                                    <td>{{$lote->no_lote}}</td>
                                    <td>{{$lote->fecha_vencimiento->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('recepcion/materia_prima')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
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
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                        ACEPTAR
                    </button>
                </div>
            </div>
        </div>

    </div>



@endsection

