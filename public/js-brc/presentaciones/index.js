

function editar(){


    let id_presentacion = getPresentacionSelected();


    if(id_presentacion ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "presentaciones"+"/"+id_presentacion+"/edit";
    }

}


function eliminar(){

    id_presentacion = getPresentacionSelected();

    if(id_presentacion==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_presentacion).modal();
    }

}

function getPresentacionSelected(){
    var presentaciones = document.getElementsByName('id_presentacion');
    var id_presentacion=null;
    var arraypresentaciones = Object.keys(presentaciones).map(function(key) {
        return [Number(key), presentaciones[key]];
    });


    arraypresentaciones.forEach(function(user){
        if(user[1].checked){
            id_presentacion = user[1].value;
        }
    });
    return id_presentacion;
}


function ver(){
    let id_presentacion = getPresentacionSelected();

    if(id_presentacion==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "presentaciones"+"/"+id_presentacion+"";
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
