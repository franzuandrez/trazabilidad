

function editar(){


    let id_cliente = getClienteSelected();


    if(id_cliente ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "clientes"+"/"+id_cliente+"/edit";
    }

}


function eliminar(){

    id_cliente = getClienteSelected();

    if(id_cliente==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_cliente).modal();
    }

}

function getClienteSelected(){
    var clientes = document.getElementsByName('id_cliente');
    var id_cliente=null;
    var arrayclientes = Object.keys(clientes).map(function(key) {
        return [Number(key), clientes[key]];
    });


    arrayclientes.forEach(function(user){
        if(user[1].checked){
            id_cliente = user[1].value;
        }
    });
    return id_cliente;
}


function ver(){
    let id_cliente = getClienteSelected();

    if(id_cliente==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "clientes"+"/"+id_cliente+"";
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
