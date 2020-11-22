@component('componentes.search',
[   'search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
    'modulo'=>'registro/bines'
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
                    @component('componentes.column-sort',['modulo'=>'registro/bines',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bines',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bines',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'posicion',
                        'titulo'=>'posicion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/bines',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($bines as $bin)
                    <tr>
                        <td>
                            <input type="radio" name="id_bin" value="{{$bin->id_bin}}">

                        </td>
                        <td>
                            {{$bin->codigo_barras}}
                        </td>
                        <td>
                            {{$bin->descripcion}}
                        </td>
                        <td>
                            {{$bin->posicion}}
                        </td>
                        <td>
                            @if($bin->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>

                    @component('componentes.alert-delete',
                ['model'=>'BIN',
                'id'=>$bin->id_bin,
                'method'=>'BinController@destroy',
                'extras'=>'',
                'description'=>$bin->descripcion,
                'url'=>url('registro/bines/')."/".$bin->id_bin])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$bines])
    </div>
</div>

