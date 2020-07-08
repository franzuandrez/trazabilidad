<li>
    <i class="fa  fa-pencil-square  bg-gray-active"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>{{$evento->evento->fecha_ingreso->format('H:i:s')}}</span>
        <h3 class="timeline-header"><a href="#" style="color: #01579b !important;">
                Requisicion
            </a> {{$evento->evento->no_requision}}</h3>
        <div class="timeline-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th>No. Orden</th>
                    <td>{{$evento->evento->no_orden_produccion}}</td>
                </tr>
                <tr>
                    <th>Creado Por</th>
                    <td>{{$evento->evento->usuario_ingreso->nombre}}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

</li>
