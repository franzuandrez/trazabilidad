

function editar(){


    let id_user = getUserSelected();


    if(id_user ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "users"+"/"+id_user+"/edit";
    }

}


function eliminar(){

    id_user = getUserSelected();

    if(id_user==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_user).modal();
    }

}

function getUserSelected(){
    var users = document.getElementsByName('id_user');
    var id_user=null;
    var arrayusers = Object.keys(users).map(function(key) {
        return [Number(key), users[key]];
    });


    arrayusers.forEach(function(user){
        if(user[1].checked){
            id_user = user[1].value;
        }
    });
    return id_user;
}


function ver(){
    let id_user = getUserSelected();

    if(id_user==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "users"+"/"+id_user+"";
    }

}

function darBaja(url){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $.ajax({

        url:url,
        type:'post',
        data:{_token:CSRF_TOKEN},
        success:function(response){

            window.location.reload();

        },
        error:function(e){


        }


    });



}
