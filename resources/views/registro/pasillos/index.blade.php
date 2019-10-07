@component('componentes.search',
['search'=>$search,
   'sort'=>$sort,
   'sortField'=>$sortField,
'modulo'=>'registro/pasillos'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'sector',
                        'titulo'=>'sector'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($pasillos as $pasillo)
                    <tr>
                        <td>
                            <input type="radio" name="id_pasillo" value="{{$pasillo->id_pasillo}}">

                        </td>
                        <td>
                            {{$pasillo->codigo_barras}}
                        </td>
                        <td>
                            {{$pasillo->descripcion}}
                        </td>
                        <td>
                            {{$pasillo->sector}}
                        </td>
                        <td>
                            {{$pasillo->encargado}}
                        </td>
                        <td>
                            @if($pasillo->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                                    ['model'=>'PASILLO',
                                    'id'=>$pasillo->id_pasillo,
                                    'method'=>'PasilloController@destroy',
                                    'extras'=>'',
                                    'description'=>$pasillo->descripcion,
                                    'url'=>url('registro/pasillos/')."/".$pasillo->id_pasillo])
                    @endcomponent

                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$pasillos])
    </div>
</div>

