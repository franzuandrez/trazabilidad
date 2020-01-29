@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

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


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   readonly
                   value="{{$humedo->no_orden}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input id="cortadora" type="text"
                   readonly
                   value="{{$humedo->turno}}"
                   class="form-control">
        </div>
    </div>




    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>
                <th>HORA</th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
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
                    <td>{{$detalle->producto()->first()->descripcion}}</td>
                    <td>{{$detalle->lote}}</td>
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
                   value = "{{$humedo->observaciones}}"
                   class="form-control">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/peso_seco')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>

@endsection

