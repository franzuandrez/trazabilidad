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
                          'titulo'=>'control'])
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
                          'titulo'=>'responsable'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_hora',
                          'titulo'=>'FECHA '])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($frituras as $fritura)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$fritura->id_frutura_sopas_enc}}">

                        </td>
                        <td>
                            {{$fritura->id_control}}
                        </td>
                        <td>
                            {{$fritura->producto}}
                        </td>
                        <td>
                            Turno {{$fritura->id_turno}}
                        </td>
                        <td>
                            {{$fritura->usuario}}
                        </td>
                        <td>
                            {{$fritura->fecha_hora}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{
  $frituras->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
  ])->links()
  }}
</div>

