<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="ordenes_sugeridas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">ORDENES SUGERIDAS</h4>
                <div class="modal-body" align="center">
                    <ul>
                        @foreach($ordenes as $orden)
                            <li>{{$orden->no_orden_produccion}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                    ACEPTAR
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function ver_ordenes_sugeridas() {
        $('#ordenes_sugeridas').modal();
    }
</script>
