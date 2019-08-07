

function editar(){


    let id_rack = getRackSelected();


    if(id_rack ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "racks"+"/"+id_rack+"/edit";
    }

}


function eliminar(){

    id_rack = getRackSelected();

    if(id_rack==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_rack).modal();
    }

}

function getRackSelected(){
    var racks = document.getElementsByName('id_rack');
    var id_rack=null;
    var arrayracks = Object.keys(racks).map(function(key) {
        return [Number(key), racks[key]];
    });


    arrayracks.forEach(function(user){
        if(user[1].checked){
            id_rack = user[1].value;
        }
    });
    return id_rack;
}


function ver(){
    let id_rack = getRackSelected();

    if(id_rack==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "racks"+"/"+id_rack+"";
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
