@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
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
             Codigo
            </label>
            <input type="text" name="codigo" value="{{$cliente->Codigo}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=razon_social"">
                Razon Social
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
           <label for="apellido">Telefono</label>
            <input type="text" name="telefono" value="{{$cliente->telefono}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=email"">
                Correo electrónico
            </label>
            <input type="text" name="email" value="{{$cliente->email}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" name="direccion" value="{{$cliente->direccion}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
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
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/clientes ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


        </div>
    </div>


    {!!Form::close()!!}

@endsection
