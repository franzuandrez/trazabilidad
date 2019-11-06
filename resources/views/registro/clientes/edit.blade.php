@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-shopping-cart',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Clientes
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($cliente,['method'=>'PATCH','route'=>['clientes.update',$cliente->id_cliente]])!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=codigo"">
                CODIGO
            </label>
            <input type="text" name="codigo" value="{{$cliente->Codigo}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=razon_social"">
                RAZON SOCIAL
            </label>
            <input type="text" name="razon_social" value="{{$cliente->razon_social}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" name="nit" value="{{$cliente->nit}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{$cliente->telefono}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=email"">
                EMAIL
            </label>
            <input type="text" name="email" value="{{$cliente->email}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">DIRECCION</label>
            <input type="text" name="direccion" value="{{$cliente->direccion}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_categoria_cliente">CATEGORIA CLIENTE</label>
            <select name="id_categoria_cliente" class="form-control selectpicker">
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
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/clientes')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>


    {!!Form::close()!!}

@endsection
