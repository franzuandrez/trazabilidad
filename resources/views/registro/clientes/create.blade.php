@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-shopping-cart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Clientes
        @endslot
    @endcomponent
    @include('componentes.alert-error')

    {!!Form::open(array('url'=>'registro/clientes/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=codigo"">
             CODIGO
            </label>
            <input type="text" name="codigo" value="{{old('codigo')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=razon_social"">
                RAZON SOCIAL
            </label>
            <input type="text" name="razon_social" value="{{old('razon_social')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" name="nit" value="{{old('nit')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="telefono">TELEFONO</label>
            <input type="text" name="telefono" value="{{old('telefono')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=email"">
                EMAIL
            </label>
            <input type="text" name="email" value="{{old('email')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="direccion">DIRECCION</label>
            <input type="text" name="direccion" value="{{old('direccion')}}"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="latitud"  value="0" id="latitud" value="{{old('latitud')}}"
           class="form-control">
    <input type="hidden" name="longitud" value="0" id="longitud" value="{{old('longitud')}}"
           class="form-control">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_categoria_cliente">CATEGORIA CLIENTE</label>
            <select name="id_categoria_cliente" class="form-control selectpicker">
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id_categoria}}">{{$categoria->descripcion}}</option>
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
@section('scripts')
    <script>

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("No se pueden obetener coordenas");
                document.getElementById('latitud').value=0;
                document.getElementById('longitud').value=0;
            }
        }

        function showPosition(position) {

            document.getElementById('latitud').value=position.coords.latitude;
            document.getElementById('longitud').value=position.coords.longitude;


        }
        getLocation();

    </script>
@endsection
@endsection
