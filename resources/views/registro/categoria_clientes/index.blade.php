@component('componentes.search',
[
'search'=>$search,
 'sort'=>$sort,
 'sortField'=>$sortField,
'modulo'=>'registro/categoria_clientes'])
@endcomponent

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/categoria_clientes',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_categoria',
                          'titulo'=>'CODIGO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/categoria_clientes',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'DESCRIPCION'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/categoria_clientes',
                    'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'estado',
                         'titulo'=>'estado'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>
                            <input type="radio" name="id_categoria" value="{{$categoria->id_categoria}}">

                        </td>
                        <td>
                            {{$categoria->id_categoria}}
                        </td>
                        <td>
                            {{$categoria->descripcion}}
                        </td>
                        <td>
                            @if($categoria->estado == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">De baja</span>
                            @endif
                        </td>
                    </tr>
                    @component('componentes.alert-delete',
                                      ['model'=>'CATEGORIA CLIENTE',
                                      'id'=>$categoria->id_categoria,
                                      'method'=>'CategoriaClienteController@destroy',
                                      'extras'=>'',
                                      'description'=>$categoria->descripcion,
                                      'url'=>url('registro/categoria_clientes/')."/".$categoria->id_categoria])
                    @endcomponent
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
    {{
       $categorias->appends([
           'search' => $search,
           'sort'=>$sort,
           'field'=>$sortField
       ])->links()
    }}
</div>