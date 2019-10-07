@component('componentes.search',
['search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
'modulo'=>'registro/colaboradores'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/colaboradores',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'CODIGO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/colaboradores',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'nombre',
                          'titulo'=>'nombre'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/colaboradores',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'apellido',
                          'titulo'=>'apellido'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/colaboradores',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'estado',
                          'titulo'=>'estado'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($colaboradores as $colaborador)
                    <tr>
                        <td>
                            <input type="radio" name="id_colaborador" value="{{$colaborador->id_colaborador}}">

                        </td>
                        <td>
                            {{$colaborador->codigo_barras}}
                        </td>
                        <td>
                            {{$colaborador->nombre}}
                        </td>
                        <td>
                            {{$colaborador->apellido}}
                        </td>
                        <td>
                            @if($colaborador->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                      ['model'=>'COLABORADOR',
                      'id'=>$colaborador->id_colaborador,
                      'method'=>'ColaboradorController@destroy',
                      'extras'=>'',
                      'description'=>$colaborador->nombre,
                      'url'=>url('registro/colaboradores/')."/".$colaborador->id_colaborador])
                    @endcomponent
                @endforeach

                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$colaboradores])
    </div>
</div>

