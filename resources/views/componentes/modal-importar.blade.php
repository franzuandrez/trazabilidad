<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-importar">
    {!!Form::open(array('route'=>$ruta, 'method'=>'POST','files'=> true))!!}
    {{Form::token()}}
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">{{$mensaje}}
                    <i data-toggle="popover" class="fa fa-info-circle"
                       data-html="true"
                       title="Formato Carga <i class='fa fa-upload' ></i>"
                       data-placement="bottom"
                       data-trigger="hover"
                       data-content="@include('componentes.formato-carga')" >
                    </i>
                </h4>

            </div>
            <div class="modal-body">
                <span style="display: none;color:red" class="move"
                      id="alert-no-file"> Debe seleccionar un archivo </span>
                <input type="file"
                       class="form-control-file"
                       id="file"
                       name="archivo_importar">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-remove"></span>
                    CANCELAR
                </button>
                <button type="submit" id="btn-importar"
                        onclick="sync_icon()"
                        class="btn btn-default">
                        <span class="fa fa-upload"
                              id="icon-sync"></span>
                    IMPORTAR
                </button>

            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
