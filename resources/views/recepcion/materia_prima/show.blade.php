@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-th-large',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. Documento</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
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

    <input type="hidden" id="id_proveedor" name="id_proveedor" value="{{$recepcion->proveedor->id_proveedor}}">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Proveedor</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->razon_social}}"
                   class="form-control">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #f7b633;  color: #fff;">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>No. Lote</th>
            <th>Fecha Vencimiento</th>
            </thead>
            <tbody>
            @foreach( $recepcion->detalle_lotes as $lote )
                <tr>
                    <td>{{$lote->producto->descripcion}}</td>
                    <td>{{$lote->cantidad}}</td>
                    <td>{{$lote->no_lote}}</td>
                    <td>{{$lote->fecha_vencimiento->format('d/m/Y')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('recepcion/materia_prima')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>
    <div class="modal fade modal-slide-in-right" aria-hidden="true"
         role="dialog" tabindex="-1" id="not_found">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" align="center">PRODUCTO NO ENCONTRADO</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>
                        ACEPTAR
                    </button>
                </div>
            </div>
        </div>

    </div>



@endsection

