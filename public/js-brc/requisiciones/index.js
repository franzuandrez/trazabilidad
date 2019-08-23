

function getRequisicionSelected(){
    var requisiciones = document.getElementsByName('id_requisicion');
    var id_requisicion=null;
    var arrayrequisiciones = Object.keys(requisiciones).map(function(key) {
        return [Number(key), requisiciones[key]];
    });


    arrayrequisiciones.forEach(function(user){
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
        window.location.href = "requisiciones"+"/"+id_requisicion+"";
    }

}
