<div id="modal-colaboradores"
     class="modal fade bs-example-modal-lg"
     tabindex="-1" role="dialog"
     aria-labelledby="classInfo"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="nombre-colaboradores">

                </h4>
            </div>
            <div class="modal-body" style="height: 50vh;overflow-y: auto">
                <table id="table-colaboradores" class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>CODIGO BARRA</th>
                        <th>COLABORADOR</th>

                    </tr>
                    </thead>
                    <tbody id="tbody-colaboradores">

                    </tbody>
                </table>
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
                        id="btn_aceptar"
                        onclick="agregarColaboradores()"
                        data-dismiss="modal">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
