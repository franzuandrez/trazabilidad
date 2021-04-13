<div class="modal  fade" id="modal-unidades_medida" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">CANTIDADES</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>

                            <th>CANTIDAD</th>
                            <th>UNIDAD MEDIDA</th>
                            <th>UBICACION</th>

                        </tr>
                        </thead>
                        <tbody id="detalles_cantidades">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">

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

