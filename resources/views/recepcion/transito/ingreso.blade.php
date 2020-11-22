@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-list',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Control Calidad
        @endslot
    @endcomponent

    {!!Form::model($recepcion,['method'=>'PATCH','route'=>['recepcion.transito.ingresar',$recepcion->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">No. Documento</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">Proveedor</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->nombre_comercial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo_producto">Cod. Producto</label>
        <div class="form-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscarProducto(document.getElementById('codigo_producto'))"
                   name="codigo_producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <label for="codigo_producto">Producto</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="descripcion"
                   name="descripcion"
                   class="form-control">
        </div>
    </div>
    <input type="hidden"
           readonly
           id="id_movimiento"
           name="id_movimiento"
           class="form-control">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <label for="codigo_producto">No. Lote</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   onkeydown="if(event.keyCode == 13)fillProduct(document.getElementById('codigo_producto').value,document.getElementById('lote').value)"
                   id="lote"
                   name="lote"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-6 col-xs-6" style="display: none">
        <label for="cantidad_impresion">CANTIDAD IMPRESION</label>
        <div class="form-group">
            <input type="number"
                   readonly
                   value="1"
                   onkeydown="if(event.keyCode==13)document.getElementById('cantidad').focus()"
                   id="cantidad_impresion"
                   name="cantidad_impresion"
                   class="form-control">
        </div>
    </div>
    @include('recepcion.transito.productos')
    @include('recepcion.transito.modal_confirmar')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <label for="cantidad">Cantidad  Entrante</label>
        <div class="form-group">
            <input type="number"
                   readonly
                   onkeydown="if(event.keyCode==13)addToTable()"
                   id="cantidad"
                   name="cantidad"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="observaciones" id="observaciones">

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>Producto</th>
                    <th>No.Lote</th>
                    <th>F.Venc</th>
                    <th>Cantidad</th>
                    <th>Cantidad Entrante</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach( $movimientos as $key => $mov)

                    <tr id="mov-{{$mov->id_rmi_detalle}}" class="row-producto">
                        <td>
                            {{$mov->producto->descripcion}}
                        </td>
                        <td>
                            {{$mov->lote}}
                            <input type="hidden" name="lote[]" value="{{$mov->lote}}">
                        </td>
                        <td>
                            {{$mov->fecha_vencimiento->format('d/m/Y')}}
                            <input type="hidden" name="fecha_vencimiento[]"
                                   value="{{$mov->fecha_vencimiento->format('Y-m-d')}}">
                        </td>
                        <td>
                            {{ number_format(($mov->total),3,'.',',') }}
                        </td>
                        <td>
                            <input type="hidden" name="cantidad_entrante[]" value="0">
                        </td>
                        <td style="display: none">
                            <input type="hidden" value=1" name="imprimir[]">
                        </td>
                        <td>
                            <span class="label label-success hidden">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
                            <input type="hidden" name="codigo_barra[]" value="{{$mov->producto->codigo_barras}}">
                            <input type="hidden" name="id_movimiento[]" value="{{$mov->id_rmi_detalle}}">
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-primary" id="btnGuardar"
                    onclick="confirmar()"
                    disabled
                    type="button">
                <span class=" fa fa-check"></span> Guardar
            </button>
            <a href="{{url('recepcion/transito ')}}">
                <button class="btn btn-primary" type="button">
                   <span class=" fa fa-close"></span> Cancelar
                </button>
            </a>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js-brc/tools/lectura_codigo.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        function confirmar() {

            const existe_diferencia = Array.prototype.slice.call(document.getElementsByName('diferencia[]')).filter(e => e.value > 0).length > 0;

            if (existe_diferencia) {
                $('#modal_confirmar').modal();
                document.getElementById('observaciones_previa').focus();
            } else {
                if (confirm("¿Está seguro que desea continuar")) {
                    $('form').submit();
                }
            }


        }

        function verficar_obsevaciones(value) {


            document.getElementById('btn_confirmar_observaciones').disabled = value == "";

        }

        function cargar_observaciones() {
            const observaciones_previa = document.getElementById('observaciones_previa').value;
            if (observaciones_previa == "") {
                alert("La observaciones son requeridas");
                document.getElementById('observaciones_previa').focus();
                $('#modal_confirmar').modal();
                return;
            }
            document.getElementById("observaciones").value = observaciones_previa;
            $('form').submit();
        }


        function getMovimientos() {
            var movimientos = @json($movimientos);
            return movimientos;
        }

        function getMovimientoByLote(codigo_barras, lote) {
            let mov = null;
            let movimientos = getMovimientos();

            mov = movimientos.filter(mov => mov.producto.codigo_barras == codigo_barras.trim()).find(lotes => lotes.lote.toUpperCase() == lote.trim().toUpperCase());
            if (typeof mov == 'undefined') {
                //buscar por descripcion
                mov = movimientos.filter(mov => mov.producto.descripcion.toUpperCase() == codigo_barras.trim().toUpperCase()).find(lotes => lotes.lote.toUpperCase() == lote.trim().toUpperCase());
            }

            return mov;
        }


        function buscarProducto(input) {

            if (event.keyCode == 13) {

                let regexp = new RegExp(input.value.trim(), 'i');
                let productos = getMovimientos()
                    .filter(function (e) {
                        return !productos_agregados.includes(e.id_rmi_detalle.toString())
                    })
                    .filter(mov => mov.producto.descripcion.trim().match(regexp) || mov.producto.codigo_barras.trim() == input.value.trim() || mov.producto.codigo_interno.toUpperCase().trim() == input.value.trim().toUpperCase());
                let cantidad_matches = productos.length;
                let noexisteproducto = cantidad_matches == 0;
                let no_es_codigo_estandar = input.value < 13;

                if (noexisteproducto && no_es_codigo_estandar) {
                    alert("Producto no encontrado");
                    return;
                }

                if (cantidad_matches == 1) {
                    fillProduct(productos[0].producto.codigo_barras, productos[0].lote)
                    return;
                }


                if (input.value == "" || cantidad_matches > 1) {
                    cargarProductos(input.value);
                    return;
                }

                let infoProducto = descomponerInput(input);
                let codigo = infoProducto[POSICION_CODIGO];
                let lote = infoProducto[POSICION_LOTE];
                fillProduct(codigo, lote);


            }
        }

        function cargarProductos(search = null) {
            $('#tbody-productos').empty();
            let movimientos = null;

            if (search == null || search == "") {
                movimientos = getMovimientos();
            } else {
                var regexp = new RegExp(search.trim(), 'i');
                movimientos = getMovimientos()
                    .filter(function (e) {
                        return !productos_agregados.includes(e.id_rmi_detalle.toString())
                    }).filter(mov => mov.producto.descripcion.trim().match(regexp) || mov.producto.codigo_barras.trim() == search.trim() || mov.producto.codigo_interno.trim().toUpperCase() == search.trim().toUpperCase());
            }

            let row = '';
            movimientos.forEach(function (e) {
                row += `<tr onclick="seleccionarProducto(this)">
                         <td><input type="radio" name="movimientos" onclick="document.getElementById('aceptar_producto').disabled=false"></td>
                         <td>${e.producto.codigo_barras}</td>
                         <td>${e.producto.descripcion}</td>
                         <td>${e.lote}</td>
                         <td>${moment(e.fecha_vencimiento, '').format('DD/MM/Y')}</td>
                        </tr>`
            })

            $('#tbody-productos').append(row);
            $('#modal-productos').modal();
        }

        function seleccionarProducto(element) {
            element.children[0].children[0].checked = true;
            document.getElementById('aceptar_producto').disabled = false;
        }

        function addToTable() {


            let cantidad = document.getElementById('cantidad').value;
            let id = document.getElementById('id_movimiento').value;
            let cantidad_impresiones = document.getElementById('cantidad_impresion').value;

            if (cantidad == "") {
                document.getElementById('cantidad').focus();
                alert("Cantidad entrante en blanco");
                return
            }

            if (cantidad_impresiones == "") {
                document.getElementById('cantidad_impresion').focus();
                alert("Cantidad de impresiones en blanco");
                return
            }
            if (id == "") {
                alert("Algo salio mal");
                return
            }

            if (cantidadMinima < cantidad) {
                alert("La cantidad entrante no puede ser mayor");
                document.getElementById('cantidad').focus();
                return;
            }

            checkRow(id, cantidad, cantidad_impresiones);
            document.getElementById('codigo_producto').value = "";
            document.getElementById('descripcion').value = "";
            document.getElementById('cantidad').value = "";
            document.getElementById('lote').value = "";
            document.getElementById('codigo_producto').focus();
            document.getElementById('cantidad').readOnly = true;
            document.getElementById('cantidad_impresion').value = 1;
            document.getElementById('cantidad_impresion').readOnly = true;
            cantidadMinima = 0;

            if (document.getElementsByClassName('hidden').length == 0) {
                document.getElementById('btnGuardar').disabled = false;
            }


        }

        var cantidadMinima = 0;

        function fillProduct(codigo, lote) {


            let mov = getMovimientoByLote(codigo, lote);
            if (typeof mov != "undefined") {
                let producto = null;
                document.getElementById('lote').readOnly = true;
                producto = mov.producto;

                if (producto.codigo_barras.toUpperCase() == codigo.toUpperCase() || producto.descripcion.toUpperCase() == codigo.toUpperCase() || producto.codigo_interno.toUpperCase() == codigo.toUpperCase()) {
                    document.getElementById('descripcion').value = producto.descripcion;
                    document.getElementById('lote').value = lote;
                    document.getElementById('id_movimiento').value = mov.id_rmi_detalle;
                    document.getElementById('cantidad_impresion').readOnly = false;
                    document.getElementById('cantidad').readOnly = false;
                    document.getElementById('cantidad').value = mov.cantidad;
                    document.getElementById('cantidad').focus();
                    cantidadMinima = parseFloat(mov.cantidad);
                } else {
                    document.getElementById('descripcion').value = "";
                    document.getElementById('lote').value = "";
                    document.getElementById('id_movimiento').value = "";
                    alert("Producto no encontrado");
                }
            } else {
                document.getElementById('descripcion').value = "";
                document.getElementById('lote').value = "";
                document.getElementById('id_movimiento').value = "";
                alert("Producto con lote no encontrado");
            }

        }

        function setProducto() {

            let producto = getProductoSelected();
            setTimeout(function () {
                fillProduct(producto[1], producto[2])
            }, 500)

        }

        function getProductoSelected() {
            var productos = document.getElementsByName('movimientos');
            var id_prod = null;
            var descripcion = null;
            var codigo = null, lote = null;

            var arrayProductos = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            });


            arrayProductos.forEach(function (prod) {
                if (prod[1].checked) {
                    var childrens = prod[1].parentElement.parentElement.children;
                    id_prod = childrens[0].firstChild.value;
                    descripcion = childrens[2].innerText;
                    codigo = childrens[1].innerText;
                    lote = childrens[3].innerText;
                }
            });
            return [id_prod, codigo, lote, descripcion];
        }

        var productos_agregados = [];

        function checkRow(idMovimiento, cantidad, impresiones) {


            let row = document.getElementById('mov-' + idMovimiento);
            let span = row.children[6].children[0];
            span.classList.remove('hidden');
            const cantidad_recepcionada = parseFloat(row.children[3].innerText);
            row.children[5].innerHTML = "<input name='imprimir[]' value='" + impresiones + "' type='hidden'  >" + impresiones + " ";
            row.children[4].innerHTML = parseFloat(cantidad).toLocaleString('en', {
                minimumFractionDigits: 3,
                maximumFractionDigits: 3
            }) + "<input name='cantidad_entrante[]' type='hidden' value='" + cantidad + "'><input name='diferencia[]' type='hidden' value='" + (cantidad_recepcionada - cantidad) + "'> ";
            productos_agregados.push(idMovimiento);
        }

        function activarCheck(input) {

            input.nextSibling.disabled = input.checked;

        }

        const POSICION_CODIGO = 1;
        const POSICION_FECHA = 2;
        const POSICION_LOTE = 3;


    </script>
@endsection
