@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'',])
        @slot('menu')
            Configuracion
        @endslot
        @slot('submenu')
            Impresion
        @endslot
    @endcomponent

    <form action="{{route('configuraciones.impresion.store')}}" method="POST">

        @csrf
        @foreach($configuraciones as $configuracion)
            <div class="row">
                @include('configuraciones.impresion.configuracion')
            </div>
        @endforeach
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-default" type="submit">
                        <span class=" fa fa-check"></span> GUARDAR
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
@endsection
