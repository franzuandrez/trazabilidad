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
    {!!Form::open(array('url'=>'produccion/entrega_pt/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" value="0" id="id_entrega">
    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">CODIGO </label>
            <input type="text"
                   onkeydown="if(event.keyCode==13)buscar_producto()"
                   name="codigo"
                   id="codigo"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion_producto"> Producto</label>
            <input type="text"
                   name="descripcion_producto"
                   readonly
                   id="descripcion_producto"
                   class="form-control">
        </div>
    </div>
    <input id="id_producto" value="" type="hidden">
    <input id="id_control" value="" type="hidden">
    @include('componentes.loading')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="unidad_medida">UNIDAD MEDIDA</label>
            <select name="unidad_medida" class="form-control selectpicker"
                    id="unidad_medida"
            >
                <option value="CA">CAJA</option>
                <option value="UN">UNIDAD</option>

            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="cantidad"> Cantidad</label>
            <input type="text"
                   name="cantidad"
                   onkeydown="if(event.keyCode==13)document.getElementById('no_tarima').focus()"
                   id="cantidad"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-3 col-sm-3 col-md-12 col-xs-12">
        <label for="no_tarima"> NO. TARIMA</label>
        <div class="input-group">
            <input id="no_tarima" type="text"
                   onkeydown="if(event.keyCode==13)agregar_producto()"
                   class="form-control">
            <div class="input-group-btn">
                <button type="button"
                        onclick="agregar_producto()"
                        class="btn btn-primary"
                >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>

    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #f7b633;  color: #fff;">
            <th>Producto</th>
            <th>UNIDAD MEDIDA</th>
            <th>Cantidad</th>
            <th>NO. TARIMA</th>
            </thead>
            <tbody id="detalle">
            </tbody>
        </table>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
             <button class="btn btn-primary" type="submit">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('produccion/entrega_pt ')}}">
                  <button class="btn btn-primary" type="button">
               <span class=" fa fa-close"></span> Cancelar
            </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}

@endsection

@section('scripts')
    @include('entregas.entrega_pt.script')
@endsection

