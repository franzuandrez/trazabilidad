@include('componentes.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',[
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'ubicaciones.codigo_barras',
                          'titulo'=>'codigo barras'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'localidad',
                          'titulo'=>'localidad'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                    'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'bodega',
                        'titulo'=>'bodega'])
                    @endcomponent
                </th>

                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'sectores.descripcion',
                       'titulo'=>'SECTOR'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'pasillos.descripcion',
                       'titulo'=>'PASILLO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'racks.descripcion',
                       'titulo'=>'RACK'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'nivel.descripcion',
                       'titulo'=>'NIVEL'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'posiciones.descripcion',
                       'titulo'=>'POSICION'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',[
                   'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'bines.descripcion',
                       'titulo'=>'BIN'])
                    @endcomponent
                </th>

                </thead>
                <tbody>
                @foreach($ubicaciones as $ubicacion)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$ubicacion->id_ubicacion}}">

                        </td>
                        <td>

                        {{$ubicacion->codigo_barras}}

                        </td>
                        <td>
                            {{$ubicacion->localidad}}
                        </td>
                        <td>
                            {{$ubicacion->bodega}}
                        </td>
                        <td>
                            {{$ubicacion->sector->descripcion}}
                        </td>
                        <td>
                            {{$ubicacion->pasillo->descripcion}}
                        </td>
                        <td>
                            {{$ubicacion->rack->descripcion}}
                        </td>
                        <td>
                            {{$ubicacion->nivel->descripcion}}
                        </td>
                        <td>
                            {{$ubicacion->posicion->descripcion}}
                        </td>
                        <td>
                            {{$ubicacion->bin->descripcion}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('componentes.pagination',['pagination'=>$ubicaciones])
</div>

