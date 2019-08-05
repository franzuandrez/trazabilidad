

function editar(){


    let id_dimensional = getDimensionalSelected();


    if(id_dimensional ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "dimensionales"+"/"+id_dimensional+"/edit";
    }

}


function eliminar(){

    id_dimensional = getDimensionalSelected();

    if(id_dimensional==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_dimensional).modal();
    }

}

function getDimensionalSelected(){
    var dimensionales = document.getElementsByName('id_dimensional');
    var id_dimensional=null;
    var arraydimensionales = Object.keys(dimensionales).map(function(key) {
        return [Number(key), dimensionales[key]];
    });


    arraydimensionales.forEach(function(user){
        if(user[1].checked){
            id_dimensional = user[1].value;
        }
    });
    return id_dimensional;
}


function ver(){
    let id_dimensional = getDimensionalSelected();

    if(id_dimensional==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "dimensionales"+"/"+id_dimensional+"";
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
