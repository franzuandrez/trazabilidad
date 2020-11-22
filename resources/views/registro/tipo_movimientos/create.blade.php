@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-arrows-h',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Tipo Movimiento
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'registro/tipo_movimientos/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=descripcion"">
                DESCRIPCION
            </label>
            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="factor">SUMA INVENTARIO</label>
            <select name="factor"
                    required
                    class="form-control selectpicker">
                <option value="">SELECCIONE OPCION</option>
                <option value="1">SI</option>
                <option value="-1">NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('registro/tipo_movimientos ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>


        </div>
    </div>

    {!!Form::close()!!}

@endsection
