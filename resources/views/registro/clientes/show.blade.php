@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Clientes
        @endslot
    @endcomponent


    {!!Form::model($cliente,['method'=>'PATCH','route'=>['clientes.update',$cliente->id_cliente]])!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=codigo"">
             Codigo
            </label>
            <input type="text"
                   readonly
                   name="codigo" value="{{$cliente->Codigo}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=razon_social"">
                Razon Social
            </label>
            <input type="text" name="razon_social" readonly value="{{$cliente->razon_social}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" name="nit" readonly value="{{$cliente->nit}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
           <label for="apellido">Telefono</label>
            <input type="text" name="telefono" readonly value="{{$cliente->telefono}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=email"">
                Correo electrónico
            </label>
            <input type="text"
                   readonly
                   name="email" value="{{$cliente->email}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" readonly value="{{$cliente->direccion}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
        <div class="form-group">
            <label for="id_categoria_cliente">CATEGORIA Cliente</label>
            <select name="id_categoria_cliente" disabled class="form-control selectpicker">
                @foreach($categorias as $categoria)
                    @if($categoria->id_categoria == $cliente->id_categoria)
                        <option selected value="{{$categoria->id_categoria}}">{{$categoria->descripcion}}</option>
                    @else
                        <option value="{{$categoria->id_categoria}}">{{$categoria->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/clientes')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>

        </div>
    </div>




@endsection
