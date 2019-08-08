@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-arrows-h',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Tipo Movimiento
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for=descripcion"">
                DESCRIPCION
            </label>
            <input type="text" name="descripcion" value="{{$tipoMovimiento->descripcion}}" readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="factor">SUMA INVENTARIO</label>
            <select name="factor" class="form-control selectpicker" disabled>
                @if( $tipoMovimiento->factor == 1 )
                    <option value="1" selected >SI</option>
                    <option value="-1">NO</option>
                @else
                    <option value="1" >SI</option>
                    <option value="-1" selected>NO</option>
                @endif
            </select>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/tipo_movimientos')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>



@endsection
