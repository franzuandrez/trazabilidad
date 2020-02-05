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
                          'field'=>'control_trazabilidad.id_control',
                          'titulo'=>'CONTROL'])

                </th>
                <th>
                    @include('componentes.column-sort',[
                          'field'=>'control_trazabilidad.no_orden_produccion',
                          'titulo'=>'NO. ORDEN PRODUCCION'])

                </th>
                <th>
                    @include('componentes.column-sort',[
                             'field'=>'productos.codigo_interno',
                             'titulo'=>'CODIGO INTERNO'])

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
                           'field'=>'control_trazabilidad.created_at',
                           'titulo'=>'Fecha'])

                </th>

                </thead>
                <tbody>
                @foreach($operaciones as $operacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$operacion->id_control}}">

                        </td>
                        <td>
                            {{$operacion->id_control}}
                        </td>
                        <td>
                            {{$operacion->requisiciones
                               ->reduce(
                                   function ($carry,$item){
                                        return
                                        $item->no_orden_produccion.' , '.$carry;
                                   },'')
                               }}
                        </td>
                        <td>
                            {{$operacion->producto->codigo_interno}}
                        </td>

                        <td>
                            {{$operacion->producto->descripcion}}
                        </td>
                        <td>
                            {{$operacion->lote}}
                        </td>
                        <td>
                            {{$operacion->created_at->format('d/m/Y H:i:s')}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @include('componentes.pagination',['pagination'=>$operaciones])
</div>

