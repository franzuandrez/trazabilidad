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
            <input type="hidden" name="id_producto" id="id_producto" readonly value="{{old('id_producto')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
        <div class="form-group">
            <label for="descripcion">CANTIDAD</label>
            <input type="number" name="cantidad" id="cantidad"
                   onkeydown="if(event.keyCode==13)agregarProducto()"
                   readonly
                   value="{{old('cantidad')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <th>CANTIDAD</th>
            <th>PRODUCTO</th>
            <th>LOTE</th>
            </thead>
            <tbody id="body-detalles">
            </tbody>
        </table>
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
                        document.getElementById('descripcion').value = "";
                        document.getElementById('cantidad').readOnly = true;

                    } else {
                        existencia = response;
                        document.getElementById('descripcion').value = response[0].producto.descripcion;
                        document.getElementById('id_producto').value = response[0].producto.id_producto;
                        document.getElementById('cantidad').readOnly = false;
                        document.getElementById('cantidad').focus();

                    }

                },
                error: function (e) {
                    console.error(e);
                }
            })
        }

        function cargarLotes(existencias, lotesEntrantes) {

            let row = '';

            for (var i = 0; i < existencias.length; i++) {

                if (lotesEntrantes[i] > 0) {
                    row += ` <tr>
                    <td>
                        <input type="hidden" name="id_producto[]"   value="${existencias[i].producto.id_producto}">
                        <input type="hidden" name="cantidad_entrante[]"  value="${lotesEntrantes[i]}" >
                        <input type="hidden" name="no_lote[]"   value="${existencias[i].lote}">
                    </td>
                    <td> ${lotesEntrantes[i]}</td>
                    <td>${existencias[i].producto.descripcion}</td>
                    <td>${existencias[i].lote}</td>
                    </tr>    `;
                }
            }
            $('#body-detalles').append(row);

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

        function agregarProducto() {
            let id_producto = document.getElementById('id_producto').value;
            let cantidad = document.getElementById('cantidad').value;
            if(cantidad==""){
                alert("Cantidad invalida");
                return;
            }
            let cantidadAgregada = getCantidadAgregada(id_producto);
            cantidad = parseInt(cantidad) + cantidadAgregada;
            if (cantidad > getTotalExistencia()) {
                alert("Cantidad insuficiente");
                document.getElementById('cantidad').value = "";
            } else {
                limpiarProductoAgregados(id_producto);
                let cantidadesEntrantes = getTotalPorLote(cantidad);
                cargarLotes(existencia, cantidadesEntrantes);
                document.getElementById('cantidad').value = "";
                document.getElementById('cantidad').readOnly = true;
                document.getElementById('codigo_producto').value = "";
                existencia.splice(0, existencia.length);
            }


        }

        function getTotalPorLote(total) {

            let lotes = existencia.map(prod => parseInt(prod.total));
            let entrante = [];
            let nuevoTotal = parseInt(total);
            for (var i = 0; i < lotes.length; i++) {

                if (lotes[i] <= nuevoTotal) {
                    entrante.push(lotes[i]);
                    nuevoTotal = nuevoTotal - lotes[i];
                } else {
                    entrante.push(nuevoTotal);
                    nuevoTotal = 0;
                }

            }

            return entrante;

        }

        function getCantidadAgregada(id_producto) {
            let productos = document.getElementsByName('id_producto[]');
            let sum = 0;
            for (var i = 0; i < productos.length; i++) {

                if (productos[i].value == id_producto) {
                    sum = sum + parseInt(document.getElementsByName('id_producto[]')[i].nextSibling.nextSibling.value);
                }
            }

            return sum;
        }

        function limpiarProductoAgregados( id_producto ){
            Array.prototype.slice.call(document.getElementsByName('id_producto[]')).forEach(function (e) {
                if(e.value == id_producto){
                    e.parentNode.parentNode.remove();
                }
            })

        }

        function removeFromTable(element){
            let td = $(element).parent();
            let row = td.parent();
            row.remove();
        }
    </script>
@endsection
