@include('componentes.search',
['search'=>$search,'modulo'=>'recepcion/materia_prima'])

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_control',
                          'titulo'=>'CONTROL'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'productos.descripcion',
                          'titulo'=>'producto'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'turno',
                          'titulo'=>'turno'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_ingreso',
                          'titulo'=>'Fecha'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'users.nombre',
                          'titulo'=>'responsable'])

                </th>

                </thead>
                <tbody>
                @foreach($secos as $seco)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$seco->id_peso_seco}}">

                        </td>
                        <td>
                            {{$seco->id_control}}
                        </td>
                        <td>
                            {{$seco->producto}}
                        </td>
                        <td>
                            Turno {{$seco->turno}}
                        </td>
                        <td>
                            {{$seco->fecha_ingreso}}
                        </td>
                        <td>
                            {{$seco->usuario}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{

        $secos->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
      ])->links()
      }}
</div>

