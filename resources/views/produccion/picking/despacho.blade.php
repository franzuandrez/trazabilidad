@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-arrow-circle-o-right',
    'submenu_icon'=>'fa fa-sign-in',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent


    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. REQUISICION</label>
            <input type="text"
                   readonly
                   name="orden_compra"
                   value="{{$requisicion->no_requision}}"
                   class="form-control">
        </div>
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
        <div class="table-responsive">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">

                <th>PRODUCTO</th>
                <th>LOTE</th>
                <th>CANTIDAD</th>
                <th>BODEGA</th>
                </thead>
                <tbody>
                @foreach( $requisicion->reservas as $reserva  )
                    <tr>
                        <td>
                            {{$reserva->producto->descripcion}}
                        </td>
                        <td>
                            {{$reserva->lote}}
                        </td>
                        <td>
                            {{$reserva->cantidad}}
                        </td>
                        <td>
                            {{$reserva->bodega->descripcion}}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('produccion/picking')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>



@endsection
@section('scripts')
    <script>
    @if($requisicion->reservas->isEmpty())

            $('.loading').show();
            setTimeout( function () {
                $('.loading').hide();
                window.location.reload();
            },1500)
    @endif
    </script>
@endsection

