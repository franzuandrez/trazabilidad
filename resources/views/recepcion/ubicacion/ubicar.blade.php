@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>

    </style>
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ubicar',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-arrow-right',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Ubicacion
        @endslot
    @endcomponent

    {!!Form::model($orden,['method'=>'PATCH','route'=>['recepcion.ubicacion.ubicar',$orden->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$orden->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo_producto">CODIGO PRODUCTO</label>
        <div class="form-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscarProducto(document.getElementById('codigo_producto'))"
                   name="codigo_producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="descripcion">PRODUCTO</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="descripcion"
                   name="descripcion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="lote">LOTE</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="lote"
                   name="lote"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div id="tab-ubicacion" class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="ubicacion">UBICACION</label>
        <div class="input-group">
            <input type="text"
                   id="ubicacion"
                   onkeydown="if(event.keyCode==13)buscar_ubicacion(this)"
                   name="ubicacion"
                   class="form-control">
            <div class="input-group-btn">
                <a href="javascript:buscar_ubicacion(document.getElementById('ubicacion'))"
                >
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-search " id="icon-search" aria-hidden="true"></i>
                    </button>

                </a>
                <a href="javascript:limpiar_ubicacion()">
                    <button type="button" class="btn btn-default">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
        <label for="cantidad">CANTIDAD</label>
        <div class="form-group">
            <input type="text"
                   id="cantidad"
                   onkeydown=""
                   readonly
                   name="cantidad"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th></th>
                    <th>DESCRIPCION</th>
                    <th>LOTE</th>
                    <th>UBICACION</th>
                </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>

    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('recepcion/ubicacion')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    @include('componentes.modal-ubicacion')
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            })
        });


        function buscar_ubicacion(input) {

            if (document.getElementById('icon-search').classList.contains('fa-search')) {
                let codigo_barras = input.value == "" ? 0 : input.value;
                start_spinner();
                $.ajax({

                    url: "{{url('registro/ubicaciones/search')}}" + "/" + codigo_barras,
                    type: "get",
                    dataType: "json",
                    success: function (response) {

                        let ubicacion = response;
                        if (ubicacion.length == 0) {
                            alert("Ubicacion no encontrada");
                            stop_spinner("fa-search");
                        } else if (ubicacion[0].estado == 0) {
                            alert("Ubicacion no disponible");
                            stop_spinner("fa-search");
                        } else {


                            mostrar_ubicacion(ubicacion[0]);
                        }


                    },
                    error: function (e) {

                    }
                })
            } else {

                $('#modal-ubicacion').modal();
            }


        }

        function mostrar_ubicacion(ubicacion) {

            setTimeout(function () {

                stop_spinner("fa-eye");
                setTimeout(function () {

                    document.getElementById('ubicacion').readOnly = true;
                    document.getElementById('td-localidad').innerText = ubicacion.localidad.descripcion;
                    document.getElementById('td-bodega').innerText = ubicacion.bodega.descripcion;
                    document.getElementById('td-sector').innerText = ubicacion.sector.descripcion;
                    document.getElementById('td-pasillo').innerText = ubicacion.pasillo.descripcion;
                    document.getElementById('td-rack').innerText = ubicacion.rack.descripcion;
                    document.getElementById('td-nivel').innerText = ubicacion.nivel.descripcion;
                    document.getElementById('td-posicion').innerText = ubicacion.posicion.descripcion;
                    document.getElementById('td-bin').innerText = ubicacion.bin.descripcion;


                    document.getElementById('cantidad').readOnly = false;
                    document.getElementById('cantidad').focus();
                }, 0);

            }, 500);


        }

        function stop_spinner(icon) {
            document.getElementById("icon-search").classList.remove("fa-spin");
            document.getElementById("icon-search").classList.remove("fa-refresh");
            document.getElementById("icon-search").classList.remove("fa-eye");
            document.getElementById("icon-search").classList.add(icon);
        }

        function start_spinner() {
            document.getElementById('icon-search').classList.remove("fa-eye");
            document.getElementById("icon-search").classList.add("fa-spin");
            document.getElementById("icon-search").classList.add("fa-refresh");
            document.getElementById("icon-search").classList.remove("fa-search");
        }

        function cantidad_focus() {
            setTimeout(function () {
                document.getElementById('cantidad').focus();
            }, 350)
        }

        function limpiar_ubicacion() {
              stop_spinner("fa-search");
              document.getElementById('ubicacion').value = "";
              document.getElementById('ubicacion').focus();
              document.getElementById('ubicacion').readOnly = false;
        }
    </script>
@endsection
