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
    @component('componentes.nav',['operation'=>'Continuar',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-list-alt ',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


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
                   name="lote_produccion"
                   id="lote_produccion"
                   value="{{$control->lote}}"
                   {{$control->lote!=''?'readonly':''}}
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   {{$control->id_turno!=''?'readonly':''}}
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
                   {{$control->cantidad_programada!=''?'readonly':''}}
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
                        @isset($control)
                            @foreach($control->detalle_insumos as $insumo)
                                <tr>

                                    <td>
                                        <input
                                            type="hidden"
                                            name="id_insumo[]"
                                            value="{{$insumo->id_detalle_insumo}}">
                                        {{$insumo->producto->descripcion}}
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
