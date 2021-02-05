<div class="modal modal-danger fade" id="modal_finalizar" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">FINALIZAR</h4>
            </div>
            <div class="modal-body">
                <p><b>¿Está seguro que desea finalizar la orden?</b>
                    tome en cuenta que esta acción no se puede revertir</p>
            </div>
            <div class="modal-footer">
                <button type="button"
                        onclick="finalizar()"
                        class="btn btn-outline pull-left" >Entiendo</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>

    function finalizar() {
        $('form').submit();
    }
</script>

