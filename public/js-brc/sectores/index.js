

function editar(){


    let id_sector = getSectorSelected();


    if(id_sector ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "sectores"+"/"+id_sector+"/edit";
    }

}


function eliminar(){

    id_sector = getSectorSelected();

    if(id_sector==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_sector).modal();
    }

}

function getSectorSelected(){
    var sectores = document.getElementsByName('id_sector');
    var id_sector=null;
    var arraysectores = Object.keys(sectores).map(function(key) {
        return [Number(key), sectores[key]];
    });


    arraysectores.forEach(function(user){
        if(user[1].checked){
            id_sector = user[1].value;
        }
    });
    return id_sector;
}


function ver(){
    let id_sector = getSectorSelected();

    if(id_sector==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "sectores"+"/"+id_sector+"";
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
