@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-spoon',
    'operation_icon'=>'',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Mezcla Harina
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @component('componentes.btn-create',['url'=>url('control/mezcla_harina/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar("mezcla_harina")'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver("mezcla_harina")'])
            @endcomponent
        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONAR DOCUMENTO MEZCLA DE HARINA
        @endslot
    @endcomponent
    <div id="content">
        @include('control.mezcla_harina.index')
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
