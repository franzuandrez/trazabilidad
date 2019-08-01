
@component('componentes.search',['search'=>$search])
    @slot('modulo')
        users
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
                        @component('componentes.column-sort',['modulo'=>'users',
                     'sort'=>$sort,
                     'sortField'=>$sortField,
                     'field'=>'username',
                     'titulo'=>'Usuario'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                    'sort'=>$sort,
                    'sortField'=>$sortField,
                    'field'=>'nombre',
                    'titulo'=>'nombre'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'email',
                        'titulo'=>'email'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'rol',
                       'titulo'=>'rol'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                      'sort'=>$sort,
                      'sortField'=>$sortField,
                      'field'=>'estado',
                      'titulo'=>'estado'])
                        @endcomponent
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key =>$user)
                    <tr>
                        <td>
                            <input type="radio" name="id_user" value="{{$user->id}}">

                        </td>
                        <td>
                            {{$user->username}}
                        </td>
                        <td>
                            {{$user->nombre}}
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                        <td>
                            {{$user->rol}}
                        </td>
                        <td>
                            @if($user->estado == 1)
                                <span class="label label-success">
                                    Activo
                                </span>
                            @else
                                <span class="label label-danger">
                                    De baja
                                </span>
                            @endif
                        </td>
                        @component('componentes.alert-delete',
                                              ['model'=>'USUARIO',
                                              'id'=>$user->id,
                                              'method'=>'UserController@destroy',
                                              'extras'=>'',
                                              'description'=>$user->username])
                        @endcomponent
                    </tr>

                @endforeach


                </tbody>

            </table>

        </div>

    </div>

</div>
