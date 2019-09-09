<div id="autorizacion" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" align="center">Autorización</h2>

            </div>

            <form action="" method="post" class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text"
                                       class="form-control" placeholder="Usuario"
                                       id="user"
                                       required="required">
                            </div>
                        </div>
                    <hr>
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control"
                                       id="password"
                                       onkeydown="if(event.keyCode==13)verificar()"
                                       placeholder="Contraseña"
                                       required="required">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btn-verificar"
                            onclick="verificar()"
                            class="btn btn-default">
                        <span class="fa fa-check"
                              id="icon-sync"></span>
                        VERIFICAR
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-remove"></span>
                        CANCELAR
                    </button>


                </div>
            </form>


        </div>
    </div>
</div>
<script>

    function verificar() {

        let usuario = document.getElementById('user').value;
        let pass = document.getElementById('password').value;

        if(usuario == ""){
            alert("Usuario en blanco");
            document.getElementById('user').focus();
            return;
        }

        if(pass==""){
            alert("Contraseña en blanco");
            document.getElementById('password').focus();
            return;
        }
        $.ajax({
            url: "{{$ruta}}",
            type: 'post',
            dataType: "json",
            data: {_token: $('meta[name="csrf-token"]').attr('content'), usuario: usuario, pass: pass},
            success: function (response) {

                if (response == 1) {

                    document.getElementById('user_acepted').value = usuario;
                    $("#{{$id_form}}").submit();
                } else {
                    alert("Usuario incorrecto");
                }
                document.getElementById('user').value = "";
                document.getElementById('password').value = "";



            },
            error: function (e) {

                console.error(e);
                alert("Usuario incorrecto");

            }
        })
    }
</script>

