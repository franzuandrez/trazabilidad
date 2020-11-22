@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-list',
    'operation_icon'=>'',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Control Calidad
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


            @component('componentes.btn-ingresar',['url'=>'javascript:editar()'])
            @endcomponent

            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver()'])
                @endcomponent
            @endcan
            @can('generar_reporte')
                @component('componentes.btn-reporte',['url'=>'javascript:generico("transito/reporte")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar ORDEN
        @endslot
    @endcomponent
    <div id="content">
        @include('recepcion.transito.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/transito/index.js')}}"></script>
@endsection
