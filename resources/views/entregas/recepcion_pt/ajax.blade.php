@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa fa-archive',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Recepción PT
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                @can('role-create')
                    @component('componentes.btn-edit',['url'=>url('produccion/recepcion_pt/create')])
                    @endcomponent
                @endcan
            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver("requisiciones")'])
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
            SELECCIONAR NO ORDEN
        @endslot
    @endcomponent
    <div id="content">
        @include('entregas.entrega_pt.index')
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
