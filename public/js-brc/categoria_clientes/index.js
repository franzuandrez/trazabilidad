

function editar(){


    let id_categoria = getCategoriaSelected();


    if(id_categoria ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "categoria_clientes"+"/"+id_categoria+"/edit";
    }

}


function eliminar(){

    id_categoria = getCategoriaSelected();

    if(id_categoria==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_categoria).modal();
    }

}

function getCategoriaSelected(){
    var categoria_clientes = document.getElementsByName('id_categoria');
    var id_categoria=null;
    var arraycategoria_clientes = Object.keys(categoria_clientes).map(function(key) {
        return [Number(key), categoria_clientes[key]];
    });


    arraycategoria_clientes.forEach(function(user){
        if(user[1].checked){
            id_categoria = user[1].value;
        }
    });
    return id_categoria;
}


function ver(){
    let id_categoria = getCategoriaSelected();

    if(id_categoria==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "categoria_clientes"+"/"+id_categoria+"";
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
