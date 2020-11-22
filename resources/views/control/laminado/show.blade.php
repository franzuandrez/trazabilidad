@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-md-12    col-xs-12">
        <h3>CONTROL DE LAMINADO DE CHAO MEIN</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-th',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Laminado
        @endslot
    @endcomponent



    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="producto">Producto</label>
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   id="id_producto" name="id_producto"
                   value="{{$laminado->control_trazabilidad->liberacion_linea->producto->descripcion}}">

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="producto">PRESENTACION</label>
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   id="id_producto" name="id_producto"
                   value="{{$laminado->control_trazabilidad->liberacion_linea->presentacion->descripcion}}">

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote">No.  Lote</label>
            <input id="lote" type="text" name="lote"
                   disabled

                   value="{{$laminado->lote}}"
                   class="form-control">
        </div>
    </div>




    <div class="tab-pane" id="tab_3">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <th>HORA</th>
                <th>  TEMPERATURA REPOSO 34-36 °C</th>
                <th>OBSERVACIONES</th>
                <th> ESPESOR 1.25 A 1.30 (milimetros)</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach($laminado->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>

                        <td>{{$detalle->temperatura_inicio}}</td>
                        <td>{{$detalle->temperatura_observaciones}}</td>
                        <td>{{$detalle->espesor_inicio}}</td>
                        <td>{{$detalle->espesor_observaciones}}</td>
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
                   readonly
                   value="{{$laminado->observaciones}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('control/laminado')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>


@endsection

