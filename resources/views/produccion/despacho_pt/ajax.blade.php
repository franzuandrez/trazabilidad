@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-cart-plus',
    'operation_icon'=>'',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Despacho
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('role-edit')
                @component('componentes.btn-edit',['url'=>'javascript:despachar("despacho")'])
                @endcomponent
            @endcan
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar REQUISICION
        @endslot
    @endcomponent
    <div id="content">
        @include('produccion.despacho_pt.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/picking/index.js')}}" ></script>
@endsection
