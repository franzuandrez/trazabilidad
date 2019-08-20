@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-arrow-right',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Transito
        @endslot
    @endcomponent

    {!!Form::model($recepcion,['method'=>'PATCH','route'=>['recepcion.transito.ingresar',$recepcion->id_recepcion_enc]])!!}
    {{Form::token()}}


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$recepcion->orden_compra}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <input type="text" id="proveedor"
                   name="proveedor"
                   readonly
                   value="{{$recepcion->proveedor->razon_social}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text"
                   readonly
                   name="documento_proveedor"
                   value="{{$recepcion->documento_proveedor}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo_producto">CODIGO PRODUCTO</label>
        <div class="form-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="buscarProducto(document.getElementById('codigo_producto'))"
                   name="codigo_producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <label for="codigo_producto">PRODUCTO</label>
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
        <label for="codigo_producto">LOTE</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   onkeydown="if(event.keyCode == 13)fillProduct(document.getElementById('codigo_producto').value,document.getElementById('lote').value)"
                   id="lote"
                   name="lote"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
        <label for="cantidad">CANTIDAD</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   onkeydown="if(event.keyCode==13)addToTable()"
                   id="cantidad"
                   name="cantidad"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>OPCION</th>
                    <th>IMPRIMIR</th>
                    <th>CANTIDAD ENTRANTE</th>
                    <th>CANTIDAD</th>
                    <th>PRODUCTO</th>
                    <th>LOTE</th>
                    <th>FECHA VENCIMIENTO</th>
                </tr>
                </thead>
                <tbody>

                @foreach( $movimientos as $mov)

                    <tr id="mov-{{$mov->id_movimiento}}">
                        <td>
                            <span class="label label-success hidden">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </span>
                            <input type="hidden" name="codigo_barra[]" value="{{$mov->producto->codigo_barras}}">
                            <input type="hidden" name="id_movimiento[]" value="{{$mov->id_movimiento}}">
                        </td>
                        <td>
                            <input type="hidden" value="0" name="imprimir[]">
                        </td>
                        <td>
                            <input type="hidden" name="cantidad_entrante[]" value="0">
                        </td>
                        <td>
                            {{$mov->total}}
                        </td>
                        <td>
                            {{$mov->producto->descripcion}}
                        </td>
                        <td>
                            {{$mov->lote}}
                            <input type="hidden" name="lote[]" value="{{$mov->lote}}">
                        </td>
                        <td>
                            {{$mov->fecha_vencimiento}}
                            <input type="hidden" name="fecha_vencimiento[]" value="{{$mov->fecha_vencimiento}}">
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('recepcion/transito')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        })

        function getMovimientos() {
            var movimientos = @json($movimientos);
            return movimientos;
        }

        function getMovimientoByLote(codigo_barras, lote) {
            let mov = null;
            let movimientos = getMovimientos();

            mov = movimientos.filter(mov => mov.producto.codigo_barras == codigo_barras.trim()).
            find(lotes => lotes.lote == lote.trim());
            return mov;
        }

        function descomponerInput(input) {

            var codigoBarras = input.value;
            var codigo, fecha_vencimiento, lote;
            if (codigoBarras.length == 14) {
                codigo = codigoBarras;
                fecha_vencimiento = "";
                lote = "";
            } else {
                codigo = codigoBarras.substring(2, 16);
                fecha_vencimiento = codigoBarras.substring(18, 24);
                lote = codigoBarras.substring(26, codigoBarras.length);
            }


            return ["", codigo, fecha_vencimiento, lote];


        }

        function buscarProducto(input) {

            if (event.keyCode == 13) {

                let infoProducto = descomponerInput(input);

                if (infoProducto[POSICION_LOTE] == "") {
                    document.getElementById('lote').readOnly = false;
                    document.getElementById('lote').focus();
                } else {
                    let codigo = infoProducto[POSICION_CODIGO];
                    let lote = infoProducto[POSICION_LOTE];
                    fillProduct(codigo,lote);
                }


            }
        }

        function addToTable() {

                let cantidad = document.getElementById('cantidad').value;
                let id = document.getElementById('id_movimiento').value;
                checkRow(id, cantidad);
                document.getElementById('codigo_producto').value = "";
                document.getElementById('descripcion').value = "";
                document.getElementById('cantidad').value = "";
                document.getElementById('lote').value = "";
                document.getElementById('codigo_producto').focus();
                document.getElementById('cantidad').readOnly = true;

        }



        function fillProduct(codigo,lote){


            let mov = getMovimientoByLote(codigo,lote);
            if (typeof mov != "undefined") {
                let producto = null;
                document.getElementById('lote').readOnly = true;
                producto = mov.producto;
                console.log(producto);
                if (producto.codigo_barras == codigo) {
                    document.getElementById('descripcion').value = producto.descripcion;
                    document.getElementById('cantidad').focus();
                    document.getElementById('lote').value = lote;
                    document.getElementById('id_movimiento').value = mov.id_movimiento;
                    document.getElementById('cantidad').readOnly = false;
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
                alert("Lote no encontrado");
            }

        }

        function checkRow(idMovimiento, cantidad) {


            let row = document.getElementById('mov-' + idMovimiento);
            let span = row.children[0].children[0];
            span.classList.remove('hidden');
            row.children[1].innerHTML =  "<input name='imprimir[]' onclick='activarCheck(this)' type='checkbox' checked value='1' ><input name='imprimir[]' value=0 type='hidden' disabled > ";
            row.children[2].innerHTML = cantidad + "<input name='cantidad_entrante[]' type='hidden' value='" + cantidad + "'> ";
        }

        function activarCheck( input ) {

         input.nextSibling.disabled = input.checked;

        }

        const POSICION_CODIGO = 1;
        const POSICION_FECHA = 2;
        const POSICION_LOTE = 3;


    </script>
@endsection
