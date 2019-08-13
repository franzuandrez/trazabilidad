@component('componentes.search',
['search'=>$search,
   'sort'=>$sort,
    'sortField'=>$sortField,
'modulo'=>'registro/actividades'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/actividades',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_actividad',
                          'titulo'=>'ID'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/actividades',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/actividades',
                         'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($actividades as $actividad)
                    <tr>
                        <td>
                            <input type="radio" name="id_actividad" value="{{$actividad->id_actividad}}">

                        </td>
                        <td>
                            {{$actividad->id_actividad}}
                        </td>
                        <td>
                            {{$actividad->descripcion}}
                        </td>
                        <td>
                            @if($actividad->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                        @component('componentes.alert-delete',
                           ['model'=>'ACTIVIDAD',
                           'id'=>$actividad->id_actividad,
                           'method'=>'RoleController@destroy',
                           'extras'=>'',
                           'description'=>$actividad->descripcion,
                           'url'=>url('registro/actividades/')."/".$actividad->id_actividad])
                        @endcomponent
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{
   $actividades->appends([
       'search' => $search,
       'sort'=>$sort,
       'field'=>$sortField
   ])->links()
   }}
</div>

