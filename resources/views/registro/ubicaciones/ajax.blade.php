@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa  fa-map-marker',
    'operation_icon'=>'',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Ubicaciones
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @component('componentes.btn-create',['url'=>url('registro/ubicaciones/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar("ubicaciones")'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver("ubicaciones")'])
            @endcomponent
            @component('componentes.btn-eliminar',['url'=>'javascript:eliminar()'])
            @endcomponent


        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UNA UBICACION
        @endslot
    @endcomponent
    <div id="content">
        @include('registro.ubicaciones.index')
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
