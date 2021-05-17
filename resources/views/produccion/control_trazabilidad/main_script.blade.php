<script src="{{asset('js/moment.min.js')}}">
</script>
<script src="{{asset('js/moment-with-locales.js')}}">
</script>
<script src="{{asset('js-brc/tools/lectura_codigo.js')}}">
</script>
<script>
    var formato = 'D/M/Y';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        setDate: new Date()
    });
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }

    });


    function asociar() {
        const total_asociaciones = $('#asociaciones').children().length;
        if (total_asociaciones === 0) {
            alert("Debe agregar a los operarios involucrados");
            return;
        }
        $('form').submit();
    }

    function guardar() {


        const total_insumos = $('#tbody_insumos').children().length;

        if (total_insumos == 0) {
            alert("Orden de produccion sin insumos");
            return;
        }

        let lote = document.getElementById('lote_produccion').value;

        if (lote === "") {
            alert("Lote en blanco");
            document.getElementById('lote_produccion').focus();
            return;
        }
        let cantidad_programada = document.getElementById('cantidad_programada').value;

        if (cantidad_programada === "") {
            alert("Cantidad programada en blanco");
            document.getElementById('cantidad_programada').focus();
            return;
        }
        let turno = document.getElementById('turno').value;

        if (turno === "") {
            alert("turno  en blanco");
            document.getElementById('turno').focus();
            return;
        }

        $('form').submit();

    }

    function limpiar_formulario() {
        limpiar_orden_produccion();
        limpiar_producto();

    }

    function limpiar_producto() {
        document.getElementById('codigo_producto').value = "";
        document.getElementById('codigo_producto').focus();
        document.getElementById('codigo_producto').readOnly = false;
        document.getElementById('producto').value = "";
        document.getElementById('id_producto').value = "";
        document.getElementById('unidad_medida').value = "";
        document.getElementById('best_by').value = "";
        document.getElementById('no_orden_produccion').readOnly = true;
    }

    function limpiar_orden_produccion() {
        document.getElementById('no_orden_produccion').value = "";
        document.getElementById('ordenes').value = "";
        document.getElementById('no_orden_produccion').readOnly = false;
        document.getElementById('no_orden_produccion').focus();
        document.getElementById('lote_produccion').value = "";
        document.getElementById('lote_produccion').readOnly = true;
        document.getElementById('turno').value = "";
        document.getElementById('turno').readOnly = true;
        document.getElementById('cantidad_programada').value = "";
        document.getElementById('cantidad_programada').readOnly = true;
        $("#tbody_insumos").empty();
        $("#asociaciones").empty();

    }

    function agregar_orden_produccion() {

        const old_value = document.getElementById('ordenes').value;
        const new_value = document.getElementById('no_orden_produccion').value;

        if (old_value === "") {
            document.getElementById('ordenes').value = new_value;
        } else {
            document.getElementById('ordenes').value = old_value + ',' + new_value;
        }

    }

    function existe_orden_produccion(orden_produccion) {

        let ordenes = document.getElementById('ordenes').value.split(',');
        const existe_orden = ordenes.find(e => e === orden_produccion);

        return typeof existe_orden !== "undefined";

    }

    function buscar_orden_produccion() {

        let orden_produccion = document.getElementById('no_orden_produccion').value;
        let id_producto = document.getElementById('id_producto').value;
        let id_control = document.getElementById('id_control').value;
        if (id_producto == "") {
            alert("Producto no válido");
            return;
        }
        $('.loading').show();
        $.ajax({
            url: '{{url('produccion/trazabilidad_chao_mein/buscar_orden_produccion')}}' + '?q=' + orden_produccion + "&id_producto=" + id_producto + "&id_control=" + id_control,
            type: 'get',
            dataType: "json",
            success: function (response) {

                if (response.status == 1) {
                    let orden_produccion = response.data[0];
                    let control_trazabilidad = response.data[1];

                    if (orden_produccion == null) {
                        alert("Orden de produccion no encontrada");
                    } else if (orden_produccion.estado != 'D') {

                        alert("Orden de produccion en proceso ");
                    } else {
                        if (existe_orden_produccion(orden_produccion.no_orden_produccion)) {
                            alert("Orden de produccion ya agregada");
                        } else {
                            agregar_orden_produccion();
                            set_id_orden(control_trazabilidad.id_control);
                            document.getElementById('id_requisicion').value = orden_produccion.id;
                            document.getElementById('lote_produccion').readOnly = false;
                            document.getElementById('lote_produccion').focus();
                            document.getElementById('turno').readOnly = false;
                            document.getElementById('cantidad_programada').readOnly = false;
                            document.getElementById('no_orden_produccion').value = "";
                        }

                    }
                } else {
                    alert(response.message);
                }
                $('.loading').hide();

            },
            error: function (e) {
                console.log(e);
                alert(e);
                $('.loading').hide();
            }
        })

    }

    function mostrar_icono_observaciones(element) {

        element.children[1].classList.add('mostrar');
        element.children[1].classList.remove('ocultar');

    }

    function remover_icono_observaciones(element) {
        element.children[1].classList.add('ocultar');
        element.children[1].classList.remove('mostrar');
    }

    function cargar_insumos(insumos) {

        let row = '';
        insumos.forEach(function (insumo) {

            row += `
                    <tr>
                        <td  >
                            <input type="hidden" name='id_producto_mp[]' value="${insumo.producto.id_producto}">
                            ${insumo.producto.codigo_interno}
                        </td>

                        <td>
                             <input type="hidden" name="color[]" value="0">
                             <input type="checkbox" onclick="asignar(this)">
                        </td>
                        <td>
                                <input type="hidden" name=olor[] value="0">
                                 <input type="checkbox" onclick="asignar(this)">

                            </td>
                        <td><input type="hidden" name=impresion[] value="0">
                                <input type="checkbox" onclick="asignar(this)">
                            </td>
                        <td><input type="hidden" name=ausencia_me[] value=0>
                        <input type="checkbox" onclick="asignar(this)"></td>


                        <td><input type="hidden" name=lote[] value="${insumo.lote}" >${insumo.lote}</td>
                        <td><input type="hidden" name=cantidad[] value="${insumo.cantidad}">${insumo.cantidad}</td>
                        <td><input type="hidden" name=fecha_vencimiento[] value="${(insumo.fecha_vencimiento)}">  ${moment(insumo.fecha_vencimiento).format('DD/MM/Y')} </td>
                    </tr>
                `;
        });


        $('#tbody_insumos').append(row);
    }

    function asignar(e) {

        e.previousElementSibling.value = 1 - e.previousElementSibling.value;

    }

    function buscar_producto_mp_pp() {


        const no_orden_produccion_element = document.getElementById('ordenes');
        const no_orden_produccion_valida = no_orden_produccion_element.value !== "" && (no_orden_produccion_element.disabled || no_orden_produccion_element.readOnly);

        if (!no_orden_produccion_valida) {
            alert(" No. orden no valido ");
            return;
        }

        const codigo_barras_completo = document.getElementById('codigo_producto_mp').value;
        const codigo_barras_descompuesto = descomponerString(codigo_barras_completo);
        const codigo_barras = codigo_barras_descompuesto[1];
        const lote = codigo_barras_descompuesto[3];
        const id_control = document.getElementById('id_control').value;

        const query = "?codigo_barras=" + codigo_barras + "&no_orden_produccion=" + no_orden_produccion_element.value + "&lote=" + lote + '&id_control=' + id_control;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/verificar_proximo_lote')}}" + query,
            type: "GET",
            success: function (response) {

                if (response.status === 1) {
                    if (response.data.siguiente_lote.producto.tipo_producto == $('#tipo_producto option:selected').val()) {

                        document.getElementById('descripcion_producto_mp').value = response.data.siguiente_lote.producto.descripcion;
                        document.getElementById('lote_producto_mp').value = lote;
                        document.getElementById('cantidad_producto_mp').readOnly = false;
                        document.getElementById('cantidad_producto_mp').focus();
                    } else {
                        alert("Producto incorrecto");
                    }
                } else {
                    alert(response.message);
                }


                $('.loading').hide();
            }, error: function (e) {
                alert("Algo salió mal , error: " + e.responseJSON.message);
                $('.loading').hide();
            }

        })
        ;
    }

    var cantidad_producto_pp = 0;

    function buscar_producto_pp() {
        const no_orden_produccion_element = document.getElementById('ordenes');
        const no_orden_produccion_valida = no_orden_produccion_element.value !== "" && (no_orden_produccion_element.disabled || no_orden_produccion_element.readOnly);

        if (!no_orden_produccion_valida) {
            alert(" No. orden no valido ");
            return;
        }
        const codigo_barras = document.getElementById('codigo_producto_pp').value;
        const lote = document.getElementById('lote_producto_pp').value;
        const query = "?codigo=" + codigo_barras + "&lote=" + lote;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto_pp')}}" + query,
            type: "GET",
            success: function (response) {
                if (response.status == 1) {
                    document.getElementById('descripcion_producto_pp').value = response.data.producto.descripcion;
                    document.getElementById('cantidad_producto_pp').readOnly = false;
                    cantidad_producto_pp = response.data.control.cantidad_programada;
                } else {
                    alert("Lote no encontrado");
                }

                $('.loading').hide();
            }, error: function (e) {
                alert("Algo salió mal , error: " + e.responseJSON.message);
                $('.loading').hide();
            }
        })
        ;
    }

    function verificar_existencia_lote_pp() {

        let cantidad_pp = parseFloat(document.getElementById('cantidad_producto_pp').value);
        if (cantidad_pp > parseFloat(cantidad_producto_pp)) {
            alert("La cantidad excede la existencia");
            return;
        }
        const no_orden_produccion_element = document.getElementById('ordenes');
        const codigo_barras = document.getElementById('codigo_producto_pp').value;
        const lote = document.getElementById('lote_producto_pp').value;
        const cantidad = document.getElementById('cantidad_producto_pp').value;
        const id_producto = document.getElementById('id_producto').value;
        const fecha_vencimiento = document.getElementById('best_by').value;
        const turno = document.getElementById('turno').value;
        const lote_pt = document.getElementById('lote_produccion').value;
        const cantidad_programada = document.getElementById('cantidad_programada').value;
        const id_control = document.getElementById('id_control').value;

        let query = "?codigo=" + codigo_barras + "&no_orden_produccion=";
        query += no_orden_produccion_element.value + "&lote=" + lote + "&cantidad=" + cantidad;
        query += "&id_producto=" + id_producto + "&turno=" + turno + "&best_by=" + fecha_vencimiento;
        query += "&cantidad_programada=" + cantidad_programada + "&lote_pt=" + lote_pt + '&id_control=' + id_control;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/verificar_existencia_lote_pp')}}" + query,
            type: "get",
            success: function (response) {
                console.log(response);
                if (response.status === 1) {
                    agregar_insumo_pp(response.data.id_detalle_insumo, response.data.fecha_vencimiento);
                    limpiar_insumo_pp();
                    set_id_orden(response.data.id_control);
                } else {
                    alert(response.message);
                }
                $('.loading').hide();
            }, error: function (e) {
                console.log(e);
                $('.loading').hide();
            }
        });
    }

    function verificar_existencia_lote() {

        const no_orden_produccion_element = document.getElementById('ordenes');
        const no_orden_produccion_valida = no_orden_produccion_element.value !== "" && (no_orden_produccion_element.disabled || no_orden_produccion_element.readOnly);

        if (!no_orden_produccion_valida) {
            alert(" No. orden no valido ");
            return;
        }

        const codigo_barras_completo = document.getElementById('codigo_producto_mp').value;
        const codigo_barras_descompuesto = descomponerString(codigo_barras_completo);
        const codigo_barras = codigo_barras_descompuesto[1];
        const lote = codigo_barras_descompuesto[3];
        const cantidad = document.getElementById('cantidad_producto_mp').value;
        const id_producto = document.getElementById('id_producto').value;
        const fecha_vencimiento = document.getElementById('best_by').value;
        const turno = document.getElementById('turno').value;
        const lote_pt = document.getElementById('lote_produccion').value;
        const cantidad_programada = document.getElementById('cantidad_programada').value;
        const id_control = document.getElementById('id_control').value;

        let query = "?codigo_barras=" + codigo_barras + "&no_orden_produccion=";
        query += no_orden_produccion_element.value + "&lote=" + lote + "&cantidad=" + cantidad;
        query += "&id_producto=" + id_producto + "&turno=" + turno + "&best_by=" + fecha_vencimiento;
        query += "&cantidad_programada=" + cantidad_programada + "&lote_pt=" + lote_pt + '&id_control=' + id_control;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/verificar_existencia_lote')}}" + query,
            type: "get",
            success: function (response) {

                if (response.status === 1) {
                    if (response.data.producto.tipo_producto == $('#tipo_producto option:selected').val()) {
                        agregar_insumo(response.data.id_detalle_insumo, response.data.fecha_vencimiento);
                        limpiar_insumo();
                        set_id_orden(response.data.id_control);
                    } else {
                        alert("Producto incorrecto");
                    }
                } else {
                    alert(response.message);
                }

                $('.loading').hide();
            }, error: function (e) {
                console.log(e);
                $('.loading').hide();
            }
        });


    }

    function set_id_orden(id) {
        document.getElementById('id_control').value = id;
    }

    function buscar_producto_terminado() {

        let codigo_interno = document.getElementById('codigo_producto').value;
        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/buscar_producto')}}" + "?codigo_interno=" + codigo_interno,
            type: "get",
            dataType: "json",
            success: function (response) {

                if (response.producto != null) {
                    document.getElementById('codigo_producto').readOnly = true;
                    document.getElementById('id_producto').value = response.producto.id_producto;
                    document.getElementById('producto').value = response.producto.descripcion;
                    document.getElementById('best_by').value = response.fecha_vencimiento;
                    document.getElementById('unidad_medida').value = response.producto.unidad_medida;
                    document.getElementById('no_orden_produccion').readOnly = false;
                    document.getElementById('no_orden_produccion').value = "";
                    document.getElementById('ordenes').value = "";
                    document.getElementById('no_orden_produccion').focus();

                } else {
                    alert('Producto no encontrado');
                }
                $('.loading').hide();
            },
            error: function (e) {
                alert("Producto no encontrado");
                console.log(e);
                $('.loading').hide();
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


        if (id_actividad == "") {
            alert('Debe seleccionar una actividad');
            return;
        }
        if (id_colaborador == "") {
            alert("Debe buscar un colaborador");
            return;
        }
        let estaActividadAgregada = document.getElementById('actividad-' + id_actividad) != null;
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

    function agregarColaboradores() {

        Array.prototype.slice.call(document.getElementsByName('resultado_colaborador'))
            .filter(e => e.checked)
            .map(e => e.parentElement.parentElement)
            .forEach(function (e) {
                let actividad_seleccionada = $('#actividades option:selected');
                let id_actividad = actividad_seleccionada.val();
                let descripcion_actividad = actividad_seleccionada.text();
                let id_colaborador = e.children[0].firstChild.value;
                let nombre_colaborador = e.children[2].innerText

                let estaActividadAgregada = document.getElementById('actividad-' + id_actividad) != null;

                if (estaActividadAgregada) {
                    let estaColaboradorAgregado = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador) != null;
                    if (!estaColaboradorAgregado) {
                        agregarColaborador(id_actividad, id_colaborador, nombre_colaborador);
                    }
                } else {
                    agregarActividad(id_actividad, descripcion_actividad, id_colaborador, nombre_colaborador)
                }
            })
        ;
        setTimeout(function () {
            limpiarElement('colaborador');
            next('colaborador');
        }, 100)

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
        let id_actividad = $('#actividades option:selected').val();


        const is_orden_produccion_valida = document.getElementById('ordenes').value != "" && document.getElementById('ordenes').readOnly == true;
        if (!is_orden_produccion_valida) {
            alert("Orden de produccion  invalida");
            return;
        }

        if (id_actividad == "") {
            alert("Seleccione Actividad");
            return;
        }
        $('.loading').show();
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
                    next('btn_agregar');

                } else {
                    document.getElementById('nombre-colaboradores').innerText = $('#actividades option:selected').text();
                    cargar_colaboradores(colaboradores);
                    mostrar_colaboradores();
                }
                $('.loading').hide();
            },
            error: function (e) {
                console.log(e);
                $('.loading').hide();
            }
        })

    }

    function seleccionar(id_colaborador, element) {

        if (element.tagName != "INPUT") {
            document.getElementById('colaborador_item-' + id_colaborador).checked = !document.getElementById('colaborador_item-' + id_colaborador).checked;
        }

        let totalSeleccionados = Array.prototype.slice.call(document.getElementsByName('resultado_colaborador')).filter(e => e.checked).length;
        document.getElementById('btn_aceptar').disabled = totalSeleccionados == 0;


    }

    function cargar_colaboradores(colaboradores) {

        $("#tbody-colaboradores").empty();
        let row = "";
        colaboradores.forEach(function (colaborador) {
            row += `<tr  onclick="seleccionar('${colaborador.id_colaborador}',event.target)">
                    <td><input  type='checkbox' name='resultado_colaborador' value='${colaborador.id_colaborador}' id="colaborador_item-${colaborador.id_colaborador}" ></td>
                    <td> ${colaborador.codigo_barras} </td>
                    <td> ${colaborador.nombre} ${colaborador.apellido} </td>
                </tr> `;
        });

        $('#tbody-colaboradores').append(row);
    }

    function mostrar_colaboradores() {
        setTimeout(function () {
            $('.loading').hide();
            $('#modal-colaboradores').modal();
        }, 1000);
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

    function agregar_insumo(id, fecha_vencimiento) {

        const descripcion = document.getElementById('descripcion_producto_mp').value;
        const lote = document.getElementById('lote_producto_mp').value;
        const cantidad = document.getElementById('cantidad_producto_mp').value;
        let fecha_ven = moment(fecha_vencimiento).format('DD/MM/Y');

        let row = `
                    <tr>
                        <td>     <input type="hidden" name="id_insumo[]" value="${id}">   ${descripcion}</td>

                        <td>              <input type="hidden" name="lote_pt[]" value="${lote}">
                                          ${lote}
                        </td>
                        <td>                <input type="hidden" name="cantidad[]" value="${cantidad}">
                                           ${cantidad}
                        </td>
                        <td>
                                           <input type="hidden" name="fecha_vencimiento[]" value="${fecha_ven}">
                                           ${fecha_ven}
                        </td>
                    </tr>
            `;

        $('#tbody_insumos').append(row);


    }

    function agregar_insumo_pp(id, fecha_vencimiento) {
        const descripcion = document.getElementById('descripcion_producto_pp').value;
        const lote = document.getElementById('lote_producto_pp').value;
        const cantidad = document.getElementById('cantidad_producto_pp').value;

        let fecha_ven = moment(fecha_vencimiento).format('DD/MM/Y');
        let row = `
                    <tr>
                        <td>     <input type="hidden" name="id_insumo[]" value="${id}">   ${descripcion}</td>


                        <td>              <input type="hidden" name="lote_pt[]" value="${lote}">
                                          ${lote}
                        </td>
                        <td>                <input type="hidden" name="cantidad[]" value="${cantidad}">
                                           ${cantidad}
                        </td>
                        <td>
                              <input type="hidden" name="fecha_ven[]" value="${fecha_ven}">
                                                                       ${fecha_ven}
                        </td>
                    </tr>
            `;

        $('#tbody_insumos').append(row);
    }

    function limpiar_insumo() {

        document.getElementById('codigo_producto_mp').value = "";
        document.getElementById('descripcion_producto_mp').value = "";
        document.getElementById('lote_producto_mp').value = "";
        document.getElementById('cantidad_producto_mp').value = "";
        document.getElementById('cantidad_producto_mp').readOnly = true;
        document.getElementById('codigo_producto_mp').focus();

    }

    function limpiar_insumo_pp() {
        document.getElementById('codigo_producto_pp').value = "";
        document.getElementById('descripcion_producto_pp').value = "";
        document.getElementById('lote_producto_pp').value = "";
        document.getElementById('cantidad_producto_pp').value = "";
        document.getElementById('cantidad_producto_pp').readOnly = true;
        document.getElementById('codigo_producto_pp').focus();
    }

    function seleccionar_tipo_producto() {

        const option_selected = $('#tipo_producto option:selected').val();
        if (option_selected == "MP" || option_selected == "ME") {
            document.getElementById('modulo_materia_prima').style.display = 'block';
            document.getElementById('modulo_proceso').style.display = 'none';
        } else {
            document.getElementById('modulo_materia_prima').style.display = 'none';
            document.getElementById('modulo_proceso').style.display = 'block';
        }
    }

    function finalizar_asistencia(id_actividad, id_colaborador) {

        const id_control = document.getElementById('id_control').value;

        $('.loading').show();
        $.ajax({
            url: "{{url('produccion/trazabilidad_chao_mein/finalizar_asistencia')}}",
            type: 'post',
            dataType: "json",
            data: {
                id_control: id_control,
                id_actividad: id_actividad,
                id_colaborador: id_colaborador
            },
            success: function (response) {

                if (response.status == 1) {
                    let row = document.getElementById('act-' + id_actividad + '-col-' + id_colaborador);
                    marcar_finalizado(row);
                    marcar_hora_finalizado(row, response.data);

                } else {
                    alert(response.message);
                }
                $('.loading').hide();
            },
            error: function (e) {
                alert(e);
                $('.loading').hide();
            },


        })

    }

    function marcar_finalizado(element) {

        $(element).find('.btn').remove();
        element.classList.add('success');
    }

    function marcar_hora_finalizado(element, hour) {
        $(element).find('td')[0].innerText = hour;

    }

    function registar_cantidad_utilizada(cantidad_limite, element) {


        return setInputFilter(element, function (value) {

            return parseFloat(value) <= parseFloat(cantidad_limite);
        });

    }


    function finalizar_control_trazabilidad() {

        let colaboradores_sin_finalizar = document.getElementsByClassName('colaborador_pendiente_finalizar').length;

        if (colaboradores_sin_finalizar > 0) {
            alert("Existen colaboradores pendientes de finalizar");
            return;
        }

        let cantidadesSinConfirmar = getCantidadesUtilizadasSinConfirmar();
        if (cantidadesSinConfirmar.length > 0) {
            alert("Cantidades pendientes de confirmar");
            getCantidadesUtilizadasSinConfirmar()[0].focus();
            return;
        }

        if (getCantidadesUtilizadasExedientes().length > 0) {
            alert("Cantidad excedente ");
            getCantidadesUtilizadasExedientes()[0].focus();
            return;
        }


        let cantidad_produccion = document.getElementById('cantidad_produccion').value;
        if (cantidad_produccion === "" || cantidad_produccion == 0) {
            alert("Cantidad de produccion vacía");
            document.getElementById('cantidad_produccion').focus();
            return;
        }

        $('#modal_finalizar').modal();
    }

    function getCantidadesUtilizadasExedientes() {

        let cantidades_utilizadas = Array.prototype.slice.call(document.getElementsByClassName('cantidad_utilizada'));
        let cantidades_maximas = Array.prototype.slice.call(document.getElementsByClassName('cantidad_maxima'));

        let cantidades = [];
        for (let i = 0; i < cantidades_utilizadas.length; i++) {

            if (parseFloat(cantidades_utilizadas[i].value) > parseFloat(cantidades_maximas[i].value)) {
                cantidades.push(cantidades_utilizadas[i]);
            }
        }

        return cantidades;
    }

    function setInputFilter(input, inputFilter) {

        const events = ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"];
        events.forEach(function (event) {
            input.addEventListener(event, function () {

                if (inputFilter(this.value) || this.value.length == 0) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

    function getCantidadesUtilizadasSinConfirmar() {

        let cantidades = Array.prototype.slice.call(document.getElementsByClassName('cantidad_utilizada'));

        return cantidades.filter(function (e) {
            return e.value === "";
        });
    }

</script>
