@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-list-ol',
    'operation_icon'=>'',])
        @slot('menu')
            Operaciones
        @endslot
        @slot('submenu')
            Consulta trazabilidad
        @endslot
    @endcomponent

    <div id="content">
        @include('operaciones.hacia_adelante.ajax')
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
