@include('componentes.search')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @include('componentes.column-sort',[
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_control',
                          'titulo'=>'CONTROL '])

                </th>
                <th>
                    @include('componentes.column-sort',[
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'productos.descripcion',
                          'titulo'=>'PRODUCTO '])

                </th>
                <th>
                    @include('componentes.column-sort',[
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_turno',
                          'titulo'=>'turno'])

                </th>
                <th>
                    @include('componentes.column-sort',[
                           'sort'=>$sort,
                           'sortField'=>$sortField,
                           'field'=>'fecha',
                           'titulo'=>'Fecha'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                           'sort'=>$sort,
                           'sortField'=>$sortField,
                           'field'=>'users.nombre',
                           'titulo'=>'Responsable'])

                </th>

                </thead>
                <tbody>
                @foreach($formulario as $laminado)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$laminado->id_solucion_enc}}">

                        </td>
                        <td>
                            {{$laminado->id_control}}
                        </td>
                        <td>
                            {{$laminado->producto}}
                        </td>
                        <td>
                            Turno {{$laminado->id_turno}}
                        </td>
                        <td>
                            {{$laminado->fecha_hora}}
                        </td>
                        <td>
                            {{$laminado->usuario}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{

    $formulario->appends([
  'search' => $search,
  'sort'=>$sort,
  'field'=>$sortField
  ])->links()
  }}
</div>

