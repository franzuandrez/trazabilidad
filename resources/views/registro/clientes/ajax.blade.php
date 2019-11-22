@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa-shopping-cart',
    'operation_icon'=>'',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Clientes
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @can('role-create')
                @component('componentes.btn-create',['url'=>url('registro/clientes/create')])
                @endcomponent
            @endcan
            @can('role-edit')
                @component('componentes.btn-edit',['url'=>'javascript:editar()'])
                @endcomponent
            @endcan
            @can('role-list')
                @component('componentes.btn-ver',['url'=>'javascript:ver()'])
                @endcomponent
            @endcan
            @can('importar')
                @component('componentes.btn-importar',['url'=>'javascript:importar()'])
                @endcomponent
            @endcan

        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UN CLIENTE
        @endslot
    @endcomponent

    @include('componentes.modal-importar',
  ['ruta'=>'clientes.importar',
  'mensaje'=>'  IMPORTAR CLIENTES'])

    <div id="content">
        @include('registro.clientes.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/clientes/index.js')}}"></script>
@endsection
