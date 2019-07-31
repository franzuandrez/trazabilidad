
@component('componentes.search',['search'=>$search])
    @slot('modulo')
        roles
    @endslot
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
                        @component('componentes.column-sort',['modulo'=>'roles',
                     'sort'=>$sort,
                     'sortField'=>$sortField,
                     'field'=>'name',
                     'titulo'=>'Nombre'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'roles',
                    'sort'=>$sort,
                    'sortField'=>$sortField,
                    'field'=>'descripcion',
                    'titulo'=>'descripcion'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'roles',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'estado',
                        'titulo'=>'estado'])
                        @endcomponent
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach($roles as $key => $rol)
                <tr>
                    <td>{{$rol->name}}</td>
                    <td>{{$rol->descripcion}}</td>
                    <td>
                    @if($rol->estado == 1)
                        <span class="label label-success">Activo</span>
                    @else
                         <span class="label label-danger">De baja</span>
                     @endif
                    </td>
                </tr>
                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
