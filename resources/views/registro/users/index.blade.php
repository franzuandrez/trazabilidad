@component('componentes.search',[
'search'=>$search,
  'sort'=>$sort,
  'sortField'=>$sortField,
])
    @slot('modulo')
        users
    @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

        <div class="table-responsive">

            <table class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #f7b633;  color: #fff;">
                <tr>
                    <th>

                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                         'search'=>$search,
                     'sort'=>$sort,
                     'sortField'=>$sortField,
                     'field'=>'username',
                     'titulo'=>'Usuario'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                        'search'=>$search,
                    'sort'=>$sort,
                    'sortField'=>$sortField,
                    'field'=>'nombre',
                    'titulo'=>'Nombre'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                        'search'=>$search,
                        'sort'=>$sort,
                        'sortField'=>$sortField,
                        'field'=>'email',
                        'titulo'=>'email'])
                        @endcomponent
                    </th>
                    <th>
                        @component('componentes.column-sort',['modulo'=>'users',
                        'search'=>$search,
                       'sort'=>$sort,
                       'sortField'=>$sortField,
                       'field'=>'rol',
                       'titulo'=>'rol'])
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

                        @component('componentes.alert-delete',
                                              ['model'=>'USUARIO',
                                              'id'=>$user->id,
                                              'method'=>'UserController@destroy',
                                              'extras'=>'',
                                              'description'=>$user->username,
                                              'url'=>url('users')."/".$user->id])
                        @endcomponent
                    </tr>

                @endforeach


                </tbody>

            </table>

        </div>
        @include('componentes.pagination',['pagination'=>$users])
    </div>
</div>
