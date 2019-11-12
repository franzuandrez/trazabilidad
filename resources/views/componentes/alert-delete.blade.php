<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-delete-{{$id}}">
    {{Form::Open(array('action'=>array($method,$id),'method'=>'delete'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">DAR DE BAJA  {{$model}} : {{$description}} </h4>
                <div class="modal-body" align="center">
                    @if($extras !=null && $extras!='')
                        {{$extras}}
                    @endif
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-remove"></span> CERRAR</button>
                <button type="button" onclick="javascipt:darBaja('{{$url}}')" class="btn btn-default"><span class=" fa fa-check"></span> ACEPTAR</button>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
