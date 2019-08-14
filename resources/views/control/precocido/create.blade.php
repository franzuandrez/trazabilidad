@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-cutlery',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Pre-cocido de Pasta
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/precocido/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input id="turno" type="text"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
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
                    <label for="hora_inicio">HORA INICIO</label>
                    <div class="input-group">
                        <input id="hora_inicio" type="text" class="form-control timepicker" name="hora_inicio">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <label for="hora_salida">HORA SALIA</label>
                    <div class="input-group">
                        <input id="hora_salida" type="text" class="form-control timepicker" name="hora_salida">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tiempo_efectivo">TIEMPO EFECTIVO</label>
                        <input id="tiempo_efectivo" type="text" name="tiempo_efectivo"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="alcance_presion">ALCANCE PRESIÓN</label>
                        <input id="alcance_presion" type="text" name="alcance_presion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="temperatura">TEMPERATURA A (98-106 C)</label>
                        <input id="temperatura" type="text" name="temperatura"

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
                        <label for="responsable">RESPONSABLES</label>
                        <select name="id_responsable" class="form-control selectpicker" id="responsable">
                            <option value="">SELECCIONAR RESPONSABLE</option>
                            @foreach($responsables as $responsable)
                                <option value="{{$responsable->id}}">{{$responsable->nombre}}</option>
                            @endforeach
                        </select>
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
                        <th>HORA INICIO</th>
                        <th>HORA SALIDA</th>
                        <th>TIEMPO EFECTIVO</th>
                        <th>ALCANCE PRESICIÓN</th>
                        <th>TEMPERATURA</th>
                        <th>LOTE</th>
                        <th>PRODUCTO</th>
                        <th>RESPONSABLE EJECUCIÓN</th>
                        <th>OBSERVACIONES</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
            <a href="{{url('control/precocido')}}">
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
            if ($("#hora_inicio").val() != "" && $("#hora_salida").val() != "" && $("#tiempo_efectivo").val() != "" && $("#alcance_presion").val() != "" && $("#temperatura").val() != "" && $("#lote").val() != "" && $("#producto").val() != "" && $("#responsable").val() != "" && $("#observaciones").val() != "") {
                let hora_inicio = $("#hora_inicio");
                let hora_salida = $("#hora_salida");
                let tiempo_efectivo = $("#tiempo_efectivo");
                let alcance_presion = $("#alcance_presion");
                let temperatura = $("#temperatura");
                let nombreResponsable = $("select.selectpicker").children("option:selected").text();
                let lote = $("#lote");
                let producto = $("#producto");
                let responsable = $("#responsable");
                let observaciones = $("#observaciones");
                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${hora_inicio.val()}' name=hora_inicio[]>${hora_inicio.val()}</td>
            <td><input type="hidden" value='${hora_salida.val()}' name=hora_salida[]>${hora_salida.val()}</td>
            <td ><input type="hidden" value ='${tiempo_efectivo.val()}'  name=tiempo_efectivo[] >${tiempo_efectivo.val()}</td>
            <td ><input type="hidden" value ='${alcance_presion.val()}'  name=alcance_presion[] >${alcance_presion.val()}</td>
            <td ><input type="hidden" value ='${temperatura.val()}'  name=temperatura[] >${temperatura.val()}</td>
            <td ><input type="hidden" value ='${lote.val()}'  name=lote[] >${lote.val()}</td>
            <td ><input type="hidden" value ='${producto.val()}'  name=producto[] >${producto.val()}</td>
            <td ><input type="hidden" value ='${responsable.val()}'  name=responsable[] >${nombreResponsable}</td>
            <td ><input type="hidden" value ='${observaciones.val()}'  name=observaciones[] >${observaciones.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                hora_inicio.val('');
                hora_salida.val('');
                tiempo_efectivo.val('');
                alcance_presion.val('');
                temperatura.val('');
                lote.val('');
                producto.val('');
                responsable.val('');
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
