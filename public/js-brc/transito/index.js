function editar() {


    let id_recepcion_enc = getRecepcionSelected();


    if (id_recepcion_enc == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = "transito" + "/" + id_recepcion_enc + "/ingreso";
    }

}


function getRecepcionSelected() {
    var materia_prima = document.getElementsByName('id_recepcion_enc');
    var id_recepcion_enc = null;
    var arraymateria_prima = Object.keys(materia_prima).map(function (key) {
        return [Number(key), materia_prima[key]];
    });


    arraymateria_prima.forEach(function (user) {
        if (user[1].checked) {
            id_recepcion_enc = user[1].value;
        }
    });
    return id_recepcion_enc;
}


function ver() {
    let id_recepcion_enc = getRecepcionSelected();

    if (id_recepcion_enc == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = "transito" + "/" + id_recepcion_enc + "";
    }

}

function generico(url) {
    let id_recepcion_enc = getRecepcionSelected();

    if (id_recepcion_enc == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = url + "/" + id_recepcion_enc + "";
    }

}
