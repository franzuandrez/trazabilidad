@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12   col-sm-push-3   col-md-12   col-md-push-3  col-xs-12">
        <h3>CONTROL MEZCLA DE HARINA Y SOLUCION CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-spoon',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Mezcla Harina
        @endslot
    @endcomponent



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_mezcla_harina()"
                   readonly
                   value="{{$mezcla_harina->no_orden}}"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
        </div>
    </div>





    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>HORA CARGA</th>
                <th>HORA DESCARGA</th>
                <th>SOLUCION INICAL</th>
                <th>OBSERVACIONES</th>
                <th>PH INICIAL</th>
                <th>OBSERVACIONES</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mezcla_harina->detalle as $detalle)
                <tr>
                    <td>{{$detalle->producto->descripcion}}</td>
                    <td>{{$detalle->lote}}</td>
                    <td>{{$detalle->hora_carga}}</td>
                    <td>{{$detalle->hora_descarga}}</td>
                    <td>{{$detalle->solucion_inicial}}</td>
                    <td>{{$detalle->solucion_observacion}}</td>
                    <td>{{$detalle->ph_inicial}}</td>
                    <td>{{$detalle->ph_observacion}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion" id="observacion"
                   readonly
                   value="{{$mezcla_harina->observaciones}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/mezcla_harina')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection



