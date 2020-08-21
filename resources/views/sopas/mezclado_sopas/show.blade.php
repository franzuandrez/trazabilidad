@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12    col-md-12    col-xs-12">
        <h3>CONTROL MEZCLADO DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-dot-circle-o',
    'submenu_icon'=>'fa fa-balance-scale',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control Sopas
        @endslot
        @slot('submenu')
            Mezclado Sopas
        @endslot
    @endcomponent



    <input type="hidden" id="id_control" name="id_control" value="{{$mezclado_sopas->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion"
           disabled
           value="{{$mezclado_sopas->id_control}}">

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$mezclado_sopas->control_trazabilidad->id_producto}}"
                        selected>
                    {{$mezclado_sopas->control_trazabilidad->liberacion_sopas->producto->descripcion}}
                </option>
            </select>
        </div>
    </div>
    @include('componentes.loading')
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input class="form-control selectpicker valor"
                   disabled
                   value="{{$mezclado_sopas->lote}}"
                   id="lote" name="lote">
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">TURNO</label>
        <div class="form-group">
            <input class="form-control selectpicker "
                   id="id_turno" name="id_turno"
                   value="{{$mezclado_sopas->id_turno}}"
                   disabled>

        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">



        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>NO. BACH</th>
                <th>HORA INICIO</th>
                <th>HORA FINALIZO</th>
                <th>TIEMPO VELOCIDAD ALTA</th>
                <th>TIEMPO VELOCIDAD BAJA</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach( $mezclado_sopas->detalle as $detalle )
                    <tr>
                        <td>{{$detalle->no_batch}}</td>
                        <td>{{$detalle->hora_inicio_mezcla}}</td>
                        <td>{{$detalle->hora_fin_mezcla}}</td>
                        <td>{{$detalle->tiempo_velocidad_alta}}</td>
                        <td>{{$detalle->tiempo_velocidad_baja}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="observaciones_generales">OBSERVACIONES</label>
                <input type="text" name="observaciones_generales" value="{{$mezclado_sopas->observaciones}}"
                       readonly
                       class="form-control">
            </div>
        </div>
    </div>




    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('sopas/mezclado_sopas')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection


