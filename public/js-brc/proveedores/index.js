

function editar(){


    let id_proveedor = getProveedorSelected();


    if(id_proveedor ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "proveedores"+"/"+id_proveedor+"/edit";
    }

}

function ver_detalle_productos(){

    let id_proveedor = getProveedorSelected();

    if(id_proveedor ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "proveedores"+"/"+id_proveedor+"/productos";
    }
}


function eliminar(){

    id_proveedor = getProveedorSelected();

    if(id_proveedor==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_proveedor).modal();
    }

}

function getProveedorSelected(){
    var proveedores = document.getElementsByName('id_proveedor');
    var id_proveedor=null;
    var arrayproveedores = Object.keys(proveedores).map(function(key) {
        return [Number(key), proveedores[key]];
    });


    arrayproveedores.forEach(function(user){
        if(user[1].checked){
            id_proveedor = user[1].value;
        }
    });
    return id_proveedor;
}


function ver(){
    let id_proveedor = getProveedorSelected();

    if(id_proveedor==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "proveedores"+"/"+id_proveedor+"";
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
