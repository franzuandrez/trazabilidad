@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-arrows-h',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Tipo Movimiento
        @endslot
    @endcomponent

    @include('componentes.alert-error')
    {!!Form::model($tipoMovimiento,['method'=>'PATCH','route'=>['tipo_movimientos.update',$tipoMovimiento->id_movimiento]])!!}
    {{Form::token()}}
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=descripcion"">
                DESCRIPCION
            </label>
            <input type="text" name="descripcion" value="{{$tipoMovimiento->descripcion}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="factor">SUMA INVENTARIO</label>
            <select name="factor"
                    required
                    class="form-control selectpicker">
                @if( $tipoMovimiento->factor == 1 )
                    <option value="1" selected>SI</option>
                    <option value="-1">NO</option>
                @else
                    <option value="1">SI</option>
                    <option value="-1" selected>NO</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/tipo_movimientos')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>

    {!!Form::close()!!}

@endsection
