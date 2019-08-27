@component('componentes.search',
['search'=>$search,
  'sort'=>$sort,
 'sortField'=>$sortField,
'modulo'=>'registro/sectores'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/chaomin',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'no_orden_produccion',
                          'titulo'=>'NO ORDEN'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_turno',
                          'titulo'=>'TURNO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_presentacion',
                          'titulo'=>'PRESENTACION'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha',
                          'titulo'=>'FECHA'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'registro/sectores',
                    'search'=>$search,
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'responsable',
                          'titulo'=>'RESPONSABLE'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($lineas as $linea)
                    <tr>
                        <td>
                            <input type="radio" name="id_chaomin" value="{{$linea->id_chaomin}}">

                        </td>
                        <td>
                            {{$linea->no_orden_produccion}}
                        </td>
                        <td>
                            {{$linea->id_turno}}
                        </td>
                        <td>
                            {{$linea->id_presentacion}}
                        </td>
                        <td>
                            {{$linea->fecha}}
                        </td>
                        <td>
                            {{$linea->responsable}}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{

      $lineas->appends([
    'search' => $search,
    'sort'=>$sort,
    'field'=>$sortField
    ])->links()
    }}
</div>



{{--
@component('componentes.search',
['search'=>$search,'modulo'=>'control/mezcla_harina'])
@endcomponent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #01579B;  color: #fff;">
                <th>

                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/mezcla_harina',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'orden_compra',
                          'titulo'=>'ORDEN DE COMPRAS'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/mezcla_harina',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'id_responsable_maquina',
                          'titulo'=>'RESPONSABLE'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/mezcla_harina',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'fecha_hora',
                          'titulo'=>'FECHA INGRESO'])
                    @endcomponent
                </th>
                <th>
                    @component('componentes.column-sort',['modulo'=>'control/mezcla_harina',
                          'sort'=>$sort,
                          'sortField'=>$sortField,
                          'field'=>'observaciones',
                          'titulo'=>'OBSERVACIONES'])
                    @endcomponent
                </th>
                </thead>
                <tbody>
                @foreach($lineas as $mezclaharina)
                    <tr>
                        <td>
                            <input type="radio" name="id_recepcion_enc" value="{{$mezclaharina->id_Enc_mezclaharina}}">
                        </td>
                        <td>
                            {{$mezclaharina->no_orden}}
                        </td>
                        <td>
                            {{$mezclaharina->id_responsable_maquina}}
                        </td>
                        <td>
                            {{$mezclaharina->fecha_hora}}
                        </td>
                        <td>
                            {{$mezclaharina->observaciones}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    {{

      $lineas->appends([
    'search' => $search,
    'sort'=>$sort,
    'field'=>$sortField
    ])->links()
    }}
</div> --}}


