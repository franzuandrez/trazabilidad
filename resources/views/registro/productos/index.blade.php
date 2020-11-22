@component('componentes.search',
['search'=>$search,
          'sort'=>$sort,
          'sortField'=>$sortField,
'modulo'=>'registro/productos'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'Codigo Barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                           'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                     'field'=>'codigo_interno',
                     'titulo'=>'Codigo Interno'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'Descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                        'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'tipo_producto',
                          'titulo'=>'Tipo producto'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            <input type="radio" name="id_producto" value="{{$producto->id_producto}}">

                        </td>
                        <td>
                            {{$producto->codigo_barras}}
                        </td>
                        <td>
                            {{$producto->codigo_interno}}
                        </td>
                        <td>
                            {{$producto->descripcion}}
                        </td>
                        <td>
                            {{$tipos_productos[$producto->tipo_producto]}}

                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$productos])
    </div>
</div>

