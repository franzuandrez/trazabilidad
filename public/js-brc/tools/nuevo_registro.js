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


function mostrar_observaciones(hora,ultimo_registro) {
    let observaciones = '';
    if (ultimo_registro != null) {

        ultimo_registro = moment(moment().format('Y-MM-DD') + " " + ultimo_registro);

        if (ultimo_registro.clone().add('15', 'minutes').isAfter(hora, 'minute')) {
            observaciones = hora.clone().diff(ultimo_registro.add('15', 'minutes'), 'minutes') + " minutos antes";
        }
        if (ultimo_registro.clone().add('15', 'minutes').isBefore(hora, 'minute')) {
            observaciones = "Excede " + ultimo_registro.clone().add('15', 'minutes').diff(hora, 'minutes') + " minutos";
        }


    }
    return observaciones;
}
