@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>
        .ocultar {
            visibility: hidden;
        }

        .mostrar {
            visibility: visible;
        }
    </style>
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE TRAZABILIDAD</h3>
    </div>
    @component('componentes.nav',['operation'=>'Finalizado',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-list-alt ',
    'operation_icon'=>'fa-check',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent


    <input type="hidden" name="id_producto" id="id_producto" value="{{$control->id_producto}}">
    <input type="hidden" name="id_control" id="id_control" value="{{$control->id_control}}">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   value="{{$control->producto->descripcion}}"
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-2 col-md-2 col-xs-6">
        <div class="form-group">
            <label for="unidad_medida">U.MEDIDA</label>
            <input type="text"
                   name="unidad_medida"
                   readonly
                   value="{{$control->producto->unidad_medida}}"
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   value="{{$control->fecha_vencimiento->format('d/m/Y')}}"
                   id="best_by"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ordenes">ORDENES</label>
            <input type="text"
                   name="ordenes"
                   id="ordenes"
                   value="{{
                   substr_replace(
                           $control->requisiciones->reduce(function($carry,$item){
                                return $item->no_orden_produccion.",".$carry;
                           }),"",-1
                       )
                   }}"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">LOTE</label>
            <input type="text"
                   name="lote_pt"
                   id="lote"
                   value="{{$control->lote}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   readonly
                   value="{{$control->id_turno}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   value="{{$control->cantidad_programada}}"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_produccion">CANTIDAD PRODUCCION</label>
            <input type="text"
                   name="cantidad_produccion"
                   id="cantidad_produccion"
                   {{$control->cantidad_producida !=null && $control->cantidad_producida !="" ? 'disabled':''}}
                   value="{{$control->cantidad_producida }}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    INSUMOS
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    COLABORADORES INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="insumos">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>INSUMO</th>
                            <th>COLOR</th>
                            <th>OLOR</th>
                            <th>IMPRESION</th>
                            <th>AUSENCIA DE ME</th>
                            <th>LOTE</th>
                            <th>CANTIDAD</th>
                            <th>CANTIDAD UTILIZADA</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_insumos">
                        @foreach($control->detalle_insumos as $insumo)
                            <tr>
                                <td>
                                    <input type="hidden" name="insumo[]" value="{{$insumo->id_detalle_insumo}}">
                                    {{$insumo->producto->codigo_interno}}
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
                                <td >
                                    {{$insumo->cantidad_utilizada}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane " id="involucrados">
                <br>
                @include('produccion.control_trazabilidad.listado_colaboradores')
            </div>
        </div>

    </div>

    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    @include('produccion.control_trazabilidad.colaboradores')

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>

@endsection
