

function editar(){


    let id_bin = getBinSelected();


    if(id_bin ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "bines"+"/"+id_bin+"/edit";
    }

}


function eliminar(){

    id_bin = getBinSelected();

    if(id_bin==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_bin).modal();
    }

}

function getBinSelected(){
    var bines = document.getElementsByName('id_bin');
    var id_bin=null;
    var arraybines = Object.keys(bines).map(function(key) {
        return [Number(key), bines[key]];
    });


    arraybines.forEach(function(user){
        if(user[1].checked){
            id_bin = user[1].value;
        }
    });
    return id_bin;
}


function ver(){
    let id_bin = getBinSelected();

    if(id_bin==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "bines"+"/"+id_bin+"";
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
