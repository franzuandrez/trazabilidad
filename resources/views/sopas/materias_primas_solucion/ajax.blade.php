@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa  fa-check-circle',
    'operation_icon'=>'',])
        @slot('menu')
            Sopas
        @endslot
        @slot('submenu')
            Verificacion Materias
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @component('componentes.btn-create',['url'=>url('sopas/solucion/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar("solucion")'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver("solucion")'])
            @endcomponent
            @component('componentes.btn-reporte',['url'=>'javascript:reporte("solucion/reporte")'])
            @endcomponent
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONAR FORMULARIO
        @endslot
    @endcomponent
    <div id="content">
        @include('sopas.materias_primas_solucion.index')
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
