@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
  'sortField'=>$sortField,
'modulo'=>'recepcion/materia_prima'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_control',
                          'titulo'=>'CONTROL'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'productos.descripcion',
                          'titulo'=>'producto'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_turno',
                          'titulo'=>'turno'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'usuario',
                          'titulo'=>'REsponsable'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_hora',
                          'titulo'=>'FEcha'])
                    @endcomponent
                </th>


                </thead>
                <tbody>
                @foreach($sopas as $sopa)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$sopa->id_mezclado}}">

                        </td>
                        <td>
                            {{$sopa->id_control}}
                        </td>
                        <td>
                            {{$sopa->producto}}
                        </td>
                        <td>
                            Turno {{$sopa->id_turno}}
                        </td>
                        <td>
                            {{$sopa->usuario}}
                        </td>
                        <td>
                            {{$sopa->fecha_hora}}
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

