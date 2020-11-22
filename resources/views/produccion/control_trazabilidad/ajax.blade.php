@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-exchange',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Trazabilidad
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @can('role-create')
                @component('componentes.btn-create',['url'=>url('produccion/trazabilidad_chao_mein/create')])
                @endcomponent
                @component('componentes.btn-continuar',['url'=>'javascript:ver("trazabilidad_chao_mein/continuar")'])
                @endcomponent
            @endcan
            @can('role-edit')

                <a href="javascript:editar('trazabilidad_chao_mein')" data-placement="top" title="Asociar"
                   data-toggle="tooltip"><img
                        src="{{asset('imagenes_web/asociar.png')}}" width="35" height="35"></a>

            @endcan
            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver("trazabilidad_chao_mein")'])
                @endcomponent
            @endcan
            @can('role-edit')
                <a href="javascript:ver('trazabilidad_chao_mein/finalizar')" data-placement="top" title="Finalizar"
                   data-toggle="tooltip"><img
                        src="{{asset('imagenes_web/confirmar.png')}}" width="35" height="35"></a>
            @endcan
            @can('generar_reporte')
                @component('componentes.btn-reporte',['url'=>'javascript:reporte("trazabilidad_chao_mein/reporte")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar Documento
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
