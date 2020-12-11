<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="entregas_parciales">
    <div class="modal-dialog  modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">PRODUCCION

                </h4>

            </div>
            <div class="modal-body">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="impresoras">IMPRESORAS</label>
                    <select class="form-control selectpicker"
                            id="impresoras">
                        @foreach($impresoras as $impresora)
                            <option value="{{$impresora->id}}">{{$impresora->descripcion}} - {{$impresora->ip}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad_produccion_parcial">CANTIDAD PRODUCCION</label>
                        <input type="text"
                               name="cantidad_produccion_parcial"
                               id="cantidad_produccion_parcial"
                               class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="cantidad_etiquetas_corrugado_parcial">UNIDAD DE DISTRIBUCION</label>
                        <input type="text"
                               name="cantidad_etiquetas_corrugado_parcial"
                               id="cantidad_etiquetas_corrugado_parcial"
                               readonly
                               class="form-control">

                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <label for="cantidad_etiquetas_unidades_parcial">UNIDADES S/ETIQUETA</label>
                    <div class="input-group">
                        <input type="text"
                               name="cantidad_etiquetas_unidades_parcial"
                               id="cantidad_etiquetas_unidades_parcial"
                               readonly
                               class="form-control">
                        <div class="input-group-btn">
                            <button
                                onclick="realizar_entrega_parcial()"
                                type="button" class="btn btn-default">
                                <i class="fa fa-plus"

                                   aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead style="background-color: #01579B;  color: #fff;">
                            <tr>
                                <th>IMPRESORA</th>
                                <th>CANTIDAD PRODUCCION</th>
                                <th>
                                    UNIDAD DE DISTRIBUCION
                                </th>
                                <th>
                                    UNIDADES S/ETIQUETA
                                </th>
                            </tr>
                            </thead>
                            <tbody id="listado_entregas_parciales"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                    OK
                </button>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
