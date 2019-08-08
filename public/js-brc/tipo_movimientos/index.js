

function editar(){


    let id_tipo_movimiento = getTipoMovimientoSelected();


    if(id_tipo_movimiento ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "tipo_movimientos"+"/"+id_tipo_movimiento+"/edit";
    }

}


function eliminar(){

    id_tipo_movimiento = getTipoMovimientoSelected();

    if(id_tipo_movimiento==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_tipo_movimiento).modal();
    }

}

function getTipoMovimientoSelected(){
    var tipo_movimientos = document.getElementsByName('id_tipo_movimiento');
    var id_tipo_movimiento=null;
    var arraytipo_movimientos = Object.keys(tipo_movimientos).map(function(key) {
        return [Number(key), tipo_movimientos[key]];
    });


    arraytipo_movimientos.forEach(function(user){
        if(user[1].checked){
            id_tipo_movimiento = user[1].value;
        }
    });
    return id_tipo_movimiento;
}


function ver(){
    let id_tipo_movimiento = getTipoMovimientoSelected();

    if(id_tipo_movimiento==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "tipo_movimientos"+"/"+id_tipo_movimiento+"";
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
