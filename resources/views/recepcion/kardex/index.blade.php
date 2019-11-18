
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>
                    @component('recepcion.kardex.sort',[
                        'filtro' => $filtro,
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'bodega',
                          'titulo'=>'BODEGA'])
                    @endcomponent
                </th>
                <th>
                    @component('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'producto',
                         'titulo'=>'PRODUCTO'])
                    @endcomponent
                </th>
                <th>
                    @component('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'lote',
                         'titulo'=>'LOTE'])
                    @endcomponent
                </th>
                <th>
                    @component('recepcion.kardex.sort',[
                        'filtro' => $filtro,
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
                            @if($producto->id_bodega == 0)
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

</div>

<script>
    function generar(url) {

        let  search = "<?php echo $search; ?>";
        let  sort = "<?php echo $sort; ?>";
        let  sortField = "<?php echo $sortField; ?>";


        url += "&";
        url += "search="+search+"&";
        url += "sort="+sort+"&";
        url += "sortField="+sortField+"&";


        window.location.href = url

    }

</script>

