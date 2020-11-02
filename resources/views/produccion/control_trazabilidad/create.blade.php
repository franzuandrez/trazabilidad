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
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-list-alt ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    @include('produccion.partials.orden_produccion_sugerida')

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <input type="hidden" id="id_requisicion" name="id_requisicion">
        <label for="codigo_producto">CODIGO PRODUCTO</label>
        <div class="input-group">
            <input type="text"
                   name="codigo_producto"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_producto_terminado()"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    onclick="buscar_producto_terminado()"
                    onkeydown="buscar_producto_terminado()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
                <button
                    onclick="limpiar_formulario()"
                    onkeydown="limpiar_formulario()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-trash"
                       aria-hidden="true"></i>
                </button>
            </div>

        </div>


    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <input type="hidden" name="id_control" id="id_control">
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-1 col-sm-2 col-md-2 col-xs-6">
        <div class="form-group">
            <label for="unidad_medida">U.MEDIDA</label>
            <input type="text"
                   name="unidad_medida"
                   readonly
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   id="best_by"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="no_orden_produccion">NO. ORDEN PRODUCION</label>
        <div class="input-group">
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   onkeydown="if(event.keyCode==13)buscar_orden_produccion()"
                   id="no_orden_produccion"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    onclick="buscar_orden_produccion()"
                    onkeydown="buscar_orden_produccion()"
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
                <button type="button"
                        id="btn_agregar"
                        onclick="limpiar_orden_produccion()"
                        onkeydown="limpiar_orden_produccion()"
                        class="btn btn-default">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
            </div>

        </div>

    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ordenes">ORDENES</label>
            <input type="text"
                   name="ordenes"
                   id="ordenes"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote_produccion">LOTE</label>
            <input type="text"
                   name="lote_produccion"
                   id="lote_produccion"
                   data-index="1"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-4col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   data-index="2"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="number"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   data-index="3"
                   readonly
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

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="insumos">
                <br>
                @include('produccion.control_trazabilidad.panel_agregar_insumos')
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>MP</th>
                            <th>NO LOTE</th>
                            <th>CANTIDAD</th>
                            <th>FECHA VENC.</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_insumos">
                        </tbody>
                    </table>
                </div>
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
            <button class="btn btn-default"
                    type="button"
                    onclick="guardar()"
            >
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}
@endsection
@section('scripts')
    @include('produccion.control_trazabilidad.main_script')
@endsection
