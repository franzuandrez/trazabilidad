

function editar(){


    let id_localidad = getLocalidadSelected();


    if(id_localidad ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "localidades"+"/"+id_localidad+"/edit";
    }

}


function eliminar(){

    id_localidad = getLocalidadSelected();

    if(id_localidad==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_localidad).modal();
    }

}

function getLocalidadSelected(){
    var localidades = document.getElementsByName('id_localidad');
    var id_localidad=null;
    var arraylocalidades = Object.keys(localidades).map(function(key) {
        return [Number(key), localidades[key]];
    });


    arraylocalidades.forEach(function(user){
        if(user[1].checked){
            id_localidad = user[1].value;
        }
    });
    return id_localidad;
}


function ver(){
    let id_localidad = getLocalidadSelected();

    if(id_localidad==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "localidades"+"/"+id_localidad+"";
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
