@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-arrows',
    'submenu_icon'=>'fa-exchange',
    'operation_icon'=>'',])
        @slot('menu')
            Movimientos
        @endslot
        @slot('submenu')
            Bodegas
        @endslot
    @endcomponent

    @component('componentes.search-select'
         ,['modulo'=>'movimientos/bodegas',
         'busqueda'=>'BODEGA',
         'default'=>'BODEGA TRANSITO',
         'elements'=>$bodegas])
    @endcomponent
    <div id="content">

        @include('movimientos.bodegas.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
