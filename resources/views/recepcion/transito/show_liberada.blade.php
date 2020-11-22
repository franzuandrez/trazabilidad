@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-list',
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
                   value="{{$recepcion->proveedor->nombre_comercial}}"
                   class="form-control">
        </div>
    </div>

    @if($rmi_encabezado->observaciones !== null )
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="observaciones">OBSERVACIONES</label>
                <input type="text"
                       readonly
                       name="observaciones"
                       value="{{$recepcion->rmi_encabezado->observaciones}}"
                       class="form-control">
            </div>
        </div>
    @endif
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>

    <input type="hidden" name="observaciones" id="observaciones">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>Producto</th>
                    <th>No. Lote</th>
                    <th>Fecha Vencimiento</th>
                    <th>Cantidad</th>
                    <th>Cantidad Entrante</th>
                    <th>CANTIDAD RECHAZADA</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $movimientos as $key => $mov)

                    <tr id="mov-{{$mov->id_rmi_detalle}}" class="row-producto {{$mov->total-$mov->cantidad_entrante >0 ?'danger':'default'}}">
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
                        <td >
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
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>
@endsection
