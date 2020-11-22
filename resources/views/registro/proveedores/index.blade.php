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
                        @component('componentes.column-sort',[
                           'search'=>$search,
                           'sort'=>$sort,
                           'sortField'=>$sortField,
                           'field'=>'codigo_proveedor',
                           'titulo'=>'Codigo'])
                        @endcomponent
                    </th>

                    <th>
                        @component('componentes.column-sort',['modulo'=>'registro/proveedores',
                       'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'razon_social',
                          'titulo'=>'Razon Social'])
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
                     'titulo'=>'Direccion Planta'])
                        @endcomponent
                    </th>

                </tr>
                </thead>
                <tbody>

                @foreach($proveedores as $proveedor )

                    <tr>
                        <td>
                            <input type="radio" name="id_proveedor" value="{{$proveedor->id_proveedor}}">
                        </td>
                        <td>
                            {{$proveedor->codigo_proveedor}}
                        </td>


                        <td>
                            {{$proveedor->razon_social}}
                        </td>

                        <td>
                            {{$proveedor->nit}}
                        </td>
                        <td>
                            {{$proveedor->direccion_planta}}
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
        @include('componentes.pagination',['pagination'=>$proveedores])
    </div>

</div>
