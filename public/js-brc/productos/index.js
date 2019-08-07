

function editar(){


    let id_producto = getProductoSelected();


    if(id_producto ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "productos"+"/"+id_producto+"/edit";
    }

}


function eliminar(){

    id_producto = getProductoSelected();

    if(id_producto==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_producto).modal();
    }

}

function getProductoSelected(){
    var productos = document.getElementsByName('id_producto');
    var id_producto=null;
    var arrayproductos = Object.keys(productos).map(function(key) {
        return [Number(key), productos[key]];
    });


    arrayproductos.forEach(function(user){
        if(user[1].checked){
            id_producto = user[1].value;
        }
    });
    return id_producto;
}


function ver(){
    let id_producto = getProductoSelected();

    if(id_producto==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "productos"+"/"+id_producto+"";
    }

}

function darBaja(url){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({

        url:url,
        type:'post',
        data:{_token:CSRF_TOKEN},
        success:function(response){

            $('.modal').modal('hide');

            setTimeout(function () {
                ajaxLoad(window.location.href);
            },500);


        },
        error:function(e){



        }


    });



}
