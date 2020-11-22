@include('componentes.search')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color: #f7b633;  color: #fff;">
                <th>

                </th>
                <th>
                    @include('componentes.column-sort',[
                        'field'=>'entrega_pt_enc.id',
                        'titulo'=>'Entrega'])
                </th>

                <th>
                    @include('componentes.column-sort',[
                         'field'=>'nombre',
                         'titulo'=>'Responsable'])
                </th>
                <th>
                    @include('componentes.column-sort',[
                       'field'=>'fecha_hora',
                       'titulo'=>'fecha'])
                </th>
                <th>
                    @include('componentes.column-sort',[
                       'field'=>'entrega_pt_enc.estado',
                       'titulo'=>'estado'])
                </th>

                </thead>
                <tbody>

                @foreach( $collection as $item )
                    <tr>
                        <td>
                            <input type="radio" name="id_item" value="{{$item->id}}">
                        </td>
                        <td>{{$item->id}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->fecha_hora->format('H:i:s d/m/Y')}}</td>
                        <td>
                            @if($item->estado==0)
                                <label class="label label-warning"> PENDIENTE </label>
                            @elseif($item->estado==1)
                                <label class="label label-info"> PROCESANDO </label>
                            @else
                                <label class="label label-primary"> ENTREGADO </label>
                            @endif
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>

</div>

