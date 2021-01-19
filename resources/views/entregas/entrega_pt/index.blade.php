@include('componentes.search')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>


                <th>
                    @include('componentes.column-sort',[
                           'field'=>'productos.descripcion',
                           'titulo'=>'PRODUCTO'])

                </th>
                <th>
                    @include('componentes.column-sort',[
                           'field'=>'control_trazabilidad.lote',
                           'titulo'=>'LOTE'])
                </th>
                <th>
                    @include('componentes.column-sort',[
                           'field'=>'control_trazabilidad.cantidad_producida',
                           'titulo'=>'cantidad producida'])
                </th>
                <th>
                    @include('componentes.column-sort',[
                           'field'=>'productos.unidad_medida',
                           'titulo'=>'U.Medida'])
                </th>
                <th>
                    @include('componentes.column-sort',[
                           'field'=>'control_trazabilidad.status',
                           'titulo'=>'Estado'])
                </th>
                </thead>
                <tbody>
                @foreach($collection as $operacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$operacion->id_control}}">

                        </td>


                        <td>
                            {{$operacion->producto->descripcion}}
                        </td>
                        <td>
                            {{$operacion->lote}}
                        </td>
                        <td>
                            {{$operacion->cantidad_producida}}
                        </td>
                        <td>
                            {{$operacion->unidad_medida}}
                        </td>

                        <td>
                            @if($operacion->esta_entregado==0)
                                <label class="label label-warning">
                                    PENDIENTE
                                </label>
                            @elseif($operacion->status==1)
                                <label class="label-success label">
                                    ENTREGADO
                                </label>
                            @else
                                <label class="label-primary label">
                                    PROCESO
                                </label>
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @include('componentes.pagination',['pagination'=>$collection])
</div>

