@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-cube',
    'submenu_icon'=>'fa fa-fire',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Frituras de Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'produccion/frituras/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input"
                   id="deposito_aceite"
                   value="1"
                   name="deposito_aceite">
            <label class="custom-control-label" for="deposito_aceite">DEPÓSITO DE ACEITE #1</label>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input"
                   id="tanque_aceite_nuevo"
                   value="1"
                   name="tanque_aceite_nuevo">
            <label class="custom-control-label" for="tanque_aceite_nuevo">TANQUE ACEITE NUEVO</label>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input"
                   id="deposito_aceite_2"
                   value="1"
                   name="deposito_aceite_2">
            <label class="custom-control-label" for="deposito_aceite_2">DEPÓSITO DE ACEITE #2</label>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"
                   class="custom-control-input"
                   id="tanque_aceite_usado"
                   value="1"
                   name="tanque_aceite_usado">
            <label class="custom-control-label" for="tanque_aceite_usado">TANQUE ACEITE USADO</label>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACIÓN</label>
            <select class="form-control selectpicker" data-live-search="true" id="presentacion" name="presentacion">
                <option value="" selected>SELECCIONE UNA PRESENTACION</option>
                <option value="1">JUMBO SAMYANG</option>
                <option value="2">PAQUETE</option>
                <option value="3">VASO 64 g</option>
                <option value="4">HAN RAN</option>
                <option value="5">SABAROSITA</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <select class="form-control selectpicker" data-live-search="true" id="turno" name="turno">
                <option value="" selected>SELECCIONE UN TURNO</option>
                <option value="1">TURNO 1</option>
                <option value="2">TURNO 2</option>
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <div class="tab-content">
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tipo">TIPO</label>
                        <select class="form-control selectpicker_tipo" data-live-search="true" id="tipo" name="tipo">
                            <option value="" selected>SELECCIONE UN TIPO</option>
                            <option value="1">VASO</option>
                            <option value="2">PAQUETE</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="inicial">INICIAL 130 A 135 °C</label>
                        <input id="inicial" type="text" name="inicial"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="final">FINAL 140 A 160 °C</label>
                        <input id="final" type="text" name="final"

                               class="form-control">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="general">GENERAL 150 A 161 °C</label>
                        <input id="general" type="text" name="general"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="set">SET 160 A 165 °C</label>
                        <input id="set" type="text" name="set"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tiempo">TIEMPO DE FRITURA 1:30 A 2:20 MIN</label>
                        <input id="tiempo" type="text" name="tiempo"

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


                <div class="table-responsive  col-lg-12 col-sm-12 col-md-12 col-xs-12">

                    <table id="detalles" class=" table-striped table-bordered table-condensed table-hover">

                        <thead style="background-color: #01579B;  color: #fff;">
                        <th>OPCION</th>
                        <th>HORA (CADA 15 MIN)</th>
                        <th>TIPO</th>
                        <th>INICIAL 130 A 135 °C</th>
                        <th>FINAL 140 A 160 °C</th>
                        <th>GENERAL 150 A 160 °C</th>
                        <th>SET 160 A 161 °C</th>
                        <th>TIEMPO DE FRITURA 1:30 A 2:20 MIN</th>
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


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/frituras')}}">
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
            if ($("#inicial").val() != "" && $("#final").val() != "" && $("#general").val() != "" && $("#set").val() != "" && $("#tiempo").val() != "" && $("#observaciones").val() != "") {
                let today = new Date();
                let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                let tipo = $("select.selectpicker_tipo").children("option:selected").text();
                let tipo_val = $("#tipo");
                let inicial = $("#inicial");
                let final = $("#final");
                let general = $("#general");
                let set = $("#set");
                let tiempo = $("#tiempo");
                let observaciones = $("#observaciones");


                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${time}' name=time[]>${time}</td>
            <td><input type="hidden" value='${tipo_val.val()}' name=tipo_val[]>${tipo}</td>
            <td><input type="hidden" value='${inicial.val()}' name=inicial[]>${inicial.val()}</td>
            <td><input type="hidden" value='${final.val()}' name=final[]>${final.val()}</td>
            <td><input type="hidden" value='${general.val()}' name=general[]>${general.val()}</td>
            <td><input type="hidden" value='${set.val()}' name=set[]>${set.val()}</td>
            <td><input type="hidden" value='${tiempo.val()}' name=tiempo[]>${tiempo.val()}</td>
            <td><input type="hidden" value ='${observaciones.val()}'  name=observaciones[] >${observaciones.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                inicial.val('');
                final.val('');
                general.val('');
                set.val('');
                tiempo.val('');
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
