
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>
                    @component('componentes.column-sort',['modulo'=>'movimientos/bodegas',
                         'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'movimientos.ubicacion',
                          'titulo'=>'BODEGA'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'movimientos/bodegas',
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'producto',
                         'titulo'=>'PRODUCTO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'movimientos/bodegas',
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'lote',
                         'titulo'=>'LOTE'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'movimientos/bodegas',
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'total',
                         'titulo'=>'CANTIDAD'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            @if($producto->ubicacion == 0)
                                BODEGA TRANSITO
                            @else
                                {{$producto->bodega}}
                            @endif
                        </td>
                        <td>
                            {{$producto->producto}}
                        </td>
                        <td>
                            {{$producto->lote}}
                        </td>
                        <td>
                            {{$producto->total}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{
   $productos->appends([
       'search' => $search,
       'sort'=>$sort,
       'field'=>$sortField
   ])->links()
   }}
</div>

