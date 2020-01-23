<div id="modal_confirmar"
     class="modal fade "
     tabindex="-1" role="dialog"
     aria-labelledby="classInfo"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="nombre-productos">
                    OBSERVACIONES :
                </h4>
            </div>
            <div class="modal-body" style="height: 50vh;overflow-y: auto">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="form-group">
                          <textarea
                              onkeyup="verficar_obsevaciones(this.value)"
                              id="observaciones_previa"
                              class="form-control" rows="12" cols="18"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary"
                        data-dismiss="modal">
                    Cerrar
                </button>
                <button type="button"
                        class="btn btn-primary"
                        disabled
                        id="btn_confirmar_observaciones"
                        onclick="cargar_observaciones();"
                        data-dismiss="modal">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
