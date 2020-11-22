@component('componentes.search',
[
    'search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
    'modulo'=>'registro/localidades'
])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/localidades',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/localidades',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/localidades',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'direccion',
                        'titulo'=>'direccion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/localidades',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($localidades as $localidad)
                    <tr>
                        <td>
                            <input type="radio" name="id_localidad" value="{{$localidad->id_localidad}}">

                        </td>
                        <td>
                            {{$localidad->codigo_barras}}
                        </td>
                        <td>
                            {{$localidad->descripcion}}
                        </td>
                        <td>
                            {{$localidad->direccion}}
                        </td>
                        <td>
                            {{$localidad->encargado}}
                        </td>

                    </tr>

                    @component('componentes.alert-delete',
                   ['model'=>'LOCALIDAD',
                   'id'=>$localidad->id_localidad,
                   'method'=>'LocalidadController@destroy',
                   'extras'=>'',
                   'description'=>$localidad->descripcion,
                   'url'=>url('registro/localidades/')."/".$localidad->id_localidad])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$localidades])
    </div>

</div>

