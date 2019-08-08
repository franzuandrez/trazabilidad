@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-hand-lizard-o',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Actividades
        @endslot
    @endcomponent

    {!!Form::model($actividad,['method'=>'PATCH','route'=>['actividades.update',$actividad->id_actividad]])!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$actividad->descripcion}}"
                   class="form-control">
        </div>
    </div>
    {{--
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select name="id_producto" id="productis" class="form-control selectpicker">
                <option value="">SELECCIONAR DIMENSIONAL</option>
                @foreach( $productos as $producto )
                    <option  value="{{$producto->id_producto}}"> {{$producto->descripcion}}  </option>
                @endforeach
            </select>
        </div>
    </div>
    --}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/actividades')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}
@endsection
