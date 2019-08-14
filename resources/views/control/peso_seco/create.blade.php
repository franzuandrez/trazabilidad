@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-bar-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Peso Seco
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/peso_seco/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cortadora">CORTADORA NO.</label>
            <input id="cortadora" type="text"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input id="turno" type="text"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="codigo">CODIGO</label>
            <input id="codigo" type="text"
                   onkeydown="descomponerInput(this)"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <div class="tab-content">
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <label for="hora">HORA</label>
                    <div class="input-group">
                        <input id="hora" type="text" class="form-control timepicker" name="hora">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="no_1">NO. 1</label>
                        <input id="no_1" type="text" name="no_1"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="no_2">NO. 2</label>
                        <input id="no_2" type="text" name="no_2"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="no_3">NO. 3</label>
                        <input id="no_3" type="text" name="no_3"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="no_4">NO. 4</label>
                        <input id="no_4" type="text" name="no_4"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="no_5">NO. 5</label>
                        <input id="no_5" type="text" name="no_5"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="lote">LOTE</label>
                        <input id="lote" type="text" name="lote"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="producto">PRODUCTO</label>
                        <input id="producto" type="text" name="producto"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="observaciones">OBSERVACIONES</label>
                        <input id="observaciones" type="text" name="observaciones"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-2 col-sm-4 col-md-2 col-xs-2">
                    <br>
                    <div class="form-group">
                        <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                            <span class=" fa fa-plus"></span></button>
                    </div>
                </div>


                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                        <thead style="background-color: #01579B;  color: #fff;">
                        <th>OPCION</th>
                        <th>HORA</th>
                        <th>NO. 1</th>
                        <th>NO. 2</th>
                        <th>NO. 3</th>
                        <th>NO. 4</th>
                        <th>NO. 5</th>
                        <th>LOTE</th>
                        <th>PRODUCTO</th>
                        <th>OBSERVACIONES</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
                        <input type="text" name="observacion_correctiva" value="{{old('observacion_correctiva')}}"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observacion_correctiva">RESPONSABLE VERIFICADOR:</label>
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
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/peso_seco')}}">
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
        $(function () {
            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            });
        })

    </script>

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
            if ($("#hora").val() != "" && $("#no_1").val() != "" && $("#no_2").val() != "" && $("#no_3").val() != "" && $("#no_4").val() != "" && $("#no_5").val() != ""&& $("#lote").val() != ""  && $("#producto").val() != "" && $("#observaciones").val() != "") {
                let hora = $("#hora");
                let no_1 = $("#no_1");
                let no_2 = $("#no_2");
                let no_3 = $("#no_3");
                let no_4 = $("#no_4");
                let no_5 = $("#no_5");
                let lote = $("#lote");
                let producto = $("#producto");
                let observaciones = $("#observaciones");
                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${hora.val()}' name=hora[]>${hora.val()}</td>
            <td><input type="hidden" value='${no_1.val()}' name=no_1[]>${no_1.val()}</td>
            <td ><input type="hidden" value ='${no_2.val()}'  name=no_2[] >${no_2.val()}</td>
            <td ><input type="hidden" value ='${no_3.val()}'  name=no_3[] >${no_3.val()}</td>
            <td ><input type="hidden" value ='${no_4.val()}'  name=no_4[] >${no_4.val()}</td>
            <td ><input type="hidden" value ='${no_5.val()}'  name=no_5[] >${no_5.val()}</td>
            <td ><input type="hidden" value ='${lote.val()}'  name=lote[] >${lote.val()}</td>
            <td ><input type="hidden" value ='${producto.val()}'  name=producto[] >${producto.val()}</td>
            <td ><input type="hidden" value ='${observaciones.val()}'  name=observaciones[] >${observaciones.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                hora.val('');
                no_1.val('');
                no_2.val('');
                no_3.val('');
                no_4.val('');
                no_5.val('');
                lote.val('');
                producto.val('');
                observaciones.val('');
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
            document.getElementById('producto').value = "";
            document.getElementById('proveedor').value = "";
            document.getElementById('id_proveedor').value = "";
            document.getElementById('producto').readOnly = false;
            document.getElementById('buscar').disabled = false;
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
            const POSICION_CODIGO = 1;
            const POSICION_FECHA = 2;
            const POSICION_LOTE = 3;

            var codigoBarras = input.value;
            var removerParentesis = codigoBarras.replace(/\([0-9]*\)/g, '-');
            var codigoSplited = removerParentesis.split('-');

            var codigo = codigoSplited[POSICION_CODIGO];
            var fecha = codigoSplited[POSICION_FECHA];
            var lote = codigoSplited[POSICION_LOTE];

            if (event.keyCode == 13) {
                document.getElementById('lote').value = lote;
                document.getElementById('producto').value = codigo;
                document.getElementById('no_1').focus();
            }
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
    </script>
@endsection
