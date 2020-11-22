@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>
        .event-detail {

            height: 160px;
            overflow-y: auto;

        }

        thead > tr {
            position: sticky;
            top: 0;
            background-color: #ffffff;
        }
    </style>
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
        @include('operaciones.trazabilidad.ajax_second')
    </div>


@endsection

@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/generico/index.js')}}"></script>
@endsection
