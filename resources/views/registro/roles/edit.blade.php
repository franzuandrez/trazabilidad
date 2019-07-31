@extends('layouts.admin')


@section('contenido')

    <div class="panel-body">
        {!!Form::model($role,['method'=>'PATCH','route'=>['roles.update',$role->id]])!!}
        {{Form::token()}}
        <div class="row">
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="nombre">NOMBRE</label>
                    <input type="text" name="name" value="{{$role->name}}"  class="form-control" >
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                <div class="form-group">
                    <label for="nombre">DESCRIPCION</label>
                    <input type="text" name="descripcion" value="{{$role->descripcion}}"  class="form-control" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class=" table table-striped table-bordered table-condensed table-hover  ">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <th   style="width: 50px" ></th>
                        <th   style="width: 50px"></th>
                        <th >MENU</th>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>

                                    <input type="checkbox"  value="{{$menu->id}}" <?php  if(in_array($menu->id,$rolePermissions))echo'checked' ?> name="permission[]" onchange="javascript:habilitarOpciones(this)" id="input-{{$menu->id}}">


                                </td>
                                <td ><button type="button"  id="btn-{{$menu->id}}" class="btn btn-default btn-xs collapsed" data-toggle="collapse" data-target="#opciones-{{ $menu->id}}" ><span class="fa fa-sort-desc"></span></button> </td>
                                <td><i class="fa {{$menu->icon}}" ></i>  {{$menu->display_name}}</td>

                            </tr>
                            <tr>
                                <td colspan="3" class="hiddenRow">
                                    <div class="accordian-body collapse" id="opciones-{{ $menu->id}}">
                                        <table class="table table-striped table-condensed ">
                                            <thead>
                                            <tr>
                                                <th>
                                                </th>
                                                <th>

                                                    Opcion
                                                </th>
                                            </tr>

                                            </thead>
                                            <tbody >
                                            @foreach ($opciones as $opcion)
                                                @if($opcion->id_menu == $menu->orden_menu)
                                                    <tr>

                                                        <td class="filterable-cell"><input    type="checkbox" value="{{$opcion->id}}" <?php  if(in_array($opcion->id,$rolePermissions))echo'checked'?> name="permission[]"></td>

                                                        <td class="filterable-cell"><i class ="fa {{$opcion->icon}}"></i> {{ $opcion->display_name}}</td>
                                                    <tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-default" type="submit" ><span class=" fa fa-check"></span> GUARDAR</button>
                <a href="{{ route('roles.index') }}"><button class="btn btn-default" type="button" ><span class="  fa fa-remove"></span> CANCELAR</button></a>
            </div>
        </div>
    </div>
    {!!Form::close()!!}
@endsection
@section('scripts')
    <script src="{{asset('js-brc/roles/create.js')}}"></script>
@endsection
