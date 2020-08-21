@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12    col-md-12   col-xs-12">
        <h3>VERIFICACION DE MATERIA PRIMA EN MEZCLADORA</h3>
    </div>

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-check-circle',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Verificacion Materias
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/verificacion_materias/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" id="id_control" name="id_control" value="{{$verificacion->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled
           value="{{$verificacion->id_control}}">




    @include('componentes.loading')
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$verificacion->control_trazabilidad->id_producto}}" selected>
                    {{$verificacion->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker "
                   value="{{$verificacion->id_turno}}"
                   id="id_turno" name="id_turno" disabled>

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">



        <div class="tab-pane" id="tab_3">

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #01579B;  color: #fff;">
                    <th>HORA</th>
                    <th>BATCH NO</th>
                    <th>EQUIPO</th>
                    <th>CANTIDAD PH</th>
                    <th>CANTIDAD CARGA</th>
                    <th>AGUA</th>
                    <th>BASE VITAMINA</th>
                    <th>CARBONATO SODIO - LOTE</th>
                    <th>CARBONATO SODIO - CANTIDAD</th>
                    <th>COLORANTE - LOTE</th>
                    <th>COLORANTE - CANTIDAD</th>
                    <th>CMC - LOTE</th>
                    <th>CMC - CANTIDAD</th>
                    <th>OBSERVACIONES</th>
                    </thead>
                    <tbody>
                    @foreach($verificacion->detalle as $detalle)
                        <tr>
                            <td>{{$detalle->hora}}</td>
                            <td>{{$detalle->batch_no}}</td>
                            <td>{{$detalle->equipo}}</td>
                            <td>{{$detalle->cantidad_ph}}</td>
                            <td>{{$detalle->cantidad_carga}}</td>
                            <td>{{$detalle->cantidad_agua}}</td>
                            <td>{{$detalle->cantidad_base_vitamina}}</td>
                            <td>{{$detalle->lote_carbonato_sodio}}</td>
                            <td>{{$detalle->cantidad_carbonato_sodio}}</td>
                            <td>{{$detalle->lote_colorante_amarillo}}</td>
                            <td>{{$detalle->cantidad_colorante_amarillo}}</td>
                            <td>{{$detalle->lote_cmc}}</td>
                            <td>{{$detalle->cantidad_cmc}}</td>
                            <td>{{$detalle->observaciones}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion_correctiva"  readonly  value="{{$verificacion->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/verificacion_materias')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}

@endsection

