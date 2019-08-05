@component('componentes.search',
['search'=>$search,'modulo'=>'registro/clientes'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/clientes',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'razon_social',
                          'titulo'=>'RAZON SOCIAL'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/clientes',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'nit',
                          'titulo'=>'NIT'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/clientes',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'direccion',
                          'titulo'=>'direccion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/clientes',
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'estado',
                         'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>
                            <input type="radio" name="id_cliente" value="{{$cliente->id_cliente}}">

                        </td>
                        <td>
                            {{$cliente->razon_social}}
                        </td>
                        <td>
                            {{$cliente->nit}}
                        </td>
                        <td>
                            {{$cliente->direccion}}
                        </td>
                        <td>
                            @if($cliente->estado == 1)
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

