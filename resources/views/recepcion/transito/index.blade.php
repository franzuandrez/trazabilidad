@include('recepcion.transito.search_with_specific_field')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @include('recepcion.transito.sort',['modulo'=>'recepcion/transito',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'orden_compra',
                          'titulo'=>'NO. DOCUMENTO'])

                </th>
                <th>
                    @include('recepcion.transito.sort',['modulo'=>'recepcion/transito',
                           'search'=>$search,
                             'sort'=>$sort,
                             'sortField'=>$sortField,
                             'field'=>'proveedores.nombre_comercial',
                             'titulo'=>'proveedor'])

                </th>

                <th>
                    @include('recepcion.transito.sort',['modulo'=>'recepcion/transito',
                      'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'fecha_ingreso',
                        'titulo'=>'FECHA INGRESO'])

                </th>

                </thead>
                <tbody>
                @foreach($movimientos_en_transito as $recepcion)
                    <tr>
                        <td>
                            <input type="radio" name="id_recepcion_enc" value="{{$recepcion->id_recepcion_enc}}">

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
    {{
      $movimientos_en_transito->appends([
          'search' => $search,
          'sort'=>$sort,
          'field'=>$sortField,
          'campo_busqueda'=>$campo_busqueda
      ])->links()
    }}
</div>

