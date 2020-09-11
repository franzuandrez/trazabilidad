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



    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   id="id_producto" name="id_producto"
                   value="{{$mezcla_harina->control_trazabilidad->liberacion_linea->producto->descripcion}}">

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="producto">PRESENTACION</label>
            <input class="form-control selectpicker valor"
                   disabled
                   required
                   id="id_producto" name="id_producto"
                   value="{{$mezcla_harina->control_trazabilidad->liberacion_linea->presentacion->descripcion}}">

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input id="lote" type="text" name="lote"
                   disabled

                   value="{{$mezcla_harina->lote}}"
                   class="form-control">
        </div>
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

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>



                <th>HORA CARGA</th>
                <th>HORA DESCARGA</th>
                <th>V. SECO</th>
                <th>V. ALTA</th>
                <th>V. BAJO</th>
                <th>V. OBSERVACIONES</th>
                <th>SOLUCION INICAL</th>
                <th>OBSERVACIONES</th>
                <th>PH INICIAL</th>
                <th>OBSERVACIONES</th>
                <th>VERIFICACION TAMIZ</th>
                <th>OBSERVACIONES TAMIZ</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mezcla_harina->detalle as $detalle)
                <tr>

                    <td>
                        {{$detalle->hora_carga}}
                        <input type="hidden"
                               id="hora_carga-{{$detalle->id_det_mezclaharina}}"
                        >
                    </td>
                    <td>{{$detalle->hora_descarga}}
                        <input type="hidden"
                               id="hora_descarga-{{$detalle->id_det_mezclaharina}}"
                        >
                    </td>
                    <td>{{$detalle->tiempo_seco}}
                    <td>{{$detalle->tiempo_alta}}
                    <td>{{$detalle->tiempo_baja}}
                    <td>{{$detalle->tiempos_observaciones}}
                    <td>{{$detalle->solucion_inicial}}
                    </td>
                    <td>
                        {{$detalle->solucion_observacion}}
                        <input type="hidden"
                               id="solucion_observacion-{{$detalle->id_det_mezclaharina}}"
                        >
                    </td>
                    <td>{{$detalle->ph_inicial}}
                    </td>
                    <td>{{$detalle->ph_observacion}}
                        <input type="hidden"
                               id="ph_observacion-{{$detalle->id_det_mezclaharina}}"
                        >
                    </td>
                    <td>{{$detalle->verificacion_tamiz}}
                    <td>{{$detalle->observaciones_tamiz}}
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/mezcla_harina')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>


@endsection



