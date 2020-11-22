@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-shopping-cart',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Asignar Ubicacion
        @endslot
    @endcomponent

    {!!Form::model($recepcion,['method'=>'PATCH','route'=>['recepcion.transito.ingresar',$recepcion->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">No. Documento</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">Proveedor</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->razon_social}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO Proveedor</label>
            <input type="text"
                   readonly
                   name="documento_proveedor"
                   value="{{$recepcion->documento_proveedor}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>No. Lote</th>
                    <th>Fecha Vencimiento</th>
                </tr>
                </thead>
                <tbody>

                @foreach( $movimientos as $mov)

                    <tr id="mov-{{$mov->id_movimiento}}">
                        <td>
                            {{$mov->cantidad_entrante}}
                        </td>
                        <td>
                            {{$mov->producto->descripcion}}
                        </td>
                        <td>
                            {{$mov->lote}}
                            <input type="hidden" name="lote[]" value="{{$mov->lote}}">
                        </td>
                        <td>
                            {{$mov->fecha_vencimiento->format('d/m/Y')}}
                            <input type="hidden" name="fecha_vencimiento[]" value="{{$mov->fecha_vencimiento}}">
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('recepcion/ubicacion')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>
@endsection

