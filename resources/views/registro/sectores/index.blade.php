@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
 'sortField'=>$sortField,
'modulo'=>'registro/sectores'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'bodega',
                        'titulo'=>'Bodega'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($sectores as $sector)
                    <tr>
                        <td>
                            <input type="radio" name="id_sector" value="{{$sector->id_sector}}">

                        </td>
                        <td>
                            {{$sector->codigo_barras}}
                        </td>
                        <td>
                            {{$sector->descripcion}}
                        </td>
                        <td>
                            {{$sector->bodega}}
                        </td>
                        <td>
                            {{$sector->encargado}}
                        </td>

                    </tr>
                    @component('componentes.alert-delete',
                ['model'=>'BODEGA',
                'id'=>$sector->id_sector,
                'method'=>'SectorController@destroy',
                'extras'=>'',
                'description'=>$sector->descripcion,
                'url'=>url('registro/sectores/')."/".$sector->id_sector])
                    @endcomponent

                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$sectores])
    </div>
</div>

