@component('componentes.search',
[
    'search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
    'modulo'=>'registro/bodegas'
])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bodegas',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bodegas',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bodegas',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'localidad',
                        'titulo'=>'localidad'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bodegas',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bodegas',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($bodegas as $bodega)
                    <tr>
                        <td>
                            <input type="radio" name="id_bodega" value="{{$bodega->id_bodega}}">

                        </td>
                        <td>
                            {{$bodega->codigo_barras}}
                        </td>
                        <td>
                            {{$bodega->descripcion}}
                        </td>
                        <td>
                            {{$bodega->localidad}}
                        </td>
                        <td>
                            {{$bodega->encargado}}
                        </td>
                        <td>
                            @if($bodega->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                    ['model'=>'BODEGA',
                    'id'=>$bodega->id_bodega,
                    'method'=>'LocalidadController@destroy',
                    'extras'=>'',
                    'description'=>$bodega->descripcion,
                    'url'=>url('registro/bodegas/')."/".$bodega->id_bodega])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{
      $bodegas->appends([
          'search' => $search,
          'sort'=>$sort,
          'field'=>$sortField
      ])->links()
  }}
</div>

