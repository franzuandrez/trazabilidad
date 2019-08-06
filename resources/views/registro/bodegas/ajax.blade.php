@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
        'submenu_icon'=>'fa fa-building-o',
    'operation_icon'=>'',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Bodegas
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @component('componentes.btn-create',['url'=>url('registro/bodegas/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar()'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver()'])
            @endcomponent
            @component('componentes.btn-eliminar',['url'=>'javascript:eliminar()'])
            @endcomponent

        </div>
    </div>
    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UNA BODEGA
        @endslot
    @endcomponent
    <div id="content">
        @include('registro.bodegas.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/bodegas/index.js')}}"></script>
@endsection