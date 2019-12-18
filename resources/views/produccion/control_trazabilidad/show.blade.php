@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa-list-alt  ',
    'operation_icon'=>'fa fa-eye',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   readonly
                   name="codigo_producto"
                   id="codigo_producto"
                   value="{{$operacion->producto->codigo_interno}}"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   value="{{$operacion->producto->descripcion}}"
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
                   value="{{$operacion->producto->unidad_medida}}"
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   id="best_by"
                   value="{{$operacion->fecha_vencimiento->format('d/m/Y')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO. ORDEN PRODUCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   value="{{$operacion->no_orden_produccion}}"
                   id="no_orden_produccion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">LOTE</label>
            <input type="text"
                   name="lote_pt"
                   id="lote"
                   value="{{$operacion->lote}}"
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
                   value="{{$operacion->id_turno}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   value="{{$operacion->cantidad_programada}}"
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
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    OPERARIOS INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="insumos">
                <br>
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
                        @foreach($operacion->detalle_insumos as $insumo)
                            <tr>
                                <td>
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
                                <td>
                                    {{$insumo->fecha_vencimiento->format('d/m/Y')}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane " id="involucrados">
                <br>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>
                                ACTIVIDAD
                            </th>
                            <th>
                                COLABORADORES
                            </th>
                        </tr>
                        </thead>
                        <tbody id="asociaciones">
                        @foreach( $operacion->actividades as $actividad)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$actividad->actividad->descripcion}}</td>
                                <td>
                                    <table class="table table-bordered">
                                        @php
                                             $i = 0;
                                        @endphp
                                        @foreach($operacion->asistencias as $asistencia )
                                            @if($asistencia->id_actividad == $actividad->id_actividad)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>{{$asistencia->colaborador->nombre .' '. $asistencia->colaborador->apellido  }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </td>
                            </tr>
                        @endforeach

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
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}">
@endsection
