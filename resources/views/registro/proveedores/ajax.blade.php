@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-truck',
    'operation_icon'=>'',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @can('role-create')
                @component('componentes.btn-create',['url'=>url('registro/proveedores/create')])
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
            @can('role-delete')
                @component('componentes.btn-eliminar',['url'=>'javascript:eliminar()'])
                @endcomponent
            @endcan
            @can('role-list')
                @include('registro.proveedores.btn-ver-productos')
            @endcan
        </div>
    </div>
    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UN PROVEEDOR
        @endslot
    @endcomponent


    @include('componentes.modal-importar',
    [
    'ruta'=>'proveedores.importar',
    'mensaje'=>'  IMPORTAR PROVEEDORES'
    ])

    <div id="content">
        @include('registro.proveedores.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/proveedores/index.js')}}"></script>
    <script src="{{asset('js-brc/tools/importar.js')}}"></script>
@endsection
