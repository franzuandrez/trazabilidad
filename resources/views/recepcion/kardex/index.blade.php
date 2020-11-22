<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>
                    @include('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'codigo_interno',
                         'titulo'=>'CODIGO INTERNO'])

                </th>
                <th>
                    @include('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'producto',
                         'titulo'=>'PRODUCTO'])

                </th>


                <th>
                    @include('recepcion.kardex.sort',[
                        'filtro' => $filtro,
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'ubicacion',
                          'titulo'=>'UBICACION'])

                </th>

                <th>
                    @include('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'lote',
                         'titulo'=>'LOTE'])

                </th>



                <th>
                    @include('recepcion.kardex.sort',[
                        'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'total',
                         'titulo'=>'EXISTENCIA'])

                </th>
                <th>
                    @include('recepcion.kardex.sort',[
                    'filtro' => $filtro,
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'unidad_medida',
                         'titulo'=>'MEDIDA'])

                </th>
                </thead>
                <tbody>
                @forelse ($productos as $producto)
                    <tr>
                        <td>
                            {{$producto->codigo_interno}}
                        </td>
                        <td>
                            {{$producto->producto}}
                        </td>
                        <td>
                            @if($producto->id_bodega == 0)
                                {{$producto->bodega}}
                            @else
                                {{$producto->ubicacion}}
                            @endif
                        </td>
                        <td>
                            {{$producto->lote}}
                        </td>


                        <td>
                            {{number_format($producto->total,3   ,'.',',')}}

                        </td>

                        <td>
                            {{$producto->unidad_medida}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td align="center" colspan="4"><strong> <i class="fa fa-meh-o"></i> SIN RESULTADOS</strong></td>
                    </tr>
                @endforelse
                </tbody>
            </table>


        </div>
    </div>

</div>

<script>
    function generar(url) {

        let search = "<?php echo $search; ?>";
        let sort = "<?php echo $sort; ?>";
        let sortField = "<?php echo $sortField; ?>";


        url += "&";
        url += "search=" + search + "&";
        url += "sort=" + sort + "&";
        url += "sortField=" + sortField + "&";


        window.location.href = url

    }

</script>

