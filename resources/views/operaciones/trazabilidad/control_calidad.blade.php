<li>
    <i class="fa    fa fa fa-arrow-right      bg-red"></i>
    <div class="timeline-item">
        <span class="time"><i class="fa fa-clock-o"></i>{{$evento->fecha->format('H:i:s')}}</span>
        <h3 class="timeline-header"><a href="#" style="color: #01579b !important;">
                Control Calidad
            </a> {{$evento->evento['control_calidad']->documento}}</h3>
        <div class="timeline-body">
            <table class="table table-bordered">
                <tr>
                    <th>Documento</th>
                    <td>{{$evento->evento['control_calidad']->documento}}</td>
                </tr>
                <tr>
                    <th>Usuario Control Calidad</th>
                    <td>{{$evento->evento['fecha']->causer->nombre}}</td>
                </tr>
            </table>
        </div>

    </div>

</li>
