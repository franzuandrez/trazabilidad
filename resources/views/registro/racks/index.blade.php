@component('componentes.search',
['search'=>$search,'modulo'=>'registro/racks'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/racks',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/racks',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/racks',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'pasillo',
                        'titulo'=>'pasillo'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/racks',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($racks as $rack)
                    <tr>
                        <td>
                            <input type="radio" name="id_rack" value="{{$rack->id_rack}}">

                        </td>
                        <td>
                            {{$rack->codigo_barras}}
                        </td>
                        <td>
                            {{$rack->descripcion}}
                        </td>
                        <td>
                            {{$rack->pasillo}}
                        </td>
                        <td>
                            @if($rack->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

