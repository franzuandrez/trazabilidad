

function editar(){


    let id_posicion = getPosicionSelected();


    if(id_posicion ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "posiciones"+"/"+id_posicion+"/edit";
    }

}


function eliminar(){

    id_posicion = getPosicionSelected();

    if(id_posicion==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_posicion).modal();
    }

}

function getPosicionSelected(){
    var posiciones = document.getElementsByName('id_posicion');
    var id_posicion=null;
    var arrayposiciones = Object.keys(posiciones).map(function(key) {
        return [Number(key), posiciones[key]];
    });


    arrayposiciones.forEach(function(user){
        if(user[1].checked){
            id_posicion = user[1].value;
        }
    });
    return id_posicion;
}


function ver(){
    let id_posicion = getPosicionSelected();

    if(id_posicion==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "posiciones"+"/"+id_posicion+"";
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
