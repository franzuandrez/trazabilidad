<li>
    <i class="fa    fa fa-building-o    bg-light-blue"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>{{$evento->fecha->format('H:i:s')}}</span>
        <h3 class="timeline-header"><a href="#" style="color: #01579b !important;">
                Asignacion Ubicacion
            </a> {{$evento->evento['asignacion']->documento}}</h3>
        <div class="timeline-body">
            <table class="table table-bordered">
                <tr>
                    <th>Documento</th>
                    <td>{{$evento->evento['asignacion']->documento}}</td>
                </tr>
                <tr>
                    <th>Bodegero</th>
                    <td>{{$evento->evento['fecha']->causer->nombre}}</td>
                </tr>
            </table>
        </div>

    </div>

</li>
