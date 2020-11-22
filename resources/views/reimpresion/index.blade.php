@include('componentes.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>

                    </th>
                    <th>
                        @include('componentes.column-sort',[
                              'field'=>'CODIGO_BARRAS',
                              'titulo'=>'CODIGO BARRAS'])
                    </th>
                    <th>
                        @include('componentes.column-sort',[
                             'field'=>'DESCRIPCION_PRODUCTO',
                             'titulo'=>'PRODUCTO'])
                    </th>
                    <th>
                        @include('componentes.column-sort',[
                             'field'=>'FECHA_VENCIMIENTO',
                             'titulo'=>'FECHA VENCIMIENTO'])
                    </th>
                    <th>
                        @include('componentes.column-sort',[
                             'field'=>'LOTE',
                             'titulo'=>'LOTE'])
                    </th>
                    <th>
                        @include('componentes.column-sort',[
                             'field'=>'COPIAS',
                             'titulo'=>'CANTIDAD'])
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($impresiones as $impresion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$impresion->CORRELATIVO}}">
                        </td>
                        <td>
                            {{$impresion->CODIGO_BARRAS}}
                        </td>
                        <td>
                            {{$impresion->DESCRIPCION_PRODUCTO}}
                        </td>
                        <td>
                            {{$impresion->FECHA_VENCIMIENTO!=null?$impresion->FECHA_VENCIMIENTO->format('d/m/Y'):''}}
                        </td>
                        <td>
                            {{$impresion->LOTE}}
                        </td>
                        <td>
                            {{$impresion->COPIAS}}
                        </td>
                        @include('reimpresion.modal-reimpresion',[
                            'id'=>$impresion->CORRELATIVO,
                            'codigo'=>'(01)'.$impresion->CODIGO_BARRAS.'(17)'.$impresion->FECHA_VENCIMIENTO->format('dmy').'(10)'.$impresion->LOTE,
                            'descripcion'=>$impresion->DESCRIPCION_PRODUCTO,
                            'cantidad'=>$impresion->COPIAS
                        ])

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$impresiones])
    </div>
</div>
