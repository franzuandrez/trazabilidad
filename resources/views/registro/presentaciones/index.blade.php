@component('componentes.search',
['search'=>$search,
 'sort'=>$sort,
 'sortField'=>$sortField,
'modulo'=>'registro/presentaciones'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/presentaciones',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/presentaciones',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/presentaciones',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($presentaciones as $presentacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_presentacion" value="{{$presentacion->id_presentacion}}">

                        </td>
                        <td>
                            {{$presentacion->codigo_barras}}
                        </td>
                        <td>
                            {{$presentacion->descripcion}}
                        </td>
                        <td>
                            @if($presentacion->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>

                    </tr>

                    @component('componentes.alert-delete',
                     ['model'=>'PRESENTACION',
                     'id'=>$presentacion->id_presentacion,
                     'method'=>'PresentacionController@destroy',
                     'extras'=>'',
                     'description'=>$presentacion->descripcion,
                     'url'=>url('registro/presentaciones/')."/".$presentacion->id_presentacion])
                    @endcomponent
                @endforeach


                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$presentaciones])
    </div>
</div>

