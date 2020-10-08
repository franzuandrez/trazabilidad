<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed ">
                <thead style="background-color: #01579B;  color: #fff;border-color: #01579B">

                <tr>
                    <th style="border-color:  #f5f5f5">
                        FECHA
                    </th>
                    <th style="border-color:  #f5f5f5">
                        DOCUMENTO
                    </th>
                    <th style="border-color:  #f5f5f5">
                        REQUISICION
                    </th>
                    <th style="border-color:  #f5f5f5">
                        ENTRADAS
                    </th>
                    <th style="border-color:  #f5f5f5">
                        SALIDAS
                    </th>
                    <th style="border-color:  #f5f5f5">
                        SALDO
                    </th>
                    <th style="border-color:  #f5f5f5">
                        LOTE
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(count($movimientos)>0)
                    <tr>
                        <td colspan="4">
                            <b>SALDO INICIAL</b>
                        </td>
                        <td>
                            <b>{{ number_format($saldo_inicial,3,'.',',')}}</b>
                        </td>
                    </tr>
                    @foreach($movimientos as $movimiento)
                        <tr>
                            <td>{{$movimiento->fecha_hora_movimiento->format('d/m/Y')}}</td>
                            <td>{{$movimiento->numero_documento}}</td>
                            <td>{{$movimiento->requisicion}}</td>
                            <td>  {{ number_format(($movimiento->factor>0?$movimiento->total:0),3,'.',',') }}</td>
                            <td> {{ number_format(($movimiento->factor<0?$movimiento->total:0),3,'.',',') }}</td>
                            <td>{{ number_format($saldo_inicial=$saldo_inicial+($movimiento->factor*$movimiento->total),3,'.',',')   }}</td>
                            <td>{{$movimiento->lote}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <b>TOTAL</b>
                        </td>
                        <td>
                            <b>{{ number_format($saldo_inicial,3,'.',',')}}</b>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6"> Sin resultados</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

</div>


