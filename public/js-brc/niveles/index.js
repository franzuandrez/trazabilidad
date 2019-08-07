

function editar(){


    let id_nivel = getNivelSelected();


    if(id_nivel ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "niveles"+"/"+id_nivel+"/edit";
    }

}


function eliminar(){

    id_nivel = getNivelSelected();

    if(id_nivel==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_nivel).modal();
    }

}

function getNivelSelected(){
    var niveles = document.getElementsByName('id_nivel');
    var id_nivel=null;
    var arrayniveles = Object.keys(niveles).map(function(key) {
        return [Number(key), niveles[key]];
    });


    arrayniveles.forEach(function(user){
        if(user[1].checked){
            id_nivel = user[1].value;
        }
    });
    return id_nivel;
}


function ver(){
    let id_nivel = getNivelSelected();

    if(id_nivel==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "niveles"+"/"+id_nivel+"";
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
