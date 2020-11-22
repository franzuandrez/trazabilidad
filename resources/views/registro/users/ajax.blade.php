@extends('layouts.admin')
@section('style')

    <link href="{{asset('css/loading.css')}}" rel="stylesheet">

@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')
    @component('componentes.nav',['operation'=>'LIST',
'menu_icon'=>'fa-cogs',
'submenu_icon'=>'fa-user',
'operation_icon'=>'',])
        @slot('menu')
            Usuarios
        @endslot
        @slot('submenu')
            Administrar
        @endslot
    @endcomponent


    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            SELECCIONE UN USUARIO
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @can('role-create')
                @component('componentes.btn-create',['url'=>url('users/create')])
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
            @component('componentes.btn-change-password',['url'=>'javascript:cambiar_password()'])
            @endcomponent
        </div>
    </div>
    <div id="content">
        @include('registro.users.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/users/index.js')}}"></script>
@endsection
