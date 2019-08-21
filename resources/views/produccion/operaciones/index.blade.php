@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
  'sortField'=>$sortField,
'modulo'=>'produccion/operaciones'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/operaciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'produccion_encabezado.no_orden_produccion',
                          'titulo'=>'NO. ORDEN'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/operaciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'produccion_encabezado.no_requision',
                          'titulo'=>'NO. REQUISION'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/operaciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'users.nombre',
                          'titulo'=>'Elaborador'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($operaciones as $operacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_operacion" value="{{$operacion->id}}">

                        </td>
                        <td>
                            {{$recepcion->no_orden_produccion}}
                        </td>
                        <td>
                            {{$recepcion->no_requision}}
                        </td>

                        <td>
                            {{$recepcion->fecha_ingreso}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{
  $operaciones->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
  ])->links()
  }}
</div>

