
function iniciar( url , no_orden_produccion) {

    return $.ajax(
        {
            type: "POST",
            url: url,
            data:{
                no_orden_produccion:no_orden_produccion,
            },
            success: function (response) {

                console.log(response)
            },
            error:function ( error) {
                console.log(error)
            }
        }
    );


}

function nuevo_registro(url,field,value,id) {

    $.ajax(
        {
            type: "POST",
            url: url,
            data:{
                field:field,
                value:value,
                id_model:id
            },
            contentType: false,
            success: function (response) {


            },
            error:function ( error) {

            }
        }
    );

}
