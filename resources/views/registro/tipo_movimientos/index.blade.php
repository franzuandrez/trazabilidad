@component('componentes.search',
['search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
'modulo'=>'registro/tipo_movimientos'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/tipo_movimientos',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/tipo_movimientos',
                         'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($tipos as $tipo)
                    <tr>
                        <td>
                            <input type="radio" name="id_tipo_movimiento" value="{{$tipo->id_movimiento}}">

                        </td>
                        <td>
                            {{$tipo->descripcion}}
                        </td>
                        <td>
                            @if($tipo->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                      ['model'=>'TIPO MOVIMIENTO',
                      'id'=>$tipo->id_movimiento,
                      'method'=>'TipoMovimientoController@destroy',
                      'extras'=>'',
                      'description'=>$tipo->descripcion,
                      'url'=>url('registro/tipo_movimientos/')."/".$tipo->id_movimiento])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{
      $tipos->appends([
        'search' => $search,
        'sort'=>$sort,
        'field'=>$sortField
        ])->links()

    }}
</div>

