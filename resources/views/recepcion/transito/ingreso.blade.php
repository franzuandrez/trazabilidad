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
    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8">
        <label for="codigo_producto">CODIGO PRODUCTO</label>
        <div class="form-group">
            <input type="text"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)$('#cantidad').focus()"
                   name="codigo_producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
        <label for="cantidad">CANTIDAD</label>
        <div class="form-group">
            <input type="text"
                   onkeydown="buscarProducto(document.getElementById('codigo_producto'))"
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
                            <input type="hidden" name="id_movimiento[]" value="{{$mov->id_movimiento}}" >
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

        function getMovimientoByLote(codigo_barras,lote) {
            let mov = null;
            let movimientos = getMovimientos();

            mov = movimientos.filter( mov => mov.producto.codigo_barras ==codigo_barras.trim() ).find(lotes=>lotes.lote==lote.trim());
            return mov;
        }

        function descomponerInput(input) {

            var codigoBarras = input.value;
            var removerParentesis = codigoBarras.replace(/\([0-9]*\)/g, '-');
            var codigoSplited = removerParentesis.split('-');


            return codigoSplited;


        }

        function buscarProducto(input) {

            if (event.keyCode == 13) {

                let infoProducto = descomponerInput(input);
                let mov = getMovimientoByLote(infoProducto[POSICION_CODIGO],infoProducto[POSICION_LOTE]);

                if (typeof mov != "undefined") {
                    let producto = null;
                    producto = mov.producto;
                    console.log(producto);
                    if( producto.codigo_barras ==  infoProducto[POSICION_CODIGO]){
                        let cantidad = document.getElementById('cantidad').value;
                        checkRow(mov.id_movimiento,cantidad);
                        document.getElementById('codigo_producto').value = "";
                        document.getElementById('cantidad').value="";
                        document.getElementById('codigo_producto').focus();
                    }else{
                        alert("Producto no encontrado");
                    }
                }else{
                    alert("Lote no encontrado");
                }
            }
        }



        function checkRow(idMovimiento,cantidad){

            console.log(idMovimiento);
           let row =  document.getElementById('mov-'+idMovimiento);
           let span = row.children[0].children[0];
           span.classList.remove('hidden');
           row.children[1].innerHTML = cantidad+"<input name='cantidad_entrante[]' type='hidden' value='"+cantidad+"' > ";
        }

        const POSICION_CODIGO = 1;
        const POSICION_FECHA = 2;
        const POSICION_LOTE = 3;


    </script>
@endsection
