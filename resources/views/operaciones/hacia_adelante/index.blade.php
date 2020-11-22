@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa  fa-long-arrow-right',
    'operation_icon'=>'',])
        @slot('menu')
            Reportes
        @endslot
        @slot('submenu')
            Hacia Adelante
        @endslot
    @endcomponent

    <div id="content">
        @include('operaciones.hacia_adelante.ajax')
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
