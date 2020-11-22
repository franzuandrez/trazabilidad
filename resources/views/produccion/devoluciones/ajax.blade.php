@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-undo',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Devolver
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            @can('role-edit')

                <a href="javascript:editar('devoluciones','devolucion')" data-placement="top" title="Devolver"
                   data-toggle="tooltip"><img
                        src="{{asset('imagenes_web/undo.png')}}" width="35" height="35"></a>

            @endcan


        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar CONTROL DE TRAZABILIDAD
        @endslot
    @endcomponent
    <div id="content">
        @include('produccion.devoluciones.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/generico/index.js')}}"></script>
@endsection
