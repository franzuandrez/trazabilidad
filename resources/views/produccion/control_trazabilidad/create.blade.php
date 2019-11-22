@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-hand-rock-o  ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_producto()"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   id="best_by"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO. ORDEN PRODUCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   id="no_orden_produccion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input type="text"
                   name="lote"
                   id="lote"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    INSUMOS
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    OPERARIOS INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="#insumos"></div>
            <div class="tab-pane " id="#involucrados">


            </div>
        </div>

    </div>

    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}
@endsection
@section('scripts')

    <script>

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        function buscar_producto() {

            let codigo_interno = document.getElementById('codigo_producto').value;

            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto')}}" + "?codigo_interno=" + codigo_interno,
                type: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.producto != null) {
                        document.getElementById('id_producto').value = response.producto.id_producto;
                        document.getElementById('producto').value = response.producto.descripcion;
                        document.getElementById('best_by').value = response.fecha_vencimiento;
                        document.getElementById('lote').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('turno').readOnly = false;
                        document.getElementById('cantidad_programada').readOnly = false;
                        document.getElementById('no_orden_produccion').focus();

                    } else {
                        alert('Producto no encontrado');
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }
    </script>
@endsection
