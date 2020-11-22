@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-2 col-sm-12   col-sm-push-3   col-md-12   col-md-push-3  col-xs-12">
        <h3>REGISTRO DE PARAMETROS EN LAMINADO Y PRECOCCION DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Laminado y Precocción de Sopas
        @endslot
    @endcomponent

    <input type="hidden" id="id_control" name="id_control" value="{{$laminado->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled value="{{$laminado->id_control}}">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto"
                    name="id_producto">
                <option value="{{$laminado->control_trazabilidad->id_producto}}" selected>
                    {{$laminado->control_trazabilidad->liberacion_sopas->producto->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">No.  Lote</label>

            <input class="form-control selectpicker valor"
                   disabled
                   value="{{$laminado->lote}}"
                   id="lote" name="lote">


        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker "
                   id="id_turno" name="id_turno"
                   value="{{$laminado->id_turno}}"
                   disabled>

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class=" table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <th>HORA (CADA 15 MIN)</th>
                <th>VELOCIDAD DE LAMINADO (RPM)</th>
                <th>ESPESOR DE LAMINA 0.98 A 1.03 MM</th>
                <th>PRESIÓN REGULADOR DE VAPOR (0.2 A 0.3 MPA)</th>
                <th>INDICE PRECOCCIÓN (CUALITATIVO)</th>
                <th>TEMP.  DE PRECOCCIÓN MAS DE 90 °C  INICIO</th>
                <th>TEMP.  DE PRECOCCIÓN MAS DE 90 °C  SALIDA</th>
                <th>TIEMPO DE PRECOCCIÓN 2:00 A 2:55 MIN</th>
                <th>VELOCIDAD (COTRES * MIN)</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach($laminado->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->velocidad_laminado}}</td>
                        <td>{{$detalle->espesor_lamina}}</td>
                        <td>{{$detalle->presion_regulador_vapor}}</td>
                        <td>{{$detalle->indice_precoccion}}</td>
                        <td>{{$detalle->temperatura_precoccion_inicio}}</td>
                        <td>{{$detalle->temperatura_precoccion_salida}}</td>
                        <td>{{$detalle->tiempo_precoccion}}</td>
                        <td>{{$detalle->velocidad}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="acciones">ACCIONES/CORRECTIVAS</label>
                <input type="text" name="acciones" value="{{$laminado->observaciones}}"
                       readonly
                       class="form-control">
            </div>
        </div>
    </div>
    @include('componentes.loading')

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('sopas/laminado')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>


@endsection


