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
                          'titulo'=>'PRODUCTO'])
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
                @foreach($sopas as $sopa)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$sopa->id_sopa}}">

                        </td>
                        <td>
                            {{$sopa->id_control}}
                        </td>
                        <td>
                            @if($sopa->id_turno == 1)
                                TURNO 1
                            @else
                                TURNO 2
                            @endif

                        </td>
                        <td>
                            {{$sopa->presentacion}}
                        </td>
                        <td>
                            {{$sopa->fecha_hora->format('d/m/Y H:i:s')}}
                        </td>
                        <td>
                            {{$sopa->responsable}}
                        </td>
                        <td>
                            @if($sopa->estado == 1)
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

      $sopas->appends([
    'search' => $search,
    'sort'=>$sort,
    'field'=>$sortField
    ])->links()
    }}
</div>

