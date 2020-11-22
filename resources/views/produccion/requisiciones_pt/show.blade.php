@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa  fa fa-file-text  ',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent

    <input name="id_requisicion" type="hidden" id="id_requisicion">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_requision">NO.REQUISION</label>
            <input type="text"
                   readonly
                   name="no_requisicion"
                   id="no_requisicion"
                   onkeydown="if(event.keyCode==13)validarRequisicion()"
                   value="{{$requisicion->no_requision}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO.ORDEN PRODUCCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   onkeydown="if(event.keyCode==13)validarOrdenProduccion()"
                   id="no_orden_produccion"
                   value="{{$requisicion->no_orden_produccion}}"
                   class="form-control">
        </div>
    </div>

    @if($requisicion->estado == "D")
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <th>Cantidad</th>
                <th>CODIGO PRODUCTO</th>
                <th>Producto</th>
                <th>DETALLE</th>
                </thead>
                <tbody id="body-detalles">
                @foreach( $requisicion->detalle as $detalle )
                    <tr>
                        <td>
                            {{$detalle->cantidad}}
                        </td>
                        <td>
                            {{$detalle->producto->codigo_barras}}
                        </td>
                        <td>
                            {{$detalle->producto->descripcion}}
                        </td>

                        <td>
                            <table class="table">
                                <tr>
                                    <th>No. Lote</th>
                                    <th>Cantidad</th>
                                </tr>
                                @foreach( $requisicion->reservas->where('id_producto',$detalle->producto->id_producto) as $lote  )

                                <tr>
                                    <td>{{$lote->lote}}</td>
                                    <td>{{$lote->cantidad}}</td>
                                </tr>
                                @endforeach
                            </table>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <th>Cantidad</th>
                <th>CODIGO PRODUCTO</th>
                <th>Producto</th>

                </thead>
                <tbody id="body-detalles">
                @foreach( $requisicion->detalle as $detalle )
                    <tr>
                        <td>
                            {{$detalle->cantidad}}
                        </td>
                        <td>
                            {{$detalle->producto->codigo_barras}}
                        </td>
                        <td>
                            {{$detalle->producto->descripcion}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('produccion/requisiciones')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}
@endsection

