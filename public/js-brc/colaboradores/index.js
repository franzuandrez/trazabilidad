

function editar(){


    let id_colaborador = getColaboradorSelected();


    if(id_colaborador ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "colaboradores"+"/"+id_colaborador+"/edit";
    }

}


function eliminar(){

    id_colaborador = getColaboradorSelected();

    if(id_colaborador==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_colaborador).modal();
    }

}

function getColaboradorSelected(){
    var colaboradores = document.getElementsByName('id_colaborador');
    var id_colaborador=null;
    var arraycolaboradores = Object.keys(colaboradores).map(function(key) {
        return [Number(key), colaboradores[key]];
    });


    arraycolaboradores.forEach(function(user){
        if(user[1].checked){
            id_colaborador = user[1].value;
        }
    });
    return id_colaborador;
}


function ver(){
    let id_colaborador = getColaboradorSelected();

    if(id_colaborador==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "colaboradores"+"/"+id_colaborador+"";
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
