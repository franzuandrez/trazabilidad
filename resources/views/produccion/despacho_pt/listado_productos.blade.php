<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
    <div class="table-responsive">
        <h3 class="box-title">PRODUCTOS
            <a onclick="recalcular()"
               class="btn  btn-lg" style="border: none;color: #1b1e21">
                <i class="fa fa-refresh" id="icon-recalcular" aria-hidden="true"></i> </a>
        </h3>

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff">
            <th></th>
            <th>DESCRIPCION</th>
            <th>LOTE</th>
            <th>CANTIDAD</th>
            <th>CANTIDAD ACUMULADA</th>
            <th>UBICACION</th>
            </thead>
            <tbody>
            @foreach( $requisicion->reservas as $reserva  )
                <tr id="{{$reserva->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}">
                    <td>
                        @if($reserva->leido == 'N')
                            <span class="label label-warning"
                                  id="span-{{$reserva->id_reserva}}"
                                  data-html="true"
                                  title="
                                      <strong>Estado :</strong> Pendiente
                                                "
                                  data-toggle="tooltip">
                                 <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </span>
                        @else
                            <span class="label label-success"
                                  data-html="true"
                                  title="
                                      <strong>Estado :</strong> Leido<br>
                                      <strong>Por : </strong>{{$reserva->usuario_picking->nombre}}<br>
                                      <strong>Fecha : </strong>{{$reserva->fecha_lectura->format('d/m/Y')}}<br>
                                      <strong>Hora: </strong>{{$reserva->fecha_lectura->format('H:i:s')}}
                                      "
                                  data-toggle="tooltip">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                        @endif
                        <input type="hidden" name="id_reserva[]" value="{{$reserva->id_reserva}}">
                        <input type="hidden" name="leido[]" value="{{$reserva->leido}}">
                    </td>
                    <td>
                        <input type="hidden" name="id_producto[]" value="{{$reserva->producto->id_producto}}">
                        {{$reserva->producto->descripcion}}
                    </td>
                    <td>
                        <input type="hidden" name="lote[]" value="{{$reserva->lote}}">
                        {{$reserva->lote}}
                    </td>
                    <td>
                        <input type="hidden"
                               id="cantidad-{{$reserva->producto->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}"
                               name="cantidad[]" value="{{$reserva->cantidad}}">
                        {{$reserva->cantidad}}
                    </td>
                    <td id="td_cantidad_acumulada-{{$reserva->producto->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}">
                        @if($reserva->leido == 'N')

                            {{$reserva->cantidad_acumulada}}

                        @else
                            {{$reserva->cantidad}}
                        @endif
                    </td>
                    <input type="hidden" name="cantidad_acumulada[]"
                           id="cantidad_acumulada-{{$reserva->producto->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}"
                           value="{{$reserva->cantidad_acumulada}}">


                    <td>
                        <input type="hidden" name="ubicacion[]" value="{{$reserva->ubicacion}}">
                        {{$reserva->ubicacion()->first()->bodega->descripcion}}
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        {{$reserva->ubicacion()->first()->descripcion}}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>
<script>
    function getReservas() {

        let reservas = @json($requisicion->reservas);
        return reservas;
    }
</script>
