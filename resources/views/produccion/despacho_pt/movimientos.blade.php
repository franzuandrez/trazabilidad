<div class="modal  fade modal-slide-in-right in" aria-hidden="false" role="dialog" tabindex="-1"
     id="requision_pendiente" style="display: block; padding-right: 17px;">
    <div class="modal-dialog">
        <form method="POST" action="{{url('movimientos')}}">
            @csrf
            <input
                type="hidden"
                value="{{$requisicion->id}}"
                name="id_despacho">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" align="center">
                        Movimientos
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Producto
                                </th>
                                <th>

                                </th>
                                <th>
                                    - CAJAS
                                </th>
                                <th>
                                    +UNIDADES
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movimientos as $movimiento)
                                <tr>
                                    <td>
                                    <span
                                        style="display: none"
                                        class="label label-success"
                                        id="check-{{$movimiento['detalle_requisicion']['producto']['codigo_dun'].$movimiento['proximos_lotes']->first()['lote']}}"
                                    >
                                        <i class="fa fa-check"></i>
                                    </span>
                                        <span
                                            class="label label-warning"
                                            id="warning-{{$movimiento['detalle_requisicion']['producto']['codigo_dun'].$movimiento['proximos_lotes']->first()['lote']}}"
                                        >
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>
                                                <b>Producto : </b>
                                                {{$movimiento['detalle_requisicion']['producto']['codigo_interno']}}
                                            </li>
                                            <li>
                                                <b>Lote: </b> {{$movimiento['proximos_lotes']->first()['lote']}}
                                            </li>
                                        </ul>
                                        <input
                                            type="hidden"
                                            value="{{$movimiento['detalle_requisicion']['producto']['id_producto']}}"
                                            name="id_producto[]">
                                        <input
                                            type="hidden"
                                            value="{{$movimiento['proximos_lotes']->first()['lote']}}"
                                            name="lote[]">
                                        <input
                                            type="hidden"
                                            value="{{$movimiento['proximos_lotes']->first()['fecha_vencimiento']}}"
                                            name="fecha_vencimiento[]">
                                    </td>
                                    <td>
                                        <input
                                            type="hidden"
                                            value="1"
                                            id="{{$movimiento['detalle_requisicion']['producto']['codigo_dun'].$movimiento['proximos_lotes']->first()['lote']}}"
                                            name="producto">
                                        <input
                                            onkeydown="if(event.keyCode==13)leer_movimiento(this)"
                                        >
                                    </td>
                                    <td>
                                        <input
                                            type="hidden"
                                            value="1"
                                            name="cantidad_saliente[]">
                                        <input
                                            type="hidden"
                                            value="4140754842000031"
                                            name="bodega_saliente[]">
                                        1

                                    </td>
                                    <td>
                                        <input
                                            type="hidden"
                                            value="{{$movimiento['detalle_requisicion']['producto']['cantidad_unidades']}}"
                                            name="cantidad_entrante[]">
                                        <input
                                            type="hidden"
                                            value="4140754842000208"
                                            name="bodega_entrante[]">

                                        {{$movimiento['detalle_requisicion']['producto']['cantidad_unidades']}}
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            disabled
                            id="btn_aceptar"
                            class="btn btn-default">
                        <span class=" fa fa-check" ></span> Aceptar
                    </button>
                    <a href="{{url('produccion/despacho')}}">
                        <button type="button"
                                class="btn btn-default"
                                data-dismiss="modal"><span
                                class="fa fa-remove"></span> Cancelar
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
