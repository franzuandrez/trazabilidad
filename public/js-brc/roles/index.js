

function editar(){


    let id_rol = getRolSelected();


    if(id_rol ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "roles"+"/"+id_rol+"/edit";
    }

}


function eliminar(){

    id_rol = getRolSelected();

    if(id_rol==null){
        $('#errorToEdit').modal();
    }else{

        $('#modal-delete-'+id_rol).modal();
    }

}

function getRolSelected(){
    var roles = document.getElementsByName('id_rol');
    var id_rol=null;
    var arrayroles = Object.keys(roles).map(function(key) {
        return [Number(key), roles[key]];
    });


    arrayroles.forEach(function(rol){
        if(rol[1].checked){
            id_rol = rol[1].value;
        }
    });
    return id_rol;
}


function ver(){
    let id_rol = getRolSelected();

    if(id_rol==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "roles"+"/"+id_rol+"";
    }

}
