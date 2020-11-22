@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-dot-circle-o',
    'submenu_icon'=>'fa fa-industry',
    'operation_icon'=>'',])
        @slot('menu')
            Control Sopas
        @endslot
        @slot('submenu')
            Peso Pasta
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @component('componentes.btn-create',['url'=>url('sopas/peso_pasta/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>"javascript:editar('peso_pasta')"])
            @endcomponent
            @component('componentes.btn-ver',['url'=>"javascript:ver('peso_pasta')"])
            @endcomponent
            @component('componentes.btn-reporte',['url'=>"javascript:reporte('peso_pasta/reporte')"])
            @endcomponent

        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar PESO DE PASTA
        @endslot
    @endcomponent
    <div id="content">
        @include('sopas.peso_pasta.index')
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
