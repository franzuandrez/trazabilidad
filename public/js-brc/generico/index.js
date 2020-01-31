

function editar(modulo,opcion="edit"){


    let item = getItemSelected();


    if(item ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = modulo+"/"+item+"/"+opcion;
    }

}

function eliminar(){

    item = getItemSelected();

    if(item==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+item).modal();
    }

}


function getItemSelected(){

    var items = document.getElementsByName('id_item');
    var item=null;
    var arrayItems = Object.keys(items).map(function(key) {
        return [Number(key), items[key]];
    });


    arrayItems.forEach(function(element){
        if(element[1].checked){
            item = element[1].value;
        }
    });
    return item;
}


function ver(modulo){
    let item = getItemSelected();

    if(item==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = modulo+"/"+item+"";
    }

}

function reporte(modulo){
    let item = getItemSelected();

    if(item==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = modulo+"/"+item+"";
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
