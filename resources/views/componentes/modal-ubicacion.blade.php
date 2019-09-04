<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-ubicacion">
    {!
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">UBICACION</h4>
            </div>
            <div class="modal-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>

                            <th><i class="fa fa-building"></i> LOCALIDAD</th>
                            <td id="td-localidad"></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-building-o"></i> BODEGA</th>
                            <td id="td-bodega"></td>
                        </tr>
                        <tr>

                            <th><i class="fa  fa-square-o"></i> SECTOR</th>
                            <td id="td-sector"></td>
                        </tr>
                        <tr>
                            <th><i class="fa  fa-pause"></i> PASILLO</th>
                            <td id="td-pasillo"></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-tasks"></i> RACK</th>
                            <td id="td-rack"></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-sort-numeric-desc"></i> NIVEL</th>
                            <td id="td-nivel"></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-ellipsis-v"></i> POSICION</th>
                            <td id="td-posicion"></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-inbox"></i> BIN</th>
                            <td id="td-bin">CANTONESA</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" id="btn-importar"
                        data-dismiss="modal"
                        onclick="javascript:cantidad_focus()"
                        class="btn btn-default">
                    <span class="fa fa-check"></span>
                    ACEPTAR
                </button>
            </div>
        </div>
    </div>

</div>

