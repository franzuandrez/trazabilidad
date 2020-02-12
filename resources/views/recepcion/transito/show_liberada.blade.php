@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-arrow-right',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Control Calidad
        @endslot
    @endcomponent



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. DOCUMENTO</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->nombre_comercial}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text"
                   readonly
                   name="documento_proveedor"
                   value="{{$recepcion->documento_proveedor}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>

    <input type="hidden" name="observaciones" id="observaciones">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>FECHA VENCIMIENTO</th>
                    <th>CANTIDAD</th>
                    <th>CANTIDAD ENTRANTE</th>
                    <th>CANTIDAD RECHAZADA</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $movimientos as $key => $mov)

                    <tr id="mov-{{$mov->id_rmi_detalle}}" class="row-producto">
                        <td>
                            {{$mov->producto->descripcion}}
                        </td>
                        <td>
                            {{$mov->lote}}
                            <input type="hidden" name="lote[]" value="{{$mov->lote}}">
                        </td>
                        <td>
                            {{$mov->fecha_vencimiento->format('d/m/Y')}}
                            <input type="hidden" name="fecha_vencimiento[]"
                                   value="{{$mov->fecha_vencimiento->format('Y-m-d')}}">
                        </td>
                        <td>
                            {{$mov->total }}

                        </td>
                        <td>
                            {{$mov->cantidad_entrante}}
                        </td>
                        <td>
                            {{$mov->total-$mov->cantidad_entrante}}
                        </td>


                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('recepcion/transito')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>
@endsection
