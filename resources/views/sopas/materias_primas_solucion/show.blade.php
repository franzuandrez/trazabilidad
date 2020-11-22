@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    @include('sopas.materias_primas_solucion.title')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa fa-check-circle',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Sopas
        @endslot
        @slot('submenu')
            Verificacion Materias
        @endslot
    @endcomponent


    <input type="hidden" id="id_control" name="id_control" value="{{$formulario->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled
           value="{{$formulario->id_control}}">


    @include('componentes.loading')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$formulario->control_trazabilidad->id_producto}}" selected>
                    {{ $formulario->control_trazabilidad->producto->codigo_interno}}
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="lote">No.  Lote</label>
        <div class="form-group">
            <input class="form-control selectpicker valor"
                   disabled
                   value="{{$formulario->lote}}"
                   id="lote" name="lote">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                @include('sopas.materias_primas_solucion.header_tabla')
                <tbody>
                @foreach($formulario->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->batch_no}}</td>
                        <td>{{$detalle->equipo}}</td>
                        <td>{{$detalle->cantidad_ph}}</td>
                        <td>{{$detalle->cantidad_agua}}</td>
                        <td>{{$detalle->lote_sal}}</td>
                        <td>{{$detalle->lote_carbonato_sodio}}</td>
                        <td>{{$detalle->cantidad_carbonato_sodio}}</td>
                        <td>{{$detalle->lote_hex_sodio}}</td>
                        <td>{{$detalle->cantidad_hex_sodio}}</td>
                        <td>{{$detalle->lote_goma_xantan}}</td>
                        <td>{{$detalle->cantidad_goma_xantan}}</td>
                        <td>{{$detalle->lote_cmc}}</td>
                        <td>{{$detalle->cantidad_cmd}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion_correctiva"
                   value="{{$formulario->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('sopas/solucion')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>


@endsection



