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
            Reporte
        @endslot
        @slot('submenu')
            Kardex
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-2 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="producto">PRODUCTO</label>
                <input type="text"
                       id="producto"
                       placeholder="CODIGO "
                       onkeydown="if(event.keyCode ==13)buscar_existencias()"
                       name="producto" value="{{$producto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-2 col-sm-3 col-md-3 col-xs-12">
            <br>
            <div class="btn-group ">
                <a type="button"
                   onclick="buscar_existencias()"
                   data-toggle="dropdown" aria-expanded="true">
                    <img src="{{asset('imagenes_web/buscar.png')}}" data-placement="top" title=""
                         data-toggle="tooltip" data-original-title="Buscar" width="50" height="50">
                </a>

            </div>
            <div class="btn-group ">
                <a type="button"
                   onclick="limpiar()"
                   data-toggle="dropdown" aria-expanded="true">
                    <img src="{{asset('imagenes_web/borrar.png')}}" data-placement="top" title=""
                         data-toggle="tooltip" data-original-title="Limpiar" width="50" height="50">
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        @component('componentes.search-select'
             ,[
             'busqueda'=>'BODEGA',
             'default'=>false,
             'elements'=>$ubicaciones])
        @endcomponent
    </div>

    <div class="row" style="display: none">
        <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="Fecha">RANGO FECHA
                </label>
                <div class="input-daterange input-group fj-date" id="datepicker">
                    <input style="height:35px" type="text" id="start"
                           value=""
                           onchange="next('end')"
                           class="input-sm form-control"
                           name="start"/>
                    <span class="input-group-addon">a</span>
                    <input style="height:35px"
                           type="text" id="end"
                           value=""
                           onchange="next('producto')"
                           class="input-sm form-control" name="end"/>
                </div>
            </div>
        </div>
    </div>

    <div id="content">

        @include('recepcion.kardex_detallado.index')

    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script>


        function excel() {
            let id_bodega = $('#id_select_search').val();
            let producto = $('#producto').val();
            let lote = $('#lote').val();
            let start = $('#start').val();
            let end = $('#end').val();

            let url = "{{url('recepcion/kardex/reporte?type=excel')}}";
            let busqueda = '&';

            if (id_bodega !== "") {
                busqueda += "id_select_search=" + id_bodega + "&";
            }
            if (producto !== "") {
                busqueda += "producto=" + producto + "&";
            }
            if (lote !== "") {
                busqueda += "lote=" + lote + "&";
            }

            if (start !== "" && end !== "") {
                busqueda += "start=" + start + "&end=" + end;
            }
            url += busqueda;
            generar(url);
        }


        function next(id_next) {

            document.getElementById(id_next).focus();
            buscar_existencias();
        }

        function buscar_existencias() {


            let producto = $('#producto').val();
            let start = $('#start').val();
            let end = $('#end').val();
            let ubicacion = $('#id_select_search').val();

            let busqueda = '{{url('movimientos/kardex')}}';
            busqueda += '?';


            if (producto !== "") {
                busqueda += "producto=" + producto + "&";
            }

            if (producto !== "" && ubicacion !== "") {
                busqueda += "ubicacion=" + ubicacion + "&";
            }
            if (start !== "" && end !== "") {
                busqueda += "start=" + start + "&end=" + end;
            }


            ajaxLoad(busqueda)
        }


        function limpiar() {
            let fecha_inicio = document.getElementById('start');
            let fecha_fin = document.getElementById('end');
            let producto = document.getElementById('producto');

            fecha_inicio.value = '';
            fecha_fin.value = '';
            producto.value = '';
            buscar_existencias();
            producto.focus();

        }
    </script>
@endsection
