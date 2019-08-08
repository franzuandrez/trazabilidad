

function editar(){


    let id_actividad = getActividadSelected();


    if(id_actividad ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "actividades"+"/"+id_actividad+"/edit";
    }

}


function eliminar(){

    id_actividad = getActividadSelected();

    if(id_actividad==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_actividad).modal();
    }

}

function getActividadSelected(){
    var actividades = document.getElementsByName('id_actividad');
    var id_actividad=null;
    var arrayactividades = Object.keys(actividades).map(function(key) {
        return [Number(key), actividades[key]];
    });


    arrayactividades.forEach(function(user){
        if(user[1].checked){
            id_actividad = user[1].value;
        }
    });
    return id_actividad;
}


function ver(){
    let id_actividad = getActividadSelected();

    if(id_actividad==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "actividades"+"/"+id_actividad+"";
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
