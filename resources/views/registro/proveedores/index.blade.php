<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>

                    </th>
                    <th>
                        RAZON SOCIAL
                    </th>
                    <th>
                        NOMBRE COMERCIAL
                    </th>
                    <th>
                        NIT
                    </th>
                    <th>
                        DIRECCION PLANTA
                    </th>
                    <th>
                        ESTADO
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($proveedores as $proveedor )

                    <tr>
                        <td>
                            <input type="radio" name="id_proveedor" value="{{$proveedor->id_proveedor}}" >
                        </td>
                        <td>
                            {{$proveedor->razon_social}}
                        </td>
                        <td>
                            {{$proveedor->nombre_comercial}}
                        </td>
                        <td>
                            {{$proveedor->nit}}
                        </td>
                        <td>
                            {{$proveedor->direccion_planta}}
                        </td>
                        <td>
                            @if($proveedor->estado == 1 )
                                <span class="label label-success"> Activo</span>
                            @else
                                <span class="label label-danger"> De baja</span>
                            @endif
                        </td>
                    </tr>


                @endforeach


                </tbody>

            </table>

        </div>
    </div>

</div>
