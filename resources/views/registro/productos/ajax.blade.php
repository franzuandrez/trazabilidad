@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection

@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-tags',
    'operation_icon'=>'',])
        @slot('menu')
            Catalogos
        @endslot
        @slot('submenu')
            Productos
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('role-create')
                @component('componentes.btn-create',['url'=>url('registro/productos/create')])
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

        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UN PRODUCTO
        @endslot
    @endcomponent


    @include('componentes.modal-importar-options',
[
    'ruta'=>'productos.importar',
    'opciones'=>$tipos_productos,
    'mensaje'=>'IMPORTAR PRODUCTOS'
])


    <div id="content">
        @include('registro.productos.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/productos/index.js')}}"></script>
    <script src="{{asset('js-brc/tools/importar.js')}}"></script>
@endsection
