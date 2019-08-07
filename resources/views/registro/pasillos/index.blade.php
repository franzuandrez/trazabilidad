@component('componentes.search',
['search'=>$search,'modulo'=>'registro/pasillos'])
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
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'sector',
                        'titulo'=>'sector'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'encargado',
                        'titulo'=>'encargado'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/pasillos',
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


                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

