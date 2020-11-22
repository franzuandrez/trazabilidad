@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-archive ',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Entrega PT
        @endslot
    @endcomponent

    <div class="col-lg-4 col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">ENTREGA</label>
            <input type="text"
                   readonly
                   value="{{$entrega->id}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">CREADO POR </label>
            <input type="text"
                   readonly
                   value="{{$entrega->creado_por->nombre}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4  col-sm-4  col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">FECHA</label>
            <input type="text"
                   readonly
                   value="{{$entrega->fecha_hora->format('H:i:s d/m/Y')}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #f7b633;  color: #fff;">
            <th>Producto</th>
            <th>Unidad Medida</th>
            <th>Cantidad</th>
            <th>NO. TARIMA</th>
            </thead>
            <tbody id="detalle">
            @foreach($entrega->detalle as $detalle)
                <tr>
                    <td>{{$detalle->control_trazabilidad->producto->codigo_interno}}</td>
                    <td>{{$detalle->unidad_medida}}</td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>{{$detalle->no_tarima}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('produccion/entrega_pt')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>


@endsection



