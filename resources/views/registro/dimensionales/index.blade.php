@component('componentes.search',
['search'=>$search,'modulo'=>'registro/dimensionales'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/dimensionales',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/dimensionales',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'unidad_medida',
                          'titulo'=>'UNIDAD DE MEDIDA'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/dimensionales',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'factor',
                          'titulo'=>'factor'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/dimensionales',
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'estado',
                         'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($dimensionales as $dimensional)
                    <tr>
                        <td>
                            <input type="radio" name="id_dimensional" value="{{$dimensional->id_dimensional}}">

                        </td>
                        <td>
                            {{$dimensional->descripcion}}
                        </td>
                        <td>
                            {{$dimensional->unidad_medida}}
                        </td>
                        <td>
                            {{$dimensional->factor}}
                        </td>
                        <td>
                            @if($dimensional->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>

                    </tr>
                    @component('componentes.alert-delete',
                                       ['model'=>'DIMENSIONAL',
                                       'id'=>$dimensional->id_dimensional,
                                       'method'=>'DimensionalController@destroy',
                                       'extras'=>'',
                                       'description'=>$dimensional->descripcion,
                                       'url'=>url('registro/dimensionales/')."/".$dimensional->id_dimensional])
                    @endcomponent
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
</div>

