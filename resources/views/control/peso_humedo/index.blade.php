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
                          'field'=>'no_orden',
                          'titulo'=>'no. orden produccion'])

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
                @foreach($humedos as $humedo)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$humedo->id_peso_humedo}}">

                        </td>
                        <td>
                            {{$humedo->no_orden}}
                        </td>
                        <td>
                            Turno {{$humedo->turno}}
                        </td>
                        <td>
                            {{$humedo->fecha_ingreso}}
                        </td>
                        <td>
                            {{$humedo->usuario}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{

        $humedos->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
      ])->links()
      }}
</div>

