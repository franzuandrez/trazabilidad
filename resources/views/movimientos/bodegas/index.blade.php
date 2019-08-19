
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">

                <th>
                    BODEGA
                </th>
                <th>
                    PRODUCTO
                </th>
                <th>
                    LOTE
                </th>
                <th>
                    CANTIDAD
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
       'id_bodega'=>$id_bodega
   ])->links()
   }}
</div>

