@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
   'sortField'=>$sortField,
'modulo'=>'registro/proveedores'])

@endcomponent

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <tr>
                    <th>

                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                        'search'=>$search,
                           'sort'=>$sort,
                           'sortField'=>$sortField,
                           'field'=>'razon_social',
                           'titulo'=>'RAZON SOCIAL'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                        'search'=>$search,
                         'sort'=>$sort,
                         'sortField'=>$sortField,
                         'field'=>'nombre_comercial',
                         'titulo'=>'NOMBRE COMERCIAL'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                        'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'nit',
                       'titulo'=>'NIT'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                        'search'=>$search,
                     'sort'=>$sort,
                     'sortField'=>$sortField,
                     'field'=>'direccion_planta',
                     'titulo'=>'direccion planta'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                        'search'=>$search,
                      'sort'=>$sort,
                      'sortField'=>$sortField,
                      'field'=>'estado',
                      'titulo'=>'estado'])
                        @endcomponent
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
                    @component('componentes.alert-delete',
                      ['model'=>'PROVEEDOR',
                      'id'=>$proveedor->id_proveedor,
                      'method'=>'RoleController@destroy',
                      'extras'=>'',
                      'description'=>$proveedor->razon_social,
                      'url'=>url('registro/proveedores/')."/".$proveedor->id_proveedor])
                    @endcomponent

                @endforeach


                </tbody>

            </table>

        </div>
    </div>
{{  $proveedores->appends([
      'search' => $search,
      'sort'=>$sort,
      'field'=>$sortField
   ])->links()
   }}
</div>
