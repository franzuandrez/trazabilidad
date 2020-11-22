<li>
    <i class="fa     fa-sign-in    bg-yellow"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>{{$evento->evento->fecha_ingreso->format('H:i:s')}}</span>
        <h3 class="timeline-header"><a href="#" style="color: #f7b633 !important;">
                Recepcion
            </a> {{$evento->evento->orden_compra}}</h3>
        <div class="timeline-body">
            <table class="table table-bordered">
                <tr>
                    <th>Documento</th>
                    <td>{{$evento->evento->documento_proveedor}}</td>
                </tr>
                <tr>
                    <th>Proveedor</th>
                    <td>{{$evento->evento->proveedor->razon_social}}</td>
                </tr>
                <tr>
                    <th>Usuario Recepcion</th>
                    <td>{{$evento->evento->recepcionado_por->nombre}}</td>
                </tr>
            </table>
        </div>

    </div>

</li>
