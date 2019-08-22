@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-hand-rock-o  ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Operaciones
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/operaciones/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO.ORDEN PRODUCCION</label>
            <input type="text" name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_requision">NO.REQUISION</label>
            <input type="text" name="no_requision" value="{{old('no_requision')}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-8">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_existencia()"
                   value="{{old('codigo_producto')}}"
                   class="form-control">

        </div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1  col-xs-4">
        <br>
        <div class="form-group">
            <button id="btnBuscar" class="btn btn-default block" style="margin-top: 5px;" type="button">
                <span class=" fa fa-search"></span></button>
            <button id="btnLimpiar" class="btn btn-default block" style="margin-top: 5px;" type="button">
                <span class=" fa fa-trash"></span></button>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="form-group">
            <label for="descripcion">DESCRIPCION</label>
            <input type="text" name="descripcion" id="descripcion" readonly value="{{old('descripcion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="form-group">
            <label for="descripcion">CANTIDAD</label>
            <input type="text" name="cantidad" id="cantidad" readonly value="{{old('cantidad')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/operaciones')}}">
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

        function buscar_existencia() {
            let search = document.getElementById('codigo_producto').value;
            getExistencias(search)
        }

        var existencia = [];

        function getExistencias(search) {


            $.ajax({
                url: "{{url('movimientos/existencia/productos')}}" + "?search=" + search + "&ubicacion=1",
                type: "get",
                dataType: "json",
                success: function (response) {


                    if (response.length == 0) {

                        alertInexitencia();
                        document.getElementById('descripcion').value ="";
                        document.getElementById('cantidad').readOnly = true;

                    } else {
                        existencia = response;
                        document.getElementById('descripcion').value = response[0].producto.descripcion;
                        document.getElementById('cantidad').readOnly = false;
                        document.getElementById('cantidad').focus();

                    }

                },
                error: function (e) {
                    console.error(e);
                }
            })
        }

        function cargarExistencia(existencias) {

            let row = "";
            existencias.forEach(function (e) {
                row += `<tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            `;
            });

        }

        function alertInexitencia() {

        }

        function getTotalExistencia() {

            let total = 0;
            if (existencia.length > 0) {
                total = existencia.map(e => e.total).reduce((accum, curr) => parseInt(accum) + parseInt(curr));
            }

            return total;
        }

    </script>
@endsection
