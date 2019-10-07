@component('componentes.search',
['search'=>$search,
'sort'=>$sort,
'sortField'=>$sortField,
'modulo'=>'registro/posiciones'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/posiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/posiciones',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/posiciones',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'nivel',
                        'titulo'=>'nivel'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/posiciones',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($posiciones as $posicion)
                    <tr>
                        <td>
                            <input type="radio" name="id_posicion" value="{{$posicion->id_posicion}}">

                        </td>
                        <td>
                            {{$posicion->codigo_barras}}
                        </td>
                        <td>
                            {{$posicion->descripcion}}
                        </td>
                        <td>
                            {{$posicion->nivel}}
                        </td>
                        <td>
                            @if($posicion->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                                   ['model'=>'POSICION',
                                   'id'=>$posicion->id_posicion,
                                   'method'=>'PosicionController@destroy',
                                   'extras'=>'',
                                   'description'=>$posicion->descripcion,
                                   'url'=>url('registro/posiciones/')."/".$posicion->id_posicion])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$posiciones])
    </div>
</div>

