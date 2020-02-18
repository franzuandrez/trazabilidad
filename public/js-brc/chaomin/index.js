function getChaominSelected() {
    var chaomins = document.getElementsByName('id_chaomin');
    var id_chaomin = null;
    var arraychaomins = Object.keys(chaomins).map(function (key) {
        return [Number(key), chaomins[key]];
    });


    arraychaomins.forEach(function (user) {
        if (user[1].checked) {
            id_chaomin = user[1].value;
        }
    });
    return id_chaomin;
}


function ver() {
    let id_chaomin = getChaominSelected();

    if (id_chaomin == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = "chaomin" + "/" + id_chaomin + "";
    }

}


function editar() {
    let id_chaomin = getChaominSelected();

    if (id_chaomin == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = "chaomin" + "/" + id_chaomin + "/edit";
    }
}

function reporte(url) {
    let id_chaomin = getChaominSelected();

    if (id_chaomin == null) {
        $('#errorToEdit').modal();
    } else {
        window.location.href = url + "/" + id_chaomin;
    }
}
