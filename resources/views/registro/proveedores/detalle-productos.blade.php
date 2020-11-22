@extends('layouts.admin')
@section('style')
    <style>
        .page-header {
            margin-top: 20px;
            margin-bottom: 02px;
            padding-bottom: 0;
        }
    </style>
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Productos',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-truck',
    'operation_icon'=>'fa fa-tags',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

            <div class="table-responsive">

                <table class="table table-striped table-bordered table-condensed table-hover">

                    <thead style="background-color: #f7b633;  color: #fff;">
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $proveedor->productos as $producto )
                        <tr>
                            <td>{{$producto->codigo_barras}}</td>
                            <td>{{$producto->descripcion}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/proveedores')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>
    </div>
@endsection
