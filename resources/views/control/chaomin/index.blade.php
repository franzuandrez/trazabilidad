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
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_control',
                          'titulo'=>'CONTROL'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_turno',
                          'titulo'=>'TURNO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_presentacion',
                          'titulo'=>'PRESENTACION'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha',
                          'titulo'=>'FECHA'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'responsable',
                          'titulo'=>'RESPONSABLE'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'Estado',
                          'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($lineas as $linea)
                    <tr>
                        <td>
                            <input type="radio" name="id_chaomin" value="{{$linea->id_chaomin}}">

                        </td>
                        <td>
                            {{$linea->id_control}}
                        </td>
                        <td>
                            @if($linea->id_turno == 1)
                                TURNO 1
                            @else
                                TURNO 2
                            @endif

                        </td>
                        <td>
                            {{$linea->presentacion}}
                        </td>
                        <td>
                            {{$linea->fecha->format('d/m/Y H:i:s')}}
                        </td>
                        <td>
                            {{$linea->responsable}}
                        </td>
                        <td>
                            @if($linea->estado == 1)
                                <span  class="label label-success">  Liberada</span>
                            @else
                                <span  class="label label-warning"> En proceso</span>
                            @endif

                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{

      $lineas->appends([
    'search' => $search,
    'sort'=>$sort,
    'field'=>$sortField
    ])->links()
    }}
</div>

