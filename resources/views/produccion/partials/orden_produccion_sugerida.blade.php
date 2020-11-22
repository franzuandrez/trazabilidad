<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="ordenes_sugeridas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center">ORDENES SUGERIDAS</h4>
                <div class="modal-body" align="center">
                    <ul>
                        @foreach( (new \App\Repository\RequisicionRepository())->getOrdenesSugeridas() as $orden)
                            <li id="{{$orden->no_orden_produccion}}">
                                {{$orden->no_orden_produccion}}
                                <button
                                    type="button"
                                    class="clipboard btn btn-default" data-clipboard-target="#{{$orden->no_orden_produccion}}">
                                  <i class="fa fa-clipboard"></i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>
                    ACEPTAR
                </button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script>
    new ClipboardJS('.clipboard');
    function ver_ordenes_sugeridas() {
        $('#ordenes_sugeridas').modal();
    }
</script>
