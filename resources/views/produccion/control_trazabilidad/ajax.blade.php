@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-list-alt',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @can('role-create')
                @component('componentes.btn-create',['url'=>url('produccion/trazabilidad_chao_mein/create')])
                @endcomponent
            @endcan
            @can('role-edit')
                @component('componentes.btn-edit',['url'=>'javascript:editar("trazabilidad_chao_mein")'])
                @endcomponent
            @endcan
            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver("trazabilidad_chao_mein")'])
                @endcomponent
            @endcan
            @can('role-edit')
                <a href="javascript:ver('trazabilidad_chao_mein/finalizar')" data-placement="top" title="Finalizar" data-toggle="tooltip"><img
                        src="{{asset('imagenes_web/confirmar.png')}}" width="50" height="50"></a>
            @endcan
            @can('generar_reporte')
                @component('componentes.btn-reporte',['url'=>'javascript:reporte("trazabilidad_chao_mein/reporte")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONAR CONTROL DE TRAZABILIDAD
        @endslot
    @endcomponent
    <div id="content">
        @include('produccion.control_trazabilidad.index')
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
