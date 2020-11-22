@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
  'sortField'=>$sortField,
'modulo'=>'produccion/requisiciones'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/requisiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'requisicion_encabezado.no_orden_produccion',
                          'titulo'=>'NO. ORDEN'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/requisiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'requisicion_encabezado.no_requision',
                          'titulo'=>'NO. REQUISION'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/requisiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'users.nombre',
                          'titulo'=>'Elaborador'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'produccion/requisiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'requisicion_encabezado.estado',
                          'titulo'=>'Estado'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($operaciones as $operacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$operacion->id}}">

                        </td>
                        <td>
                            {{$operacion->no_orden_produccion}}
                        </td>
                        <td>
                            {{$operacion->no_requision}}
                        </td>

                        <td>
                            {{$operacion->usuario_ingreso->nombre}}
                        </td>
                        <td>
                            @if($operacion->estado == "P")
                                <span class="label label-warning">
                                      Proceso
                                </span>
                            @elseif($operacion->estado=="R")
                                <span class="label label-default">
                                      Pendiente
                                </span>
                            @elseif($operacion->estado=="B")
                                <span class="label label-danger">
                                      Baja
                                </span>
                            @elseif($operacion->estado=="D")
                                <span class="label label-primary">
                                      Armada
                                </span>
                            @else

                                <span class="label label-success">
                                      Despachada
                                </span>
                            @endif

                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                    ['model'=>'REQUISICION',
                    'id'=>$operacion->id,
                    'method'=>'RequisicionController@destroy',
                    'extras'=>'',
                    'description'=>$operacion->no_requision,
                    'url'=>url('produccion/requisiciones/')."/".$operacion->id])
                    @endcomponent
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

