@component('componentes.search',
['search'=>$search,'modulo'=>'registro/niveles'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/niveles',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/niveles',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/niveles',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'rack',
                        'titulo'=>'rack'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/niveles',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($niveles as $nivel)
                    <tr>
                        <td>
                            <input type="radio" name="id_nivel" value="{{$nivel->id_nivel}}">

                        </td>
                        <td>
                            {{$nivel->codigo_barras}}
                        </td>
                        <td>
                            {{$nivel->descripcion}}
                        </td>
                        <td>
                            {{$nivel->rack}}
                        </td>

                        <td>
                            @if($nivel->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                     ['model'=>'NIVEL',
                     'id'=>$nivel->id_nivel,
                     'method'=>'NivelController@destroy',
                     'extras'=>'',
                     'description'=>$nivel->descripcion,
                     'url'=>url('registro/niveles/')."/".$nivel->id_nivel])
                    @endcomponent
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

