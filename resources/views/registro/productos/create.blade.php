@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-sort-numeric-desc',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Niveles
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'registro/productos/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{old('codigo_barras')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO INTERNO</label>
            <input type="text" name="codigo_interno" value="{{old('codigo_interno')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_dimensional">DIMENSIONAL</label>
            <select name="id_dimensional" id="dimensionales" class="form-control selectpicker">
                <option value="">SELECCIONAR DIMENSIONAL</option>
                @foreach( $dimensionales as $dimensional )
                <option  value="{{$dimensional->id_dimensional}}"> {{$dimensional->descripcion}}  </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_presentacion">PRESENTACIONES</label>
            <select name="id_presentacion" id="presentaciones" class="form-control selectpicker">
                <option value="">SELECCIONAR PRESENTACION</option>
                @foreach( $presentaciones as $presentacion)
                    <option  value="{{$presentacion->id_presentacion}}"> {{$presentacion->descripcion}}  </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <select name="id_proveedor" id="proveedores" class="form-control selectpicker">
                <option value="">SELECCIONAR PROVEEDOR</option>
                @foreach( $proveedores as $proveedor)
                    <option  value="{{$proveedor->id_proveedor}}"> {{$proveedor->razon_social}}  </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_producto">TIPO PRODUCTO</label>
            <select name="tipo_producto" id="tipo_producto" class="form-control selectpicker">
                <option selected value="">SELECCIONAR TIPO PRODUCTO</option>
                <option value="MP"> MATERIA PRIMA</option>
                <option value="PT">PRODUCTO TERMINADO</option>
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/productos')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection
