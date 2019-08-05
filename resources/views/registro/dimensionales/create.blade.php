@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-cubes',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Dimensionales
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'registro/dimensionales/create','method'=>'POST','autocomplete'=>'off'))!!}
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
            <label for="unidad_medida">UNIDAD DE MEDIDA</label>
            <input type="text" name="unidad_medida" value="{{old('unidad_medida')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="factor">FACTOR</label>
            <input type="text" name="factor" value="{{old('factor')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/dimensionales')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>


    {!!Form::close()!!}
@endsection
