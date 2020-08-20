<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    <table class="table table-bordered table-responsive">
        <thead style="background-color: #01579B;  color: #fff;">
        <tr>
            <th>MP</th>
            <th>COLOR</th>
            <th>OLOR</th>
            <th>IMPRESION</th>
            <th>AUSENCIA M.E.</th>
            <th>NO LOTE</th>
            <th>CANTIDAD</th>
            <th>FECHA VENC.</th>
        </tr>
        </thead>
        <tbody id="tbody_insumos">
        @isset($control)
            @foreach($control->detalle_insumos as $insumo)
                <tr>
                    <td>
                        <input
                            type="hidden"
                            name="id_insumo[]"
                               value="{{$insumo->id_detalle_insumo}}">
                        {{$insumo->producto->descripcion}}
                    </td>
                    <td>
                        @if($insumo->color==1)
                            <input type="hidden" name="color[]" value="1">
                            <input type="checkbox"  checked  onclick="return false">
                        @else
                            <input type="hidden" name="color[]" value="0">
                            <input type="checkbox" onclick="asignar(this)"   >
                        @endif
                    </td>
                    <td>
                        @if($insumo->olor==1)
                            <input type="hidden" name="olor[]" value="1">
                            <input type="checkbox" checked  onclick="return false">
                        @else
                            <input type="hidden" name="olor[]" value="0">
                            <input type="checkbox" onclick="asignar(this)"   >
                        @endif
                    </td>
                    <td>
                        @if($insumo->impresion==1)
                            <input type="hidden" name="impresion[]" value="1">
                            <input type="checkbox" checked  onclick="return false">
                        @else
                            <input type="hidden" name="impresion[]" value="0">
                            <input type="checkbox" onclick="asignar(this)"   >
                        @endif
                    </td>
                    <td>
                        @if($insumo->ausencia_material_extranio==1)
                            <input type="hidden" name="ausencia_me[]" value="1">
                            <input type="checkbox" checked  onclick="return false">
                        @else
                            <input type="hidden" name="ausencia_me[]" value="0">
                            <input type="checkbox" onclick="asignar(this)"   >
                        @endif
                    </td>
                    <td>
                        {{$insumo->lote}}
                    </td>
                    <td>
                        {{$insumo->cantidad}}
                    </td>
                    <td>
                        {{$insumo->fecha_vencimiento->format('d/m/Y')}}
                    </td>

                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
</div>
