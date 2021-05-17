<div class="modal  fade modal-slide-in-right in" aria-hidden="false" id="confirmar_producto"
     aria-hidden="false" role="dialog" tabindex="-1"
     style="display: block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CONFIRMAR</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <label for="codigo_confirmacion_producto">CODIGO </label>
                        <div class="input-group">
                            <input type="text"
                                   name="codigo_confirmacion_producto"
                                   id="codigo_confirmacion_producto"
                                   onkeydown="if(event.keyCode==13)confirmar_producto()"
                                   class="form-control">
                            <div class="input-group-btn">
                                <button type="button"
                                        onclick="confirmar_producto()"
                                        class="btn btn-default"
                                >
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        onclick="finalizar()"
                        class="btn btn-outline pull-left">Entiendo
                </button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>


</script>

