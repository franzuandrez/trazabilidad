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
        .filter(e => e.value != "")
        .map(e =>
            formato_registro(e.name, e.value)
        )
}


function start_job(url,id) {


    setInterval(
        function () {
            insertar_registros(url,registros(),id);
        }

        , 10000);
}

function formato_registro(field, value) {

    return [field, value];
}


function array_registros(field, value) {
    return [formato_registro(field, value)]
}
