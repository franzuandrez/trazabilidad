@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>
        .filtro-active {
            display: block;
        }

        .filtro-no-active {
            display: none;
        }
    </style>
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')


    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>' fa fa-arrow-circle-o-right ',
    'submenu_icon'=>'fa fa-th-list',
    'operation_icon'=>'',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Existencias
        @endslot
    @endcomponent
    <div class="row">
        @component('componentes.search-select'
             ,[
             'busqueda'=>'BODEGA',
             'default'=>'BODEGA TRANSITO',
             'elements'=>$bodegas])
        @endcomponent
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 filtro-active" id="filtro">
            <div class="form-group">
                <label for="id_filtro">FILTRO</label>
                <select name="id_filtro"
                        id="id_filtro"
                        onchange="filtrar()"
                        class="form-control selectpicker"
                >
                    <option value="2" selected>TODAS</option>
                    <option value="0">NO LIBERADO</option>
                    <option value="1">LIBERADO</option>

                </select>
            </div>
        </div>
    </div>
    <div id="content">

        @include('recepcion.kardex.index')

    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script>
        function ver_existencia() {

            let id_bodega = $('#id_select_search').val();
            if (id_bodega == 0) {
                activar_filtro(true);
            } else {
                activar_filtro(false);
            }

            ajaxLoad('{{url('recepcion/kardex')}}?id_select_search=' + id_bodega)

        }

        function filtrar() {
            let id_bodega = $('#id_select_search').val();
            let filtro = document.getElementById('id_filtro').value;
            ajaxLoad('{{url('recepcion/kardex')}}?filtro=' + filtro + '&id_select_search=' + id_bodega)

        }

        function activar_filtro($bool) {

            if ($bool) {
                document.getElementById('filtro').classList.add('filtro-active');
                document.getElementById('filtro').classList.remove('filtro-no-active');
            } else {
                document.getElementById('filtro').classList.remove('filtro-active');
                document.getElementById('filtro').classList.add('filtro-no-active');
            }
        }

    </script>
@endsection
