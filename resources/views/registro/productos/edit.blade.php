@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tags',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Catalogos
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
            <label for="codigo_barras">Codigo  Barras</label>
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
             <label for="codigo_interno_cliente">Codigo Proveedor</label>
            <input type="text" name="codigo_interno_cliente" value="{{$producto->codigo_interno_cliente}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
        <label for="codigo_barras">Codigo Interno</label>
            <input type="text" name="codigo_interno" value="{{$producto->codigo_interno}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
              <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" value="{{$producto->descripcion}}" required
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="unidad_medida">Unidad de Medida</label>
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
            <label for="id_presentacion">Presentaciones</label>
            <select name="id_presentacion[]" id="presentaciones"
                    multiple

                    class="form-control selectpicker">

                @foreach( $presentaciones as $presentacion)
                    @if(   in_array( $presentacion->id_presentacion,$producto_presentaciones  )    )
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
            <label for="tipo_producto">Tipo Producto</label>
            <select name="tipo_producto"
                    required
                    id="tipo_producto" class="form-control selectpicker">
                <option selected value="">Seleccionar Tipo Producto</option>
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
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" style="display: none">
        <div class="form-group">
            <label for="codigo_dun">Codigo dun 14</label>
            <input type="text" name="codigo_dun" value="{{$producto->codigo_dun}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
         <label for="cantidad_unidades">Cantidad de Unidades por paquete</label>
            <input type="number" name="cantidad_unidades" value="{{$producto->cantidad_unidades}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/productos ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


        </div>
    </div>
    {!!Form::close()!!}
@endsection
