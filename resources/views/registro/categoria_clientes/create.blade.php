@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-list-ol',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Categoria Clientes
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'registro/categoria_clientes/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="descripcion">
                DESCRIPCION
            </label>
            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tipo_documento">TIPO DOCUMENTO</label>
            <select name="tipo_documento" class="form-control selectpicker">
                <option value="FACC">FACTURA CAMBIARIA</option>
                <option value="FAC">FACTURA </option>
            </select>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="impresion_recibo">IMPRESION RECIBO</label>
            <select name="impresion_recibo" class="form-control selectpicker">
                <option value="1">SI</option>
                <option value="0">NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/categoria_clientes')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>


    {!!Form::close()!!}
@endsection
