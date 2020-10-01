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
        <div class="col-lg-2 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="producto">PRODUCTO</label>
                <input type="text"
                       id="producto"
                       placeholder="CODIGO DE BARRAS , DESCRIPCION"
                       onkeydown="if(event.keyCode ==13)next('lote')"
                       name="producto" value="{{old('producto')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-2 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="lote">LOTE</label>
                <input type="text"
                       id="lote"
                       onkeydown="if(event.keyCode==13)next('lote')"
                       placeholder="NO. LOTE" name="lote" value="{{old('lote')}}"
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
            <div class="btn-group ">
                <a type="button" data-toggle="dropdown" aria-expanded="true">
                    <img src="{{asset('imagenes_web/imprimir.png')}}" data-placement="top" title=""
                         data-toggle="tooltip" data-original-title="Imprimir" width="50" height="50"></a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="javascript:excel()">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            EXCEL
                        </a>
                    </li>

                </ul>
            </div>
        </div>

    </div>
    <div class="row">


        @component('componentes.search-select'
             ,[
             'busqueda'=>'BODEGA',
             'default'=>'AREA TRANSITO',
             'elements'=>$bodegas])
        @endcomponent
        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-10 filtro-no-active" id="filtro">
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
    <div class="row">
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
        function filtro() {

            let id_bodega = $('#id_select_search').val();

            let isNumber = !isNaN(parseInt(id_bodega));
            if (isNumber) {
                id_bodega = parseInt(id_bodega);
            }

            if (id_bodega === 0) {
                activar_filtro(true);
            } else {
                activar_filtro(false);
            }


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

            let id_bodega = $('#id_select_search').val();
            let producto = $('#producto').val();
            let lote = $('#lote').val();
            let start = $('#start').val();
            let end = $('#end').val();

            let busqueda = '{{url('recepcion/kardex')}}';
            busqueda += '?';

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
            filtro();
            ajaxLoad(busqueda)
        }


        function limpiar() {
            let fecha_inicio = document.getElementById('start');
            let fecha_fin =  document.getElementById('end');
            let lote = document.getElementById('lote');
            let producto = document.getElementById('producto');

            fecha_inicio.value ='';
            fecha_fin.value ='';
            lote.value ='';
            producto.value ='';

            $('#id_select_search').find('option:first').prop('selected','selected');
            $('#id_select_search').selectpicker('refresh');
            buscar_existencias();
            producto.focus();

        }
    </script>
@endsection
