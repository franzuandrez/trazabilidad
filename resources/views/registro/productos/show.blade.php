@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tags',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Productos
        @endslot
    @endcomponent




    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO BARRAS</label>
            <input type="text" name="codigo_barras" value="{{$producto->codigo_barras}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_barras">CODIGO INTERNO</label>
            <input type="text" name="codigo_interno" value="{{$producto->codigo_interno}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" value="{{$producto->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_dimensional">DIMENSIONAL</label>
            <select name="id_dimensional"
                    disabled
                    id="dimensionales"
                    class="form-control selectpicker">
                <option value="">SELECCIONAR DIMENSIONAL</option>
                @foreach( $dimensionales as $dimensional )
                    @if( $dimensional->id_dimensional == $producto->id_dimensional )
                        <option selected  value="{{$dimensional->id_dimensional}}"> {{$dimensional->descripcion}}  </option>
                    @else
                        <option   value="{{$dimensional->id_dimensional}}"> {{$dimensional->descripcion}}  </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_presentacion">PRESENTACIONES</label>
            <select name="id_presentacion"
                    id="presentaciones"
                    class="form-control selectpicker"
                    disabled
            >
                <option value="">SELECCIONAR PRESENTACION</option>
                @foreach( $presentaciones as $presentacion)
                    @if( $presentacion->id_presentacion == $producto->id_presentacion  )
                        <option  selected  value="{{$presentacion->id_presentacion}}"> {{$presentacion->descripcion}}  </option>
                    @else
                        <option    value="{{$presentacion->id_presentacion}}"> {{$presentacion->descripcion}}  </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
  
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_producto">TIPO PRODUCTO</label>
            <select name="tipo_producto"
                    id="tipo_producto"
                    disabled
                    class="form-control selectpicker">
                <option selected value="">SELECCIONAR TIPO PRODUCTO</option>
                @if(  $producto->tipo_documento == "MP"  )
                    <option value="MP" selected> MATERIA PRIMA</option>
                    <option value="PT">PRODUCTO TERMINADO</option>
                @else
                    <option value="MP"> MATERIA PRIMA</option>
                    <option value="PT" selected>PRODUCTO TERMINADO</option>
                @endif
            </select>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/productos')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
@endsection
