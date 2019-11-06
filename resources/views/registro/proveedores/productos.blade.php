<div id="modal-productos"
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
                <h4 class="modal-title" id="nombre-productos">

                </h4>
            </div>
            <div class="modal-body" style="height: 50vh;overflow-y: auto">
                <table id="table-productos" class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>CODIGO BARRA</th>
                        <th>DESCRIPCION</th>

                    </tr>
                    </thead>
                    <tbody id="tbody-productos">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-primary"
                        data-dismiss="modal">
                    Cerrar
                </button>
                <button  type="button"
                         class="btn btn-primary"
                         id="aceptar_producto"
                         disabled
                         onclick="setProducto()"
                         data-dismiss="modal">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
