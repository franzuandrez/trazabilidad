@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'',])
        @slot('menu')
            Condimentos
        @endslot
        @slot('submenu')
            Pesos
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @component('componentes.btn-create',['url'=>url('peso_condimentos/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar("peso_condimentos")'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver("peso_condimentos")'])
            @endcomponent
            @can('generar_reporte')
                @component('componentes.btn-reporte',['url'=>'javascript:reporte("peso_condimentos/reporte")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UNA ORDEN
        @endslot
    @endcomponent
    <div id="content">
        @include('condimentos.pesos.index')
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
