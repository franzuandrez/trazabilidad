@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-tasks',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Laminado y Precocción de Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'produccion/laminado/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACION</label>
            <input id="presentacion" type="text"
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
        <div class="">
            <div class="tab-content">
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="velocidad_laminado">VELOCIDAD DE LAMINADO (RPM)</label>
                        <input id="velocidad_laminado" type="text" name="velocidad_laminado"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="espesor_lamina">ESPESOR DE LÁMINA 0.98 A 1.03 MM</label>
                        <input id="espesor_lamina" type="text" name="espesor_lamina"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="presicion">PRESICIÓN REGULADOR DE VALOR (0.2 A 0.3 MPA)</label>
                        <input id="presicion" type="text" name="presicion"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="indice_precoccion">INDICE PRECOCCIÓN (CUALITATIVO)</label>
                        <input id="indice_precoccion" type="text" name="indice_precoccion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="temperatura_inicio">TEMPERATURA DE PRECOCCIÓN MAS DE 90 C INICIO</label>
                        <input id="temperatura_inicio" type="text" name="temperatura_inicio"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="temperatura_salida">TEMPERATURA DE PRECOCCIÓN MAS DE 90 C SALIDA</label>
                        <input id="temperatura_salida" type="text" name="temperatura_salida"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tiempo_precoccion">TIEMPO DE PRECOCCIÓN 2:00 A 2:55 MIN. (CADA 30 MIN)</label>
                        <input id="tiempo_precoccion" type="text" name="tiempo_precoccion"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="velocidad_cotres">VELOCIDAD (COTRES * MIN)</label>
                        <input id="velocidad_cotres" type="text" name="velocidad_cotres"

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

                    <table id="detalles" class=" table-striped table-bordered table-condensed table-hover">

                        <thead style="background-color: #01579B;  color: #fff;">
                        <th>OPCION</th>
                        <th>HORA (CADA 15 MIN)</th>
                        <th>VELOCIDAD DE LAMINADO (RPM)</th>
                        <th>ESPESOR DE LAMINA 0.98 A 1.03 MM</th>
                        <th>PRESIÓN REGULADOR DE VAPOR (0.2 A 0.3 MPA)</th>
                        <th>INDICE PRECOCCIÓN (CUALITATIVO)</th>
                        <th>TEMPERATURA DE INICIO</th>
                        <th>TEMPERATURA DE SALIDA</th>
                        <th>TIEMPO DE PRECOCCIÓN 2:00 A 2:55 MIN</th>
                        <th>VELOCIDAD (COTRES * MIN)</th>
                        <th>OBSERVACIONES</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="acciones">ACCIONES/CORRECTIVAS</label>
                        <input type="text" name="acciones" value="{{old('acciones')}}"
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
            <a href="{{url('produccion/mezcladora')}}">
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
            if ($("#velocidad_laminado").val() != "" && $("#espesor_lamina").val() != "" && $("#presicion").val() != "") {
                let today = new Date();
                let time = today.getHours()+":"+today.getMinutes()+":"+today.getSeconds();
                let velocidad_laminado = $("#velocidad_laminado");
                let espesor_lamina = $("#espesor_lamina");
                let presicion = $("#presicion");
                let indice_precoccion = $("#indice_precoccion");
                let temperatura_inicio = $("#temperatura_inicio");
                let temperatura_salida = $("#temperatura_salida");
                let tiempo_precoccion = $("#tiempo_precoccion");
                let velocidad = $("#velocidad_cotres");
                let observaciones = $("#observaciones");

                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${time}' name=time[]>${time}</td>
            <td><input type="hidden" value='${velocidad_laminado.val()}' name=velocidad_laminado[]>${velocidad_laminado.val()}</td>
            <td><input type="hidden" value='${espesor_lamina.val()}' name=espesor_lamina[]>${espesor_lamina.val()}</td>
            <td><input type="hidden" value='${presicion.val()}' name=presicion[]>${presicion.val()}</td>
            <td><input type="hidden" value='${indice_precoccion.val()}' name=indice_precoccion[]>${indice_precoccion.val()}</td>
            <td><input type="hidden" value='${temperatura_inicio.val()}' name=temperatura_inicio[]>${temperatura_inicio.val()}</td>
            <td><input type="hidden" value='${temperatura_salida.val()}' name=temperatura_salida[]>${temperatura_salida.val()}</td>
            <td><input type="hidden" value='${tiempo_precoccion.val()}' name=tiempo_precoccion[]>${tiempo_precoccion.val()}</td>
            <td><input type="hidden" value='${velocidad.val()}' name=velocidad[]>${velocidad.val()}</td>
            <td ><input type="hidden" value ='${observaciones.val()}'  name=observaciones[] >${observaciones.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                velocidad_laminado.val('');
                espesor_lamina.val('');
                presicion.val('');
                indice_precoccion.val('');
                temperatura_inicio.val('');
                temperatura_salida.val('');
                tiempo_precoccion.val('');
                velocidad.val('');
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
