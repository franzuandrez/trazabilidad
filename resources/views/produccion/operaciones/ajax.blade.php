@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-hand-rock-o',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @can('role-create')
                @component('componentes.btn-create',['url'=>url('produccion/requisiciones/create')])
                @endcomponent
            @endcan
            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver("requisiciones")'])
                @endcomponent
            @endcan
            @can('role-delete')
                @component('componentes.btn-eliminar',['url'=>'javascript:eliminar()'])
                @endcomponent
            @endcan
            @can('generar_reporte')
                @component('componentes.btn-reporte',['url'=>'javascript:reporte("requisiciones/reporte")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONAR REQUISICION
        @endslot
    @endcomponent
    <div id="content">
        @include('produccion.operaciones.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/requisiciones/index.js')}}"></script>
    <script src="{{asset('js-brc/generico/index.js')}}"></script>
@endsection
