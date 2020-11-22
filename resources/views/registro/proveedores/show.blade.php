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
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-truck',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" name="codigo" readonly required value="{{$proveedor->codigo_proveedor}}"
                           id="codigo"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Razon Social</label>
                    <input type="text" name="razon_social" readonly value="{{$proveedor->razon_social}}"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Nombre Comercial</label>
                    <input type="text" name="nombre_comercial" readonly value="{{$proveedor->nombre_comercial}}"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">NIT</label>
                    <input type="text" name="nit" readonly value="{{$proveedor->nit}}"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Direccion Fiscal</label>
                    <input type="text" name="direccion_fiscal" readonly value="{{$proveedor->direccion_fiscal}}"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Direccion de Planta</label>
                    <input type="text" name="direccion_planta" readonly value="{{$proveedor->direccion_planta}}"
                           class="form-control">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Telefono de Contacto</label>
                    <input type="text" name="telefono_contacto" readonly value="{{$proveedor->telefono_contacto}}"
                           class="form-control">
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="nombre">Correo electrónico</label>
                    <input type="text" name="email" readonly value="{{$proveedor->email}}"
                           class="form-control">
                </div>
            </div>


        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="page-header" id="productos-provee">
                <h2>
                    <small>&nbsp;&nbsp; PRODUCTOS
                    </small>
                </h2>
            </div>
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalle_productos"
                       class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #f7b633;  color: #fff;">
                    <th>Producto</th>

                    </thead>
                    <tbody>
                    @foreach( $proveedor->productos as $producto )
                        <tr>

                            <td>
                                {{$producto->descripcion}}
                            </td>

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

        {!!Form::close()!!}

    </div>
@endsection
