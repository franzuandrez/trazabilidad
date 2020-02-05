@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
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


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="no_orden_produccion"
                   readonly
                   value="{{$laminado->no_orden}}"
                   onkeydown="if(event.keyCode==13)iniciar_control_laminado()"
                   id="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input id="temperatura_inicial" type="text"
                   required
                   readonly
                   name="temperatura_inicial"
                   value="{{$laminado->turno}}"
                   class="form-control">
        </div>
    </div>





    <div class="tab-pane" id="tab_3">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>HORA</th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>TEMPERATURA</th>
                <th>OBSERVACIONES</th>
                <th>ESPESOR</th>
                <th>OBSERVACIONES</th>
                </thead>
                <tbody>
                @foreach($laminado->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->producto->descripcion}}</td>
                        <td>{{$detalle->lote_producto}}</td>
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
PE

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
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection

