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