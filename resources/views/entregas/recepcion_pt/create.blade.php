@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Recepcionar',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa   fa-hdd-o ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Recepcion  PT
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
            <label for="descripcion"> Producto</label>
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
            <label for="descripcion"> Cantidad</label>
            <input type="text"
                   name="descripcion"

                   id="descripcion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion"> NO. TARIMA</label>
            <input type="text"
                   name="descripcion"

                   id="descripcion"
                   class="form-control">
        </div>
    </div>




    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #f7b633;  color: #fff;">
            <th></th>
            <th>Producto</th>
            <th>UNIDAD MEDIDA</th>
            <th>Cantidad</th>
            <th>NO. TARIMA</th>
            </thead>
            <tbody id="body-detalles">
            </tbody>
        </table>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('produccion/recepcion_pt ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}

@endsection

