<div class="row">
    @include('operaciones.trazabilidad.search')
    @include('operaciones.trazabilidad.producto_trazabilidad')
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="timeline">
            @foreach( $trazabilidad_hacia_atras as  $fecha => $eventos )
                <li class="time-label">
                  <span class="bg-blue" style="background-color: #01579b !important;">
                  {{$fecha}}
                  </span>
                </li>
                @foreach($eventos as $evento)
                    @if($evento->tipo =='CT')
                        @include('operaciones.trazabilidad.control_trazabilidad')
                    @elseif($evento->tipo=='REQ')
                        @include('operaciones.trazabilidad.requisicion')
                    @elseif($evento->tipo=='REC')
                        @include('operaciones.trazabilidad.recepcion')
                    @endif
                @endforeach
            @endforeach
        </ul>
    </div>
</div>
