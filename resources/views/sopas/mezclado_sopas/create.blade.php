@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-dot-circle-o',
    'submenu_icon'=>'fa fa-balance-scale',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control Sopas
        @endslot
        @slot('submenu')
            Mezclado Sopas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/mezclado_sopas/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="NO_ORDEN_PRODUCCION" value="{{old('NO_ORDEN_PRODUCCION')}}"
                   class="form-control">

        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACIÓN</label>
            <select class="form-control selectpicker" data-live-search="true" id="presentacion" name="presentacion">
                <option value="" selected>SELECCIONE UN CODIGO</option>
                <option value="1" >JUMBO SAMYANG</option>
                <option value="2" >PAQUETE</option>
                <option value="3" >VASO 64 g</option>
                <option value="4" >HAN RAN</option>
                <option value="5" >SABAROSITA</option>
            </select>
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
                        <label for="no_bach">NO. BACH</label>
                        <input id="no_bach" type="text" name="no_bach"

                               class="form-control">
                    </div>
                </div>
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
                    <label for="hora_finalizo">HORA FINALIZO</label>
                    <div class="input-group">
                        <input id="hora_finalizo" type="text" class="form-control timepicker" name="hora_finalizo">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tiempo_alta">TIEMPO DE VELOCIDAD ALTA</label>
                        <input id="tiempo_alta" type="text" name="tiempo_alta"

                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="tiempo_baja">TIEMPO DE VELOCIDAD BAJA</label>
                        <input id="tiempo_baja" type="text" name="tiempo_baja"

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
                        <th>NO. BACH</th>
                        <th>HORA INICIO</th>
                        <th>HORA FINALIZO</th>
                        <th>TIEMPO VELOCIDAD ALTA</th>
                        <th>TIEMPO VELOCIDAD BAJA</th>
                        <th>OBSERVACIONES</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                        <label for="observaciones_generales">OBSERVACIONES</label>
                        <input type="text" name="observaciones_generales" value="{{old('observaciones_generales')}}"
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
            <a href="{{url('sopas/mezclado_sopas')}}">
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
            if ($("#no_bach").val() != "" && $("#hora_inicio").val() != "" && $("#hora_finalizo").val() != "" && $("#tiempo_alta").val() != "" && $("#tiempo_baja").val() != "" && $("#observaciones").val() != "") {
                let no_bach = $("#no_bach");
                let hora_inicio = $("#hora_inicio");
                let hora_finalizo = $("#hora_finalizo");
                let tiempo_alta = $("#tiempo_alta");
                let tiempo_baja = $("#tiempo_baja");
                let observaciones = $("#observaciones");
                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${no_bach.val()}' name=no_bach[]>${no_bach.val()}</td>
            <td><input type="hidden" value='${hora_inicio.val()}' name=hora_inicio[]>${hora_inicio.val()}</td>
            <td><input type="hidden" value='${hora_finalizo.val()}' name=hora_finalizo[]>${hora_finalizo.val()}</td>
            <td ><input type="hidden" value ='${tiempo_alta.val()}'  name=tiempo_alta[] >${tiempo_alta.val()}</td>
            <td ><input type="hidden" value ='${tiempo_baja.val()}'  name=tiempo_baja[] >${tiempo_baja.val()}</td>
            <td ><input type="hidden" value ='${observaciones.val()}'  name=observaciones[] >${observaciones.val()}</td>
            </tr>`;

                $("#detalles").append(row);
                no_bach.val('');
                hora_inicio.val('');
                hora_finalizo.val('');
                tiempo_alta.val('');
                tiempo_baja.val('');
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
