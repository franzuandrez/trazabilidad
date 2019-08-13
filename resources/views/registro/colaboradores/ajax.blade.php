@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa-male',
    'operation_icon'=>'',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Colaboradores
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            @component('componentes.btn-create',['url'=>url('registro/colaboradores/create')])
            @endcomponent
            @component('componentes.btn-edit',['url'=>'javascript:editar()'])
            @endcomponent
            @component('componentes.btn-ver',['url'=>'javascript:ver()'])
            @endcomponent
            @component('componentes.btn-importar',['url'=>'javascript:importar()'])
            @endcomponent

        </div>
    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UN COLABORADOR
        @endslot
    @endcomponent

    @component('componentes.modal-importar',['ruta'=>'clientes.importar'])
        @slot('mensaje')
            IMPORTAR COLABORADORES
        @endslot
    @endcomponent
    <div id="content">

    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection