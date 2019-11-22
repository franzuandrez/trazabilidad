@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tags',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Productos
        @endslot
    @endcomponent

    @include('componentes.alert-error')

    {!!Form::model($producto,['method'=>'PATCH','route'=>['productos.update',$producto->id_producto]])!!}
    {{Form::token()}}



    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras"
                   @if($producto->codigo_barras != null && $producto->codigo_barras!='')
                   readonly
                   @endif
                   value="{{$producto->codigo_barras}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_interno_cliente">CODIGO PROVEEDOR</label>
            <input type="text" name="codigo_interno_cliente" value="{{$producto->codigo_interno_cliente}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO INTERNO</label>
            <input type="text" name="codigo_interno" value="{{$producto->codigo_interno}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$producto->descripcion}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="unidad_medida">UNIDAD DE MEDIDA</label>
            <input type="text" name="unidad_medida" value="{{$producto->unidad_medida}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
        <div class="form-group">
            <label for="id_dimensional">DIMENSIONAL</label>
            <select name="id_dimensional" id="dimensionales"
                    required
                    class="form-control selectpicker">

                @foreach( $dimensionales as $dimensional )
                    @if( $dimensional->id_dimensional == $producto->id_dimensional )
                        <option selected
                                value="{{$dimensional->id_dimensional}}"> {{$dimensional->descripcion}}  </option>
                    @else
                        <option value="{{$dimensional->id_dimensional}}"> {{$dimensional->descripcion}}  </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
        <div class="form-group">
            <label for="id_presentacion">PRESENTACIONES</label>
            <select name="id_presentacion" id="presentaciones"
                    required
                    class="form-control selectpicker">

                @foreach( $presentaciones as $presentacion)
                    @if( $presentacion->id_presentacion == $producto->id_presentacion  )
                        <option selected
                                value="{{$presentacion->id_presentacion}}"> {{$presentacion->descripcion}}  </option>
                    @else
                        <option value="{{$presentacion->id_presentacion}}"> {{$presentacion->descripcion}}  </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_producto">TIPO PRODUCTO</label>
            <select name="tipo_producto"
                    required
                    id="tipo_producto" class="form-control selectpicker">
                <option selected value="">SELECCIONAR TIPO PRODUCTO</option>
                @if(  $producto->tipo_producto == "MP"  )
                    <option value="MP" selected> MATERIA PRIMA</option>
                    <option value="PT">PRODUCTO TERMINADO</option>
                    <option value="PP">PRODUCTO PROCESO</option>
                    <option value="ME">MATERIAL EMPAQUE</option>
                @elseif($producto->tipo_producto == "PT"  )
                    <option value="MP"> MATERIA PRIMA</option>
                    <option value="PT" selected>PRODUCTO TERMINADO</option>
                    <option value="PP">PRODUCTO PROCESO</option>
                    <option value="ME">MATERIAL EMPAQUE</option>
                @elseif($producto->tipo_producto == "PP"  )
                    <option value="MP"> MATERIA PRIMA</option>
                    <option value="PT">PRODUCTO TERMINADO</option>
                    <option value="PP" selected>PRODUCTO PROCESO</option>
                    <option value="ME">MATERIAL EMPAQUE</option>
                @else
                    <option value="MP"> MATERIA PRIMA</option>
                    <option value="PT">PRODUCTO TERMINADO</option>
                    <option value="PP">PRODUCTO PROCESO</option>
                    <option value="ME" selected>MATERIAL EMPAQUE</option>
                @endif
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
