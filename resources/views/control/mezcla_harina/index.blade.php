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
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'productos.descripcion',
                          'titulo'=>'PRODUCTO'])
                    @endcomponent
                </th>


                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_hora',
                          'titulo'=>'FECHA'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'users.nombre',
                          'titulo'=>'RESPONSABLE'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($lineas as $linea)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$linea->id_Enc_mezclaharina}}">
                        </td>
                        <td>
                            {{$linea->id_control}}
                        </td>
                        <td>
                            {{$linea->producto}}
                        </td>

                        <td>
                            {{$linea->fecha_hora}}
                        </td>
                        <td>
                            {{$linea->usuario}}
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




