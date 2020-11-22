@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE PESO SECO DE CHAO MEIN</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ver',
   'menu_icon'=>'fa fa-check-square-o',
   'submenu_icon'=>'fa fa-bar-chart',
   'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Seco
        @endslot
    @endcomponent


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option value="{{$humedo->control_trazabilidad->id_producto}}" selected>
                    {{$humedo->control_trazabilidad->liberacion_linea->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker"
                   id="id_turno"
                   value="{{$humedo->turno}}"
                   name="id_turno" disabled>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote">No.  Lote</label>
            <input class="form-control selectpicker valor"
                   disabled
                   id="lote" name="lote"
                   value="{{$humedo->lote}}"
            >


        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #f7b633;  color: #fff;">
            <tr>
                <th>HORA</th>
                <th>NO. 1</th>
                <th>NO. 2</th>
                <th>NO. 3</th>
                <th>NO. 4</th>
                <th>NO. 5</th>
                <th>OBSERVACIONES</th>
            </tr>

            </thead>

            <tbody>
            @foreach( $humedo->detalle as $detalle )
                <tr>
                    <td>{{$detalle->hora}}</td>
                    <td>{{$detalle->muestra_no1}}</td>
                    <td>{{$detalle->muestra_no2}}</td>
                    <td>{{$detalle->muestra_no3}}</td>
                    <td>{{$detalle->muestra_no4}}</td>
                    <td>{{$detalle->muestra_no5}}</td>
                    <td>{{$detalle->observaciones}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion_correctiva"
                   readonly
                   value="{{$humedo->observaciones}}"
                   class="form-control">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/peso_seco')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>

@endsection

