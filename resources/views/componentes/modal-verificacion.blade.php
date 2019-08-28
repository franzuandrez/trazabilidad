<div id="autorizacion" class="modal fade">
    <div class="modal-dialog modal-login">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" align="center">Autorización</h2>

            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text"
                                       class="form-control" placeholder="Usuario"
                                       id="user"
                                       required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control"
                                       id="password"
                                       placeholder="Contraseña"
                                       required="required">
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
</div>
<script>

    function verificar() {

        let usuario = document.getElementById('user').value;
        let pass = document.getElementById('password').value;
           $.ajax({
               url:"{{$ruta}}",
               type:'post',
               dataType: "json",
               data:{ _token:$('meta[name="csrf-token"]').attr('content'),usuario:usuario,pass:pass },
               success:function (response) {

                   if(response == 1){
                       $( "#{{$id_form}}" ).submit();
                   }else{
                       alert("Usuario incorrecto");
                   }
                   document.getElementById('user').value="";
                   document.getElementById('password').value="";
                   $('#autorizacion').modal('hide');


               },
               error:function (e) {

                   console.error(e);
                   alert("Algo salio mal, por favor vuelva a intentarlo");

               }
           })
    }
</script>

