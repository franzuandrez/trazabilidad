@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-cutlery',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Pre-cocido de Pasta
        @endslot
    @endcomponent


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   readonly
                   value = "{{$precocido->no_orden}}"
                   class="form-control">

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text" name="no_orden_produccion"
                   id="no_orden_produccion"
                   readonly
                   value="{{$precocido->turno}}"
                   class="form-control">
        </div>
    </div>




    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>HORA INICIO</th>
                <th>HORA SALIDA</th>
                <th>TIEMPO EFECTIVO</th>
                <th>ALCANCE PRESION</th>
                <th>TEMPERATURA</th>
                <th>OBSERVACIONES</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $precocido->detalle as $detalle )
                <tr>
                    <td>{{$detalle->producto->descripcion}}</td>
                    <td>{{$detalle->lote}}</td>
                    <td>{{$detalle->hora_inicio}}</td>
                    <td>{{$detalle->hora_salida}}</td>
                    <td>{{$detalle->tiempo_efectivo}}</td>
                    <td>{{$detalle->alcance_presion}}</td>
                    <td>{{$detalle->temperatura}}</td>
                    <td>{{$detalle->observaciones}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/precocido')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection
