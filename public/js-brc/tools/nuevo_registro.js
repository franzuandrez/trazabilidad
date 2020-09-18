function iniciar(url, no_orden_produccion) {

    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                no_orden_produccion: no_orden_produccion,
            },
            success: function (response) {


            },
            error: function (error) {
                console.log(error)
            }
        }
    );


}

function insertar_registros(url, fields, id) {

    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                fields: fields,
                id_model: id
            },
            success: function (response) {


            },
            error: function (error) {

            }
        }
    );

}


function registros() {


    return Array.prototype.slice.call(document.getElementsByClassName('valor'))
        .filter(e => e.value !== "" && e.tagName !== "DIV" && e.name !== "")
        .map(e =>
            formato_registro(e.name, e.value)
        )
}


function start_job(url, id) {


    setInterval(
        function () {
            insertar_registros(url, registros(), id);
        }

        , 10000);
}

function formato_registro(field, value) {

    return [field, value];
}


function array_registros(field, value) {
    return [formato_registro(field, value)]
}


function add_to_table(fields, id, table, url) {


    let row = `<tr>
            `;

    fields.forEach(function (e) {

        let value = e[1].value;
        let text = '';
        if (e[1].tagName === "SELECT") {
            text = $('#' + e[1].id + ' option:selected').text();

        } else {
            text = value;
        }
        row += `
                <td > <input type="hidden" value="${value}"  name="${e[0]}[]" >
                  ${text}
                  </td>
        `
        ;
    });

    row += '</tr>';
    $('#' + table).append(row);

}

function insertar_detalle(fields, no_orden_produccion, url) {


    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                fields: fields,
                no_orden_produccion: no_orden_produccion
            },
            success: function (response) {

            },
            error: function (error) {

            }
        }
    );


}

async function remover_elemento(element, id, url) {


    const response = await borrar_detalle(id, url);
    if (response.status == 0) {
        alert(reponse.message);
    } else {
        let td = $(element).parent();
        let row = td.parent();
        row.remove();
    }


}

function getRequest(fields) {
    const request = fields.map(function (e) {
        return [e[0], e[1].value];
    });

    return request;
}

function habilitar_formulario(fields) {

    fields.forEach(function (e) {

        e[1].disabled = false;
        if (e[1].tagName == "SELECT") {
            $(e[1]).selectpicker('refresh');
        }
    })
}

function limpiar_formulario(fields) {

    fields.forEach(function (e) {
        if (e[1].tagName == "INPUT") {
            e[1].value = "";
        }
    });
}

function get_no_orden_produccion() {

    return document.getElementById('no_orden_produccion').value;

}

function existe_campo_vacio(fields) {

    const filtered = fields.filter(function (e) {

        return e[1].value == "" && e[1].required;
    });

    const campo_vacio = get_campo_vacio(fields);
    const existe_campo_vacio = campo_vacio != null;


    return existe_campo_vacio;
}

function get_campo_vacio(fields) {
    const filtered = fields.filter(function (e) {

        return e[1].value == "" && e[1].required;
    });

    const existe_campo_vacio = filtered.length > 0;
    if (existe_campo_vacio) {
        return filtered[0][1];
    }
    return null;
}

function iniciar_formulario(no_orden_produccion) {

    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                no_orden_produccion: no_orden_produccion
            },
            success: function (response) {

            },
            error: function (error) {

            }
        }
    );
}


function borrar_detalle(id, url) {


    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                id: id,
            },
            success: function (response) {

            },
            error: function (error) {

            }
        }
    );
}


function mostrar_observaciones(hora, ultimo_registro, tiempo = 15) {
    let observaciones = '';
    if (ultimo_registro != null) {

        ultimo_registro = moment(moment().format('Y-MM-DD') + " " + ultimo_registro);

        if (ultimo_registro.clone().add(tiempo, 'minutes').isAfter(hora, 'minute')) {
            observaciones = ultimo_registro.clone().add(tiempo, 'minutes').diff(hora, 'minutes') + " minutos antes";
        }
        if (ultimo_registro.clone().add(tiempo, 'minutes').isBefore(hora, 'minute')) {
            observaciones = "Excede " + ultimo_registro.clone().add(tiempo, 'minutes').diff(hora, 'minutes') + " minutos";
        }


    }
    return observaciones;
}

async function buscar_no_orden_produccion(url, orden = 'no_orden_produccion') {

    $('.loading').show();
    const no_orden_produccion = document.getElementById(orden).value;
    const response = await iniciar(url, no_orden_produccion);

    console.log(response);
    if (response.status == 0) {
        alert(response.message);
    } else {
        gl_detalle_insumos = response.data.data;
        console.log(gl_detalle_insumos)
        document.getElementById('id_producto').disabled = false;
        document.getElementById('lote').disabled = false;
        document.getElementById('id_turno').disabled = false;
        $('#id_producto').selectpicker('refresh');
        $('#lote').selectpicker('refresh');
        $('#id_turno').selectpicker('refresh');
        cargar_productos();
        document.getElementById('no_orden_produccion').disabled = true;
    }

    $('.loading').hide();
}

function cargar_productos() {

    const select = document.getElementById('id_producto');
    $(select).empty();
    let option = '<option value="" selected>   SELECCIONE PRODUCTO </option>';
    gl_detalle_insumos.forEach(function (e) {
        option += `
                <option  value="${e.id_producto}" >  ${e.producto.codigo_interno} </option>
                `
    });
    $(select).append(option);
    $(select).selectpicker('refresh');
}

function get_id_control() {

    const id_producto = document.getElementById('id_producto').value;
    const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
    document.getElementById('id_control').value = id_control;
    return id_control;
}

function intentar_iniciar_formulario(url) {

    const id_producto = document.getElementById('id_producto').value;
    const lote = document.getElementById('lote').value;
    const turno = document.getElementById('id_turno').value;

    if (id_producto === "") {
        alert("Seleccione producto");
        return;
    }
    if (turno === "") {
        alert("Seleccione turno");
        return;
    }
    if (lote === "") {
        alert("Lote en blanco");
        return;
    }
    const id_control = gl_detalle_insumos.find(e => e.id_producto == id_producto).id_control;
    $('.loading').show();
    $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                id_control: id_control,
                lote: lote,
                turno: turno
            },
            success: function (response) {

                if (response.status === 1) {
                    habilitar_formulario(detalle());
                    deshabilitar_encabezado();
                } else {
                    alert(response.message);
                }
                $('.loading').hide();
            },
            error: function (error) {
                console.log(error);
                $('.loading').hide();
            }
        }
    );
}

function ver_informacion() {

    $('#informacion').modal()
}

function guardar() {

    document.getElementById('no_orden_produccion').disabled = false;
    $('form').submit();
}

function deshabilitar_encabezado() {
    document.getElementById('no_orden_produccion').disabled = true;
    document.getElementById('id_producto').disabled = true;
    document.getElementById('btn_buscar_orden').disabled = true;
    document.getElementById('lote').disabled = true;
    document.getElementById('id_turno').disabled = true;
    $('#id_producto').selectpicker('refresh');
    $('#lote').selectpicker('refresh');
    $('#id_turno').selectpicker('refresh');
}
