@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-spoon',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Mezcla Harina
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/mezcla_harina/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <!-- <input type="hidden" id="id_producto" name="id_producto"> -->
    <input type="hidden"   id="id_producto" name="id_producto">
    <input  type="hidden"   id="CodigoProducto" name="CodigoProducto">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="NO_ORDEN_PRODUCCION" value="{{old('NO_ORDEN_PRODUCCION')}}"
                   class="form-control">

        </div>
    </div>


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">RESPONSABLES</label>
            <select name="id_responsable_maquina" class="form-control selectpicker" id="id_responsable_maquina">
                <option value="">SELECCIONAR RESPONSABLE</option>
                @foreach($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO</label>
            <input id="codigo_producto" name="codigo_producto" type="text"
                   onkeydown="cargarInfoCodigoBarras(this)"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <div class="tab-content">
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="lote">LOTE</label>
                        <input id="lote" type="text"  readonly name="lote"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="producto">PRODUCTO</label>
                        <input id="descripcion_producto" type="text" readonly name="descripcion_producto"
                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <label for="hora_carga">HORA CARGA</label>
                    <div class="input-group date1" id='datetimepicker3'>
                        <input id="hora_carga" type="text" name="descripcion" class="form-control">
                        <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="hora_descarga">HORA DESCARGA</label>
                        <input id="hora_descarga" type="text" name="hora_descarga"

                               class="form-control">
                    </div>
                </div>



                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="solucion">LBS DE SOLUCIÓN (158.4 A 168.5)</label>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="_solucion_inicial">DATO INICIAL</label>
                        <input id="solucion_inicial" type="text" name="solucion_inicial"
                               onkeydown="if(event.keyCode==13)validacion(this,158.4,168.5,document.getElementById('solucion_final'),document.getElementById('solucion_observacion'))"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="_solucion_final">DATO FINAL</label>
                        <input id="solucion_final" type="text" readonly name="solucion_final"
                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="observacion">OBSERVACIONES</label>
                        <input id="solucion_observacion" type="text" name="solucion_observacion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="_solucion_final"> </label>
                    </div>
                </div>








                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="ph">PH (8-11 PPM)</label>

                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3-xs-12">
                    <div class="form-group">
                        <label for="_solucion_inicial">DATO INICIAL</label>
                        <input id="ph_inicial" type="text" name="ph_inicial"
                               onkeydown="if(event.keyCode==13)validacion(this,8,11,document.getElementById('ph_final'),document.getElementById('ph_observacion'))"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group">
                        <label for="_solucion_final">DATO FINAL</label>
                        <input id="ph_final" type="text" readonly name="ph_final"
                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-8">
                    <div class="form-group">
                        <label for="observacion">OBSERVACIONES</label>
                        <input id="ph_observacion" type="text" name="ph_observacion"
                               class="form-control">
                    </div>
                </div>



                <div class="col-lg-3 col-md-3 col-sm-3  col-xs-4">
                    <br>
                    <div class="form-group">
                        <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                            <span class=" fa fa-plus"></span></button>
                        <button id="btnLimpiar" class="btn btn-default block" style="margin-top: 5px;" type="button">
                            <span class=" fa fa-trash"></span></button>
                    </div>
                </div>


                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                        <thead style="background-color: #01579B;  color: #fff;">
                        <th>OPCION</th>
                        <th>LOTE</th>
                        <th>PRODUCTO</th>
                        <th>HORA CARGA</th>
                        <th>HORA DESCARGA</th>
                        <th>SOLUCION INICAL</th>
                        <th>SOLUCION FINAL</th>
                        <th>PH INICIAL</th>
                        <th>PH FINAL</th>


                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
                        <input type="text" name="observacion" id = "observacion" value="{{old('observacion')}}"
                               class="form-control">
                    </div>
                </div>
                <!--
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">RESPONSABLE:</label>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="puesto">PUESTO</label>
                        <input type="text" name="puesto" value="{{old('puesto')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="nombre">NOMBRE</label>
                        <input type="text" name="nombre" value="{{old('nombre')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="firma">FIRMA</label>
                        <input type="text" name="firma" value="{{old('firma')}}"
                               class="form-control">
                    </div>
                </div> --->
            </div>
        </div>
    </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/mezcla_harina')}}">
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
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {

            $("#btnAdd").click(function () {
                addToTable();
            });

        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>
    <script>
        function cargarProveedores() {
            //NOT IMPLEMENTED
        }

        function addToTable() {
            if ($("#lote").val() != "" && $("#id_producto").val() != "" && $("#hora_carga").val() != "" && $("#hora_descarga").val() != "" && $("#solucion_inicial").val() != "" && $("#ph_inicial").val() != "" ) {
                let lote = $("#lote");
                let producto = $("#descripcion_producto");
                let hora_carga = $("#hora_carga");
                let hora_descarga = $("#hora_descarga");
                let solucion_inicial = $("#solucion_inicial");
                let solucion_final = $("#solucion_final");
                let solucion_observacion = $("#solucion_observacion");

                let ph_inicial = $("#ph_inicial");
                let ph_final = $("#ph_final");
                let ph_observacion = $("#ph_observacion");

                let codigo_producto = $("#CodigoProducto");
                let id_producto = $("#id_producto");
                let cadenaBusqueda = $("#codigo_producto");
                //removeFromTareas(tarea);
                //removeFromSelect(vendedor);
                let row =
                    `<tr>
                    <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button>
                    <input type="hidden" value ='${codigo_producto.val()}'  name=codigo_producto[] >
                    <input type="hidden" value ='${id_producto.val()}'  name=id_producto[] >
                    <input type="hidden" value ='${ph_observacion.val()}'  name=ph_observacion[] >
                    <input type="hidden" value ='${solucion_observacion.val()}'  name=solucion_observacion[] >


                    </td>
                    <td><input type="hidden" value='${lote.val()}' name=lote[]>${lote.val()}</td>
                    <td><input type="hidden" value='${producto.val()}' name=producto[]>${producto.val()}</td>
                    <td ><input type="hidden" value ='${hora_carga.val()}'  name=hora_carga[] >${hora_carga.val()}</td>
                    <td ><input type="hidden" value ='${hora_descarga.val()}'  name=hora_descarga[] >${hora_descarga.val()}</td>
                    <td ><input type="hidden" value ='${solucion_inicial.val()}'  name=solucion_inicial[] >${solucion_inicial.val()}</td>
                    <td ><input type="hidden" value ='${solucion_final.val()}'  name=solucion_final[] >${solucion_final.val()}</td>
                    <td ><input type="hidden" value ='${ph_inicial.val()}'  name=ph_inicial[] >${ph_inicial.val()}</td>
                    <td ><input type="hidden" value ='${ph_final.val()}'  name=ph_final[] >${ph_final.val()}</td>
                    </tr>`;



                $("#detalles").append(row);

                lote.val('');
                producto.val('');
                hora_carga.val('');
                hora_descarga.val('');
                solucion_inicial.val('');
                solucion_final.val('');
                solucion_observacion.val('');
                ph_inicial.val('');
                ph_final.val('');
                ph_observacion.val('');
                codigo_producto.val('');
                id_producto.val('');
                cadenaBusqueda.val('');
                solucion_final.attr('readonly', true);
                ph_final.attr('readonly', true);
                cadenaBusqueda.focus();
            } else {
                $('#modal-default').modal('show');
                return false;
            }
        }

        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            td.parent().remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();
        }

        function justNumbers(e) {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
                return true;

            return /\d/.test(String.fromCharCode(keynum));
        }

        function limpiar() {
            document.getElementById('id_producto').value = "";
            document.getElementById('CodigoProducto').value = "";
            document.getElementById('lote').value = "";
            document.getElementById('descripcion_producto').value = "";
            document.getElementById('hora_carga').value = "";
            document.getElementById('hora_descarga').value = "";
            document.getElementById('lote').readOnly = true;
        }

        function mostrarProductosCargados() {

            setTimeout(function () {
                $('#modal-productos').modal();
            }, 1000);
        }

        function mostrarAlertaNotFound() {
            $('#not_found').modal();
        }

        function habilitar() {

            document.getElementById('aceptar_producto').disabled = false;

        }

        function setProducto() {

            let infoProd = getProductoSelected();
            if (infoProd.length != 0) {
                cargarProducto(infoProd);
            } else {


            }


        }

        function descomponerInput(input) {
            var codigoBarras = input.value;
            var codigo,fecha_vencimiento,lote;

            if(codigoBarras.trim().length <= 14){
                codigo = codigoBarras;
                fecha_vencimiento = "";
                lote = "";
            }else{
                codigo = codigoBarras.substring(2,16);
                fecha_vencimiento = codigoBarras.substring(18,24);
                lote = codigoBarras.substring(26,codigoBarras.length);
            }
            return ["",codigo,fecha_vencimiento,lote];
        }

        function getProductoSelected() {
            var productos = document.getElementsByName('id_prod');
            var id_prod = null;
            var descripcion = null;
            var id_prov = null;
            var razon_social = null;

            var arrayProductos = Object.keys(productos).map(function (key) {
                return [Number(key), productos[key]];
            });


            arrayProductos.forEach(function (prod) {
                if (prod[1].checked) {
                    var childrens = prod[1].parentElement.parentElement.children;
                    id_prod = childrens[0].firstChild.value;
                    descripcion = childrens[2].innerText;
                    razon_social = childrens[3].innerText;
                    id_prov = childrens[3].firstChild.value;

                }
            });
            return [id_prod, descripcion, id_prov, razon_social];
        }

        function cargarInfoCodigoBarras(input)
        {

            if (event.keyCode == 13) {
                limpiar();
                let infoCodigoBarras = descomponerInput(input);
                buscar_producto_by_codigo(infoCodigoBarras);
            }
        }

        function buscar_producto_by_codigo(infoCodigoBarras) {
            const POSICION_CODIGO = 1;
            const POSICION_FECHA = 2;
            const POSICION_LOTE = 3;

            let fecha = infoCodigoBarras[POSICION_FECHA];
            let codigo = infoCodigoBarras[POSICION_CODIGO];
            let lote = infoCodigoBarras[POSICION_LOTE];
            $.ajax({

                url: "{{url('registro/productos/search')}}" + "/" + codigo,
                type: "get",
                dataType: "json",
                success: function (response) {
                    let productos = response;
                    let totalProductos = productos.length;
                    if (totalProductos == 0) {
                        alert("No se encontro producto");
                        document.getElementById("codigo_producto").select();
                        document.getElementById('id_producto').value = "";
                        document.getElementById('descripcion_producto').value = "";
                        document.getElementById('lote').value = "";
                        document.getElementById('hora_carga').value = "";
                        document.getElementById('hora_descarga').value = "";
                        document.getElementById('solucion').value = "";
                        document.getElementById('ph').value = "";
                        document.getElementById('observaciones_detalle').value = "";
                        document.getElementById('lote').readOnly= true;


                    }  else {
                        let producto = productos[0];
                        document.getElementById('id_producto').value = producto.id_producto;
                        document.getElementById('descripcion_producto').value = producto.descripcion;
                        document.getElementById('CodigoProducto').value = codigo;
                        if (lote =="") {
                            document.getElementById('lote').readOnly= false;
                            document.getElementById('lote').focus();
                        }
                        else {
                            document.getElementById('lote').value = lote;
                            document.getElementById('hora_carga').focus();
                        }
                    }

                },
                error: function (e) {
                console.log(e);
            }
            })
        }

        function validacion(input, rango_inicial, rango_final, final, next) {


                let  actual = parseFloat(input.value);
                rango_inicial = parseFloat(rango_inicial);
                rango_final = parseFloat(rango_final);

                final.readOnly = true;
                final.value = "";
                next.value = "";

                if ((actual >= rango_inicial) && ( actual <= rango_final ) ){
                    final.readOnly = true;
                    next.focus ();
                    return true;
                }else{
                    final.readOnly = false;
                    final.focus();
                    return false;
                }
        }



</script>
@endsection

