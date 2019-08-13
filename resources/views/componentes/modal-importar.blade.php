<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-importar">
    {!!Form::open(array('route'=>$ruta, 'method'=>'POST','files'=> true))!!}
    {{Form::token()}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">{{$mensaje}}</h4>
            </div>
            <div class="modal-body">
                <input type="file"  class="form-control-file" id="file"  name="archivo_importar" >
            </div>
            <div class="modal-footer">

                    <button type="submit" id="btn-importar"
                            onclick="sync_icon()"
                            class="btn btn-default" >
                        <span class="fa fa-upload"
                              id="icon-sync" ></span>
                        IMPORTAR
                    </button>

            </div>
        </div>
    </div>
    {{Form::close()}}
</div>

