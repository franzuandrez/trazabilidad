@component('componentes.search',
['search'=>$search,'modulo'=>'registro/sectores'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'bodega',
                        'titulo'=>'bodega'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
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
                        <td>
                            @if($sector->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                ['model'=>'SECTOR',
                'id'=>$sector->id_sector,
                'method'=>'SectorController@destroy',
                'extras'=>'',
                'description'=>$sector->descripcion,
                'url'=>url('control/chaomin/')."/".$sector->id_sector])
                    @endcomponent

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

