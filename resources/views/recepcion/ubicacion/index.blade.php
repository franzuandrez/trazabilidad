@include('componentes.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',[
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'orden_compra',
                          'titulo'=>'No. Documento'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'proveedores.nombre_comercial',
                          'titulo'=>'Proveedor'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',[
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_ingreso',
                          'titulo'=>'Fecha Ingreso'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($ordenes_en_control as $recepcion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$recepcion->id_recepcion_enc}}">

                        </td>
                        <td>
                            {{$recepcion->orden_compra}}
                        </td>
                        <td>
                            {{$recepcion->proveedor->nombre_comercial}}
                        </td>
                        <td>
                            {{$recepcion->fecha_ingreso->format('d/m/Y H:i:s')}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('componentes.pagination',['pagination'=>$ordenes_en_control])
</div>

