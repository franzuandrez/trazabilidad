<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Producto</th>
            <td>
            {{$producto_trazabilidad->producto->codigo_interno}}
            </td>
            <th>
                Tipo Producto
            </th>
            <td>
                {{$producto_trazabilidad->producto->tipo_producto}}
            </td>
        </tr>
        <tr>
            <th>
                Lote
            </th>
            <td>
                {{$producto_trazabilidad->lote}}
            </td>
            <th>
                Best By
            </th>
            <td>
                {{$producto_trazabilidad->fecha_vencimiento->format('d/m/Y')}}
            </td>
        </tbody>
    </table>
</div>
