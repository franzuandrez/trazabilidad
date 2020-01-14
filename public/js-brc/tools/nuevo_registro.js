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

function nuevo_registro(url, field, value, id) {

    return $.ajax(
        {
            type: "POST",
            url: url,
            data: {
                field: field,
                value: value,
                id_model: id
            },
            success: function (response) {


            },
            error: function (error) {

            }
        }
    );

}
