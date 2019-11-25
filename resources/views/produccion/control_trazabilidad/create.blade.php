@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-hand-rock-o  ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Requisiciones
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="codigo_producto">CODIGO PRODUCTO</label>
            <input type="text"
                   name="codigo_producto"
                   id="codigo_producto"
                   onkeydown="if(event.keyCode==13)buscar_producto()"
                   class="form-control">
        </div>
    </div>
    <input type="hidden" name="id_producto" id="id_producto">
    <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   id="best_by"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="no_orden_produccion">NO. ORDEN PRODUCION</label>
            <input type="text"
                   name="no_orden_produccion"
                   readonly
                   id="no_orden_produccion"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote">LOTE</label>
            <input type="text"
                   name="lote"
                   id="lote"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    INSUMOS
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    OPERARIOS INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="insumos">


            </div>
            <div class="tab-pane " id="involucrados">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="actividades">ACTIVIDADES</label>
                        <select name="actividades"
                                onchange="next('colaborador')"
                                id="actividades" class="form-control selectpicker">
                            <option value="">SELECCIONE ACTIVIDAD</option>
                            @foreach( $actividades  as $actividad)
                                <option value="{{$actividad->id_actividad}}">{{$actividad->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="colaborador"> COLABORADOR</label>
                    <div class="input-group">
                        <input type="text"
                               name="colaborador"
                               id="colaborador"
                               onkeydown="if(event.keyCode==13)buscar_colaborador()"
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                onclick="buscar_colaborador()"
                                onkeydown="buscar_colaborador()"
                                type="button" class="btn btn-default">
                                <i class="fa fa-search"
                                   aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    id="btn_agregar"
                                    onclick="agregar_asociacion()"
                                    onkeydown="agregar_asociacion()"
                                    class="btn btn-default">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                            <button type="button"
                                    id="btn_limpiar"
                                    onclick="limpiar()"
                                    onkeydown="limpiar()"
                                    class="btn btn-default">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="id_colaborador">
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-bordered table-responsive">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>

                            </th>
                            <th>
                                ACTIVIDAD
                            </th>
                            <th>
                                COLABORADORES
                            </th>
                        </tr>
                        </thead>
                        <tbody id="asociaciones">

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
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

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        function buscar_producto() {

            let codigo_interno = document.getElementById('codigo_producto').value;

            $.ajax({
                url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto')}}" + "?codigo_interno=" + codigo_interno,
                type: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.producto != null) {
                        document.getElementById('id_producto').value = response.producto.id_producto;
                        document.getElementById('producto').value = response.producto.descripcion;
                        document.getElementById('best_by').value = response.fecha_vencimiento;
                        document.getElementById('lote').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('no_orden_produccion').readOnly = false;
                        document.getElementById('turno').readOnly = false;
                        document.getElementById('cantidad_programada').readOnly = false;
                        document.getElementById('no_orden_produccion').focus();

                    } else {
                        alert('Producto no encontrado');
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            })
        }

        function limpiar() {

            document.getElementById('colaborador').value = "";
            document.getElementById('id_colaborador').value = "";
            document.getElementById('colaborador').readOnly = false;
            next('colaborador')
        }

        function agregar_asociacion() {
            let actividad_seleccionada = $('#actividades option:selected');
            let id_actividad = actividad_seleccionada.val();
            let descripcion_actividad = actividad_seleccionada.text();
            let id_colaborador = $('#id_colaborador').val();
            let nombre_colaborador = $('#colaborador').val();


            let estaActividadAgregada = document.getElementById('actividad-' + id_actividad) != null;
            if (id_actividad == "") {
                alert('Debe seleccionar una actividad');
                return;
            }
            if (id_colaborador == "") {
                alert("Debe buscar un colaborador");
                return;
            }

            if (estaActividadAgregada) {
                let estaColaboradorAgregado = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador) != null;

                if (estaColaboradorAgregado) {
                    alert('El colaborador ya pertence a este actividad');
                } else {
                    agregarColaborador(id_actividad, id_colaborador, nombre_colaborador);
                }

            } else {
                agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador)
            }
            document.getElementById('colaborador').readOnly = false;
            limpiarElement('colaborador');
            next('colaborador');

        }

        function limpiarElement(id_element) {

            document.getElementById(id_element).value = "";
        }

        function agregarColaborador(id_actividad, id_colaborador, nombre_colaborador) {
            let row = `
                        <tr id="act-${id_actividad}-col-${id_colaborador}">
                                            <td><input type="hidden" name="id_actividad[]" value="${id_actividad}">
                                                    <button
                                                     onclick="eliminarColaborador('${id_actividad}','${id_colaborador}')"
                                                     type="button" class="btn btn-warning">x</button>
                                            </td>
                                            <td><input type="hidden" name="id_colaborador[]" value="${id_colaborador}">  ${nombre_colaborador}</td>
                        </tr>
                      `;
            $('#asociacion-' + id_actividad).append(row);
        }

        function agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador) {
            let row = `
                <tr id="actividad-${id_actividad}">
                        <td>
                               <button onclick="eliminarActividad('${id_actividad}')" type="button" class="btn btn-warning">x</button>
                        </td>
                        <td>
                            ${descripcion_actividad}
                        </td>
                        <td>
                         <table class="table table-bordered table-responsive " >
                            <thead>
                            </thead>
                            <tbody id="asociacion-${id_actividad}" >

                            </tbody>
                         </table>
                        </td>
                </tr>
            `;
            $('#asociaciones').append(row);
            agregarColaborador(id_actividad, id_colaborador, nombre_colaborador)
        }

        function buscar_colaborador() {
            let colaborador = document.getElementById('colaborador').value;

            $.ajax({
                url: "{{url('registro/colaboradores/search')}}" + "?q=" + colaborador,
                type: "get",
                dataType: "json",
                success: function (response) {

                    let colaboradores = response.colaboradores;

                    if (colaboradores.length == 0) {
                        alert("Colaborador no encontrado");
                    } else if (colaboradores.length == 1) {
                        document.getElementById('id_colaborador').value = colaboradores[0].id_colaborador;
                        document.getElementById('colaborador').value = colaboradores[0].nombre + " " + colaboradores[0].apellido;
                        document.getElementById('colaborador').readOnly = true;
                        next('btn_agregar')
                    } else {

                    }

                },
                error: function (e) {
                    console.log(e);
                }
            })

        }

        function next(id) {

            document.getElementById(id).focus();
        }

        function eliminarActividad(id_actividad) {

            let cantidadColaboradores = $('#asociacion-' + id_actividad + " tr").length;
            if (cantidadColaboradores > 1) {
                if (confirm('¿Está seguro de remover la actividad?')) {
                    $('#actividad-' + id_actividad).remove();
                }
            } else {
                $('#actividad-' + id_actividad).remove();
            }
            next('colaborador')


        }

        function eliminarColaborador(id_actividad, id_colaborador) {

            let cantidadColaboradores = $('#asociacion-' + id_actividad + " tr").length;

            if (cantidadColaboradores == 1) {
                eliminarActividad(id_actividad);
            } else {
                $('#act-' + id_actividad + '-col-' + id_colaborador).remove();
            }
        }
    </script>
@endsection
