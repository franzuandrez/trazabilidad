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
                          'field'=>'control',
                          'titulo'=>'id_control'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_turno',
                          'titulo'=>'turno'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'usuario',
                          'titulo'=>'responsable'])

                </th>
                <th>
                    @include('componentes.column-sort',['modulo'=>'recepcion/materia_prima',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_hora',
                          'titulo'=>'FECHA '])

                </th>

                </thead>
                <tbody>
                @foreach($pesos as $peso)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$peso->id_peso_pasta_enc}}">

                        </td>
                        <td>
                            {{$peso->id_control}}
                        </td>
                        <td>
                            Turno {{$peso->id_turno}}
                        </td>
                        <td>
                            {{$peso->usuario}}
                        </td>
                        <td>
                            {{$peso->fecha_hora}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

