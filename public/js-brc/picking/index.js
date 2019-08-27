

function despachar(){


    let id_requisicion = getRequisicionSelected();


    if(id_requisicion ==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "picking"+"/"+id_requisicion+"/despachar";
    }

}




function getRequisicionSelected(){
    var requisicion = document.getElementsByName('id_requisicion');
    var id_requisicion=null;
    var arrayrequisicion = Object.keys(requisicion).map(function(key) {
        return [Number(key), requisicion[key]];
    });


    arrayrequisicion.forEach(function(user){
        if(user[1].checked){
            id_requisicion = user[1].value;
        }
    });
    return id_requisicion;
}


function ver(){
    let id_requisicion = getRequisicionSelected();

    if(id_requisicion==null){
        $('#errorToEdit').modal();
    }else{
        window.location.href = "picking"+"/"+id_requisicion+"";
    }

}


