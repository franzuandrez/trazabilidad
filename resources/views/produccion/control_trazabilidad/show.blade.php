@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>DOCUMENTO TRAZABILIDAD</h3>
    </div>

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa-exchange  ',
    'operation_icon'=>'fa fa-eye',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Trazabilidad
        @endslot
    @endcomponent

    <div>
        <h3>Informacion de producción</h3>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">Cod. Producto</label>
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
            <label for="producto">Producto</label>
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
            <label for="unidad_medida">U.Medida</label>
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
            <label for="best_by">Fecha Vencimiento</label>
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
            <label for="no_orden_produccion">Ordenes</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   value="{{
                   $operacion
                   ->requisiciones
                   ->reduce(
                       function ($carry,$item){
                            return
                            $item->no_orden_produccion.','.$carry;
                       })
                   }}"
                   id="no_orden_produccion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">No. Lote</label>
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
            <label for="cantidad_programada">Cantidad Programada</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   value="{{$operacion->cantidad_programada}}"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_produccion">Cantidad Produccion</label>
            <input type="text"
                   name="cantidad_produccion"
                   id="cantidad_produccion"
                    readonly
                   value="{{$operacion->cantidad_producida }}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    Insumos
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    Colaboradores
                </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="insumos">
                <br>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #f7b633;  color: #fff;">
                        <tr>
                            <th>Insumo</th>
                            <th>No Lote</th>
                            <th>Cantidad</th>
                            <th>Fecha Venc.</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_insumos">
                        @foreach($operacion->detalle_insumos as $insumo)
                            <tr>
                                <td>
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane " id="involucrados">
                <br>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #f7b633;  color: #fff;">
                        <tr>
                            <th>#</th>
                            <th>
            Actividad
                            </th>
                            <th>
            Colaboradores
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
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}">
@endsection
