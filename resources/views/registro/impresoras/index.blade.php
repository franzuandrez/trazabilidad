@component('componentes.search',
['search'=>$search,
    'sort'=>$sort,
    'sortField'=>$sortField,
'modulo'=>'registro/impresoras'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/impresoras',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id',
                          'titulo'=>'ID'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/impresoras',
                          'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'ip',
                          'titulo'=>'ip'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/impresoras',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'descripcion',
                        'titulo'=>'descripcion'])
                    @endcomponent
                </th>


                </thead>
                <tbody>
                @foreach($impresoras as $impresora)
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$impresora->id}}">

                        </td>
                        <td>
                            {{$impresora->id}}
                        </td>
                        <td>
                            {{$impresora->ip}}
                        </td>
                        <td>
                            {{$impresora->descripcion}}
                        </td>

                    </tr>
                    @component('componentes.alert-delete',
                                        ['model'=>'IMPRESORA',
                                        'id'=>$impresora->id,
                                        'method'=>'ImpresoraController@destroy',
                                        'extras'=>'',
                                        'description'=>$impresora->descripcion,
                                        'url'=>url('registro/impresoras/')."/".$impresora->id])
                    @endcomponent
                @endforeach

                </tbody>
            </table>
        </div>
        @include('componentes.pagination',['pagination'=>$impresoras])
    </div>
</div>

