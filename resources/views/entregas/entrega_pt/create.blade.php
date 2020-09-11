@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-archive ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Entrega PT
        @endslot
    @endcomponent
    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'produccion/requisiciones/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">CODIGO </label>
            <input type="text"
                   name="codigo"
                   id="codigo"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion"> PRODUCTO</label>
            <input type="text"
                   name="descripcion"
                   readonly
                   id="descripcion"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_encargado">UNIDAD MEDIDA</label>
            <select name="id_localidad" class="form-control selectpicker"
                    id="localidades"
                   >
                <option value="1">UNIDAD</option>
                <option value="2">CAJA</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion"> CANTIDAD</label>
            <input type="text"
                   name="descripcion"

                   id="descripcion"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-3 col-sm-3 col-md-12 col-xs-12">
        <label for="codigo_producto"> NO. TARIMA</label>
        <div class="input-group">
            <input id="codigo_producto" type="text"
                   class="form-control">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default"

                >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>


    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #01579B;  color: #fff;">
            <th></th>
            <th>PRODUCTO</th>
            <th>UNIDAD MEDIDA</th>
            <th>CANTIDAD</th>
            <th>NO. TARIMA</th>
            </thead>
            <tbody id="body-detalles">
            </tbody>
        </table>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/entrega_pt')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}

@endsection

