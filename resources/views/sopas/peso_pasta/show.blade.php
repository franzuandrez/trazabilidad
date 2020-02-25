@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12     col-md-12    col-xs-12">
        <h3>CONTROL DE PESO DE PASTA DE SOPAS INSTANTANEAS</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-signal',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Pasta
        @endslot
    @endcomponent




    <input type="hidden" id="id_control" name="id_control" value="{{$peso->id_control}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled="" value="{{$peso->id_control}}">


    @include('componentes.loading')
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="id_producto" name="id_producto">
                <option
                    value="{{$peso->control_trazabilidad->id_producto}}"
                    selected>
                    {{$peso->control_trazabilidad->liberacion_sopas->presentacion->descripcion}}
                </option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   value="{{$peso->lote}}"
                   id="lote" name="lote">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input class="form-control selectpicker"
                   id="id_turno"
                   value="{{$peso->id_turno}}"
                   name="id_turno" disabled>
        </div>
    </div>





    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">




        <input type="hidden" name="hora" id="hora">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>HORA</th>
                    <th>NO. 1</th>
                    <th>NO. 2</th>
                    <th>NO. 3</th>
                    <th>NO. 4</th>
                    <th>Largo Fideo</th>
                    <th>OBSERVACIONES</th>
                </tr>

                </thead>
                <tbody>
                @foreach($peso->detalle as $detalle)
                    <tr>
                        <td>{{$detalle->hora}}</td>
                        <td>{{$detalle->no_1}}</td>
                        <td>{{$detalle->no_2}}</td>
                        <td>{{$detalle->no_3}}</td>
                        <td>{{$detalle->no_4}}</td>
                        <td>{{$detalle->largo_fideo}}</td>
                        <td>{{$detalle->observaciones}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
                <input type="text" name="observacion_correctiva" value="{{$peso->observaciones}}"
                       readonly
                       class="form-control">
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <a href="{{url('sopas/peso_pasta')}}">
                    <button class="btn btn-default" type="button">
                        <span class="fa fa-backward"></span>
                        REGRESAR
                    </button>
                </a>

            </div>
        </div>
    </div>


@endsection

