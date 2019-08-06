

function editar(){


    let id_bodega = getBodegaSelected();


    if(id_bodega ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "bodegas"+"/"+id_bodega+"/edit";
    }

}


function eliminar(){

    id_bodega = getBodegaSelected();

    if(id_bodega==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_bodega).modal();
    }

}

function getBodegaSelected(){
    var bodegas = document.getElementsByName('id_bodega');
    var id_bodega=null;
    var arraybodegas = Object.keys(bodegas).map(function(key) {
        return [Number(key), bodegas[key]];
    });


    arraybodegas.forEach(function(user){
        if(user[1].checked){
            id_bodega = user[1].value;
        }
    });
    return id_bodega;
}


function ver(){
    let id_bodega = getBodegaSelected();

    if(id_bodega==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "bodegas"+"/"+id_bodega+"";
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
