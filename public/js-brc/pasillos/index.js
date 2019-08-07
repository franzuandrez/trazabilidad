

function editar(){


    let id_pasillo = getPasilloSelected();


    if(id_pasillo ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "pasillos"+"/"+id_pasillo+"/edit";
    }

}


function eliminar(){

    id_pasillo = getPasilloSelected();

    if(id_pasillo==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_pasillo).modal();
    }

}

function getPasilloSelected(){
    var pasillos = document.getElementsByName('id_pasillo');
    var id_pasillo=null;
    var arraypasillos = Object.keys(pasillos).map(function(key) {
        return [Number(key), pasillos[key]];
    });


    arraypasillos.forEach(function(user){
        if(user[1].checked){
            id_pasillo = user[1].value;
        }
    });
    return id_pasillo;
}


function ver(){
    let id_pasillo = getPasilloSelected();

    if(id_pasillo==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "pasillos"+"/"+id_pasillo+"";
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
