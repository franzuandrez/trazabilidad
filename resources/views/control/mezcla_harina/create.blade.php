@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12   col-sm-push-3   col-md-12   col-md-push-3  col-xs-12">
        <h3>CONTROL MEZCLA DE HARINA Y SOLUCION CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Crear',
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

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <label for="turno">NO ORDEN DE PRODUCCION</label>
        <div class="input-group">
            <input type="text"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==13)iniciar_mezcla_harina()"
                   name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   class="form-control">
            <div class="input-group-btn">
                <button
                    onclick="iniciar_mezcla_harina()"
                    onkeydown="iniciar_mezcla_harina()"
                    type="button" class="btn btn-default">
                    <i class="fa fa-search"
                       aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>




    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">PRODUCTO</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    onchange="cargar_lotes(this.value)"
                    id="id_producto" name="id_producto">
                <option value="" selected>SELECCIONE UN PRODUCTO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <select class="form-control selectpicker valor"
                    disabled
                    required
                    id="lote" name="lote">
                <option value="" selected>SELECCIONE LOTE</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="hora_carga">HORA CARGA</label>
        <div class="input-group date1" id='datetimepicker3'>
            <input
                disabled
                required
                id="hora_carga" type="text" name="descripcion" class="form-control">
            <span class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </span>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="hora_descarga">HORA DESCARGA</label>
            <input id="hora_descarga" type="text" name="hora_descarga"
                   disabled
                   required
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12  col-xs-12">
        <div class="form-group">
            <label for="solucion">LBS DE SOLUCIÓN (158.4 A 168.5)</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="_solucion_inicial">VALOR</label>
            <input id="solucion_inicial" type="text" name="solucion_inicial"
                   disabled
                   required
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6  col-xs-12">
        <div class="form-group">
            <label for="observacion">OBSERVACIONES</label>
            <input id="solucion_observacion"
                   disabled
                   type="text" name="solucion_observacion"
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
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="_solucion_inicial">VALOR</label>
            <input id="ph_inicial" type="text" name="ph_inicial"
                   disabled
                   required
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-8">
        <div class="form-group">
            <label for="observacion">OBSERVACIONES</label>
            <input id="ph_observacion" type="text" name="ph_observacion"
                   disabled
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-3  col-xs-4">
        <br>
        <div class="form-group">
            <button class="btn btn-default block"
                    onclick="agregar_a_table()"
                    style="margin-top: 5px;" type="button">
                <span class=" fa fa-plus"></span></button>
            <button class="btn btn-default block" style="margin-top: 5px;"
                    onclick="limpiar()"
                    type="button">
                <span class=" fa fa-trash"></span></button>
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff;">
            <tr>
                <th>OPCION</th>
                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>HORA CARGA</th>
                <th>HORA DESCARGA</th>
                <th>SOLUCION INICAL</th>
                <th>OBSERVACIONES</th>
                <th>PH INICIAL</th>
                <th>OBSERVACIONES</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observacion_correctiva">OBSERVACIONES Y/O ACCION CORRECTIVA</label>
            <input type="text" name="observacion" id="observacion" value="{{old('observacion')}}"
                   class="form-control">
        </div>
    </div>




    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
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
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>
    <script>
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>

        var gl_detalle_insumos = null;

        function guardar() {

            document.getElementById('no_orden_produccion').disabled = false;
            $('form').submit();
        }

        function cargar_productos() {

            const select = document.getElementById('id_producto');
            $(select).empty();
            let option = '<option value="" selected>   SELECCIONE PRODUCTO </option>';
            gl_detalle_insumos.forEach(function (e) {
                option += `
                <option  value="${e.id_producto}" > ${e.producto.descripcion} </option>
                `
            });
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

        function cargar_lotes(id) {

            if (id != "") {
                const select = document.getElementById('lote');
                $(select).empty();
                let option = '<option value="" selected>SELECCIONE LOTE</option>';
                var id_producto = id;
                const filtered = gl_detalle_insumos.filter(function (e) {
                    return e.id_producto == id_producto;
                });

                const es_unico_lote = filtered.length == 1;

                if (es_unico_lote) {
                    option += `<option selected value="${filtered[0].lote}" >${filtered[0].lote}</option>`;
                } else {
                    filtered.forEach(function (e) {
                        option += `<option value="${e.lote}" >${e.lote}</option>`;
                    })
                }
                $(select).append(option);
                $(select).selectpicker('refresh');
            }


        }

        async function iniciar_mezcla_harina() {


            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            const url = "{{url('control/mezcla_harina/iniciar_harina')}}";
            const response = await iniciar(url, no_orden_produccion);

            if (response.status == 0) {
                alert(response.message);
            } else {
                const fields = detalle();
                gl_detalle_insumos = response.data.data.control_trazabilidad.detalle_insumos;

                habilitar_formulario(fields);
                cargar_productos();
                document.getElementById('no_orden_produccion').disabled = true;
            }


        }


        function removeFromTable(element) {
            //Removemos la fila
            let td = $(element).parent();
            td.parent().remove();
            let tdNext = td.next();
            let tdNextNext = tdNext.next();
        }

        function limpiar() {

            const fields = detalle();
            limpiar_formulario(fields)

        }

        function detalle() {


            const id_producto = document.getElementById('id_producto');
            const lote = document.getElementById('lote');
            const hora_carga = document.getElementById('hora_carga');
            const hora_descarga = document.getElementById('hora_descarga');
            const solucion_inicial = document.getElementById('solucion_inicial');
            const solucion_observacion = document.getElementById('solucion_observacion');
            const ph_inicial = document.getElementById('ph_inicial');
            const ph_observacion = document.getElementById('ph_observacion');


            const fields = [
                ["id_producto", id_producto],
                ["lote", lote],
                ["hora_carga", hora_carga],
                ["hora_descarga", hora_descarga],
                ["solucion_inicial", solucion_inicial],
                ["solucion_observacion", solucion_observacion],
                ["ph_inicial", ph_inicial],
                ["ph_observacion", ph_observacion],
            ];

            return fields;


        }


        async function agregar_a_table() {


            const no_orden_produccion = get_no_orden_produccion();
            const no_orden_disabled = document.getElementById('no_orden_produccion').disabled;
            const no_orden_valida = no_orden_disabled && no_orden_produccion != "";
            const fields = detalle();

            if (existe_campo_vacio(fields)) {
                alert("Campos incompletos");
                return;
            }
            if (no_orden_valida) {

                const request = getRequest(fields);
                const url = "{{url('control/mezcla_harina/insertar_detalle')}}";
                const url_borrar = "'{{url('control/mezcla_harina/borrar_detalle')}}'";
                const response = await insertar_detalle(request, no_orden_produccion, url);
                if (response.status == 1) {
                    add_to_table(fields, response.id, 'detalles', url_borrar);
                    limpiar()
                } else {
                    alert(response.message);
                }
            } else {
                alert("Orden de produccion no valida");
            }


        }


    </script>
@endsection

