@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-list-ol',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Actividades
        @endslot
    @endcomponent



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" value="{{$actividad->descripcion}} " readonly
                   class="form-control">
        </div>
    </div>
    {{--
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">Producto</label>
            <select name="id_producto" id="productis" class="form-control selectpicker">
                <option value="">Seleccionar DIMENSIONAL</option>
                @foreach( $productos as $producto )
                    <option  value="{{$producto->id_producto}}"> {{$producto->descripcion}}  </option>
                @endforeach
            </select>
        </div>
    </div>
    --}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/actividades')}}">
                <button class="btn btn-primary" type="button">
                    <span class="fa fa-backward"></span>
                    Regresar
                </button>
            </a>
        </div>
    </div>
@endsection
