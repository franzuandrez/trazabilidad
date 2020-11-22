@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-cart-plus',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Despacho
        @endslot
    @endcomponent

    <form method="post" action="{{route('produccion.picking.store')}}">
        @csrf
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="orden_compra">NO. FACTURA</label>
                <input type="text"
                       readonly
                       name="no_requisicion"
                       value="{{$requisicion->no_requision}}"
                       class="form-control">
            </div>
        </div>


        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 ">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #f7b633;  color: #fff">
                    <th></th>
                    <th>Descripcion</th>
                    <th>No. Lote</th>
                    <th>Cantidad</th>
                    <th>UBICACION</th>
                    </thead>
                    <tbody>

                    @if($requisicion->estado=="D")
                        @foreach($productos as $product)
                            @foreach( $requisicion->reservas->where('id_producto',$product) as $reserva  )
                                <tr id="{{$reserva->id_producto}}-{{$reserva->lote}}-{{$reserva->ubicacion}}">
                                    <td>
                                        @if($reserva->leido == 'N')
                                            <span class="label label-warning"
                                                  id="span-{{$reserva->id_reserva}}"
                                                  data-html="true"
                                                  title="
                                      <strong>Estado :</strong> Pendiente
                                                "
                                                  data-toggle="tooltip">
                                 <i class="fa fa-exclamation" aria-hidden="true"></i>
                                </span>
                                        @else
                                            <span class="label label-success"
                                                  data-html="true"
                                                  title="
                                      <strong>Estado :</strong> Leido<br>
                                      <strong>Por : </strong>{{$reserva->usuario_picking->nombre}}<br>
                                      <strong>Fecha : </strong>{{$reserva->fecha_lectura->format('d/m/Y')}}<br>
                                      <strong>Hora: </strong>{{$reserva->fecha_lectura->format('H:i:s')}}
                                                      "
                                                  data-toggle="tooltip">
                                 <i class="fa fa-check" aria-hidden="true"></i>
                                </span>
                                        @endif
                                        <input type="hidden" name="id_reserva[]" value="{{$reserva->id_reserva}}">
                                        <input type="hidden" name="leido[]" value="{{$reserva->leido}}">
                                    </td>
                                    <td>
                                        <input type="hidden" name="id_producto[]"
                                               value="{{$reserva->producto->id_producto}}">
                                        {{$reserva->producto->descripcion}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="lote[]" value="{{$reserva->lote}}">
                                        {{$reserva->lote}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="cantidad[]" value="{{$reserva->cantidad}}">
                                        {{$reserva->cantidad}}
                                    </td>
                                    <td>
                                        <input type="hidden" name="ubicacion[]" value="{{$reserva->ubicacion}}">
                                        {{$reserva->ubicacion}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>TOTAL</b></td>
                                <td colspan="2">
                                    <b>
                                        {{
                                            number_format($requisicion->reservas->where('id_producto',$product)->sum('cantidad'),2,'.',',')
                                        }}
                                    </b>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" align="center">
                                <b>-- PENDIENTE --</b>
                            </td>
                        </tr>
                    @endif


                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <a href="{{url('produccion/despacho')}}">
                    <button class="btn btn-primary" type="button">
                        <span class="fa fa-backward"></span>
                    Regresar
                    </button>
                </a>
            </div>
        </div>

    </form>
@endsection


