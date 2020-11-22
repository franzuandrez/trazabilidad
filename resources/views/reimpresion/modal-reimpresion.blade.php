<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-reimpresion-{{$id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <div class="modal-body" align="center">
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <label>
                                Producto
                            </label>
                        </div>
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                            <div class="form-group">
                                <input type="text"
                                       readonly
                                       class="form-control"
                                       value="{{$descripcion}}"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <label>
                                Código
                            </label>
                        </div>
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                            <div class="form-group">
                                <input type="text"
                                       readonly
                                       class="form-control"
                                       value="{{$codigo}}"
                                >

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <label>
                                Cantidad
                            </label>
                        </div>
                        <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                            <div class="form-group">
                                <input type="number"
                                       placeholder="CANTIDAD"
                                       pattern="[0-9]+" name="cantidad" value="{{$cantidad}}" min="1" max="99999"
                                       id="cantidad-{{$id}}"

                                       class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-remove"></span>
                    CERRAR
                </button>
                <button type="button" onclick="reimprimir()" class="btn btn-primary"><span class=" fa fa-check"></span> ACEPTAR
                </button>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>
