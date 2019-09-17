<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
    <div class="table-responsive">
        <h3 class="box-title">PRODUCTOS
            <a  onclick="recalcular()"
                class="btn  btn-lg" style="border: none;color: #1b1e21">
                <i class="fa fa-refresh" id="icon-recalcular" aria-hidden="true"></i>  </a>
        </h3>

        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

            <thead style="background-color: #01579B;  color: #fff">
            <th></th>
            <th>DESCRIPCION</th>
            <th>LOTE</th>
            <th>CANTIDAD</th>
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
                        <input type="hidden" name="leido[]" value="{{$reserva->leido}}">
                    </td>
                    <td>
                        {{$reserva->producto->descripcion}}
                    </td>
                    <td>
                        {{$reserva->lote}}
                    </td>
                    <td>
                        {{$reserva->cantidad}}
                    </td>
                    <td>
                        {{$reserva->ubicacion}}
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
