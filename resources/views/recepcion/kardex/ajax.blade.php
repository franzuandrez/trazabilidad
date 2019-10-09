@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>' fa fa-arrow-circle-o-right ',
    'submenu_icon'=>'fa fa-th-list',
    'operation_icon'=>'',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Existencias
        @endslot
    @endcomponent

    @component('componentes.search-select'
         ,['modulo'=>'recepcion/kardex',
         'busqueda'=>'BODEGA',
         'default'=>'BODEGA TRANSITO',
         'elements'=>$bodegas])
    @endcomponent
    <div id="content">

        @include('recepcion.kardex.index')

    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
