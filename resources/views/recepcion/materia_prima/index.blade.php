@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
  'sortField'=>$sortField,
'modulo'=>'recepcion/materia_prima'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'orden_compra',
                          'titulo'=>'NO. DOCUMENTO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'proveedor',
                          'titulo'=>'proveedor'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_ingreso',
                          'titulo'=>'FECHA INGRESO'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($recepciones as $recepcion)
                    <tr>
                        <td>
                            <input type="radio" name="id_recepcion_enc" value="{{$recepcion->id_recepcion_enc}}">

                        </td>
                        <td>
                            {{$recepcion->orden_compra}}
                        </td>
                        <td>
                            {{$recepcion->proveedor}}
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
  $recepciones->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
  ])->links()
  }}
</div>

