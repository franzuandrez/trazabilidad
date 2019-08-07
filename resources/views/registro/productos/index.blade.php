@component('componentes.search',
['search'=>$search,'modulo'=>'registro/productos'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'descripcion',
                          'titulo'=>'descripcion'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'dimensional',
                        'titulo'=>'dimensional'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/productos',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'presentacion',
                        'titulo'=>'presentacion'])
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
                            {{$producto->descripcion}}
                        </td>
                        <td>
                            {{$producto->dimensional}}
                        </td>
                        <td>
                            {{$producto->presentacion}}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

