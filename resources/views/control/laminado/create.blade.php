@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'fa fa-th',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Laminado
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/laminado/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="NO_ORDEN_PRODUCCION" id = "NO_ORDEN_PRODUCCION" value="{{old('NO_ORDEN_PRODUCCION')}}"
                   class="form-control">

        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">RESPONSABLE</label>
            <select name="id_responsable" class="form-control selectpicker" id="id_responsable">
                <option value="">SELECCIONAR RESPONSABLE</option>
                @foreach($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input id="turno" name="turno" type="text"
                   class="form-control">
        </div>
    </div>



    {{-- FUERA DEL PANEL--}}

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
        <label for="hora">HORA</label>
        <div class="input-group">
            <input id="hora" type="text" class="form-control timepicker" name="hora" value="{{old('hora')}}" >
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="descripcion">LOTE DE PRODUCTO</label>
            <input id="LOTE" type="text" name="LOTE" value="{{old('LOTE')}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="temperatura">TEMPERATURA REPOSO 34-36 °C</label>

        </div>
    </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="temperatura">DATO INICIAL</label>
                <input id="temperatura_inicial" type="text" name="temperatura_inicial"
                       onkeydown="if(event.keyCode==13)validacion(this,34,36,document.getElementById('temperatura_final'),document.getElementById('temperatura_observaciones'))"
                       class="form-control">

            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <div class="form-group">
                <label for="temperatura">DATO FINAL</label>
                <input id="temperatura_final" type="text" name="temperatura_final" readonly value="{{old('temperatura_final')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-3col-md-3 col-xs-12">
            <div class="form-group">
                <label for="temperatura">OBSERVACIONES</label>
                <input id="temperatura_observaciones" type="text" name="temperatura_observaciones" value="{{old('temperatura_observaciones')}}"
                       class="form-control">
            </div>
        </div>




    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="temperatura">ESPESOR 1.25 A 1.30 (milimetros)</label>

        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura">DATO INICIAL</label>
            <input id="espesor_inicial" type="text" name="espesor_inicial"
                   onkeydown="if(event.keyCode==13)validacion(this,1.25,1.30,document.getElementById('espesor_final'),document.getElementById('espesor_observaciones'))"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura">DATO FINAL</label>
            <input id="espesor_final" type="text" name="espesor_final" readonly value="{{old('espesor_final')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura">OBSERVACIONES</label>
            <input id="espesor_observaciones" type="text" name="espesor_observaciones" value="{{old('espesor_observaciones')}}"
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


    {{--   FUERA PANEL FIN---}}


    {{--- TABLA---}}
    <div class="tab-pane" id="tab_3">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>OPCION</th>
                <th>HORA</th>
                <th>LOTE</th>
                <th>TEMPERATURA INICIAL</th>
                <th>TEMPERATURA FINAL</th>
                <th>ESPESOR INICIAL</th>
                <th>ESPESOR FINAL</th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
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
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/laminado')}}">
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
            $("#btnLimpiar").click(function () {
                limpiar();
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
            if ($("#hora").val() != "" && $("#temperatura_inicial").val() != "" && $("#espesor_inicial").val() != "" && $("#LOTE").val() != "" ) {
                let hora = $("#hora");
                let temperatura_inicial = $("#temperatura_inicial");
                let temperatura_final = $("#temperatura_final");
                let temperatura_observaciones = $("#temperatura_observaciones");
                let espesor_inicial = $("#espesor_inicial");
                let espesor_final = $("#espesor_final");
                let espesor_observaciones = $("#espesor_observaciones");
                let LOTE = $("#LOTE");
                let row =

                    `<tr>
                    <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button>
                    <input type="hidden" value ='${espesor_observaciones.val()}'  name=espesor_observaciones[] >
                    <input type="hidden" value ='${temperatura_observaciones.val()}'  name=temperatura_observaciones[] >
                    </td>
                    <td><input type="hidden" value='${hora.val()}' name=hora[]>${hora.val()}</td>
                    <td ><input type="hidden" value ='${LOTE.val()}'  name=LOTE[] >${LOTE.val()}</td>
                    <td><input type="hidden" value='${temperatura_inicial.val()}' name=temperatura_inicial[]>${temperatura_inicial.val()}</td>
                    <td ><input type="hidden" value ='${temperatura_final.val()}'  name=temperatura_final[] >${temperatura_final.val()}</td>
                    <td ><input type="hidden" value ='${espesor_inicial.val()}'  name=espesor_inicial[] >${espesor_inicial.val()}</td>
                    <td ><input type="hidden" value ='${espesor_final.val()}'  name=espesor_final[] >${espesor_final.val()}</td>
                    </tr>`;

                $("#detalles").append(row);
                limpiar();
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
            document.getElementById('hora').value = "";
            document.getElementById('temperatura_inicial').value = "";
            document.getElementById('temperatura_final').value = "";
            document.getElementById('temperatura_observaciones').value = "";
            document.getElementById('espesor_inicial').value = "";
            document.getElementById('espesor_final').value = "";
            document.getElementById('espesor_observaciones').value = "";
            document.getElementById('LOTE').value = "";
            $('#temperatura_final').attr('readonly', true);
            $('#espesor_final').attr('readonly', true);
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
