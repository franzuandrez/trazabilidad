

function editar(){


    let id_cliente = getClienteSelected();


    if(id_cliente ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "clientes"+"/"+id_cliente+"/edit";
    }

}


function eliminar(){

    id_cliente = getClienteSelected();

    if(id_cliente==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_cliente).modal();
    }

}

function importar() {

    $('#modal-importar').modal();

}

function sync_icon(){

    var file = document.getElementById('file');

    if(file.files.length !== 0){
        var spinner = "<span class='fa  fa-refresh fa-spin'  id='icon-sync'></span> IMPORTANDO ";
        document.getElementById('btn-importar').innerHTML = spinner;
    }else{
        event.preventDefault();
        document.getElementById('alert-no-file').style.display='inline';

        setTimeout( function () {
            document.getElementById('alert-no-file').style.display='none';
        } ,2500)
    }



}

function getClienteSelected(){
    var clientes = document.getElementsByName('id_cliente');
    var id_cliente=null;
    var arrayclientes = Object.keys(clientes).map(function(key) {
        return [Number(key), clientes[key]];
    });


    arrayclientes.forEach(function(user){
        if(user[1].checked){
            id_cliente = user[1].value;
        }
    });
    return id_cliente;
}


function ver(){
    let id_cliente = getClienteSelected();

    if(id_cliente==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "clientes"+"/"+id_cliente+"";
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
