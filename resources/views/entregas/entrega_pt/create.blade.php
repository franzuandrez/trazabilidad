@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Entrega',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-archive ',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Entrega PT
        @endslot
    @endcomponent
    @include('componentes.alert-error')
    {!!Form::open(array('url'=>'produccion/entrega_pt/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <input type="hidden" value="0" id="id_entrega">
    <input type="hidden" value="{{$control_trazabilidad->lote}}" id="lote">
    <input type="hidden" value="{{$control_trazabilidad->id_control}}" name="id_control" id="id_control">
    <input type="hidden" value="{{$control_trazabilidad->producto->codigo_dun}}" id="codigo_dun_14">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>PRODUCTO</th>
                        <td>{{$control_trazabilidad->producto->descripcion}}</td>
                    </tr>
                    <tr>
                        <th>LOTE</th>
                        <td>{{$control_trazabilidad->lote}}</td>
                    </tr>
                    <tr>
                        <th>FECHA VENCIMIENTO</th>
                        <td>{{$control_trazabilidad->fecha_vencimiento->format('d/m/Y')}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="no_tarima"> NO. TARIMA</label>
        <div class="input-group">
            <input id="no_tarima" type="text"
                   onkeydown="if(event.keyCode==13)buscar_no_tarima()"
                   class="form-control">
            <div class="input-group-btn">
                <button type="button"
                        onclick="buscar_no_tarima()"
                        class="btn btn-default"
                >
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
                <button type="button"
                        onclick="limpiar_tarima()"
                        class="btn btn-default"
                >
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
                <button type="button"
                        onclick="terminar_tarima()"
                        class="btn btn-default"
                >
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="codigo">CODIGO </label>
        <div class="input-group">
            <input type="text"
                   onkeydown="if(event.keyCode==13)buscar_producto()"
                   name="codigo"
                   id="codigo"
                   class="form-control">
            <div class="input-group-btn">
                <button type="button"
                        onclick="buscar_producto()"
                        class="btn btn-default"
                >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    <input id="id_producto" value="" type="hidden">
    <input id="id_control" value="" type="hidden">
    @include('componentes.loading')
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="unidad_medida">UNIDAD MEDIDA</label>
            <select name="unidad_medida"
                    class="form-control selectpicker"
                    id="unidad_medida"
            >
                <option value="CA">CAJA</option>
                <option value="UN">UNIDAD</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="cantidad"> CANTIDAD</label>
        <div class="input-group">
            <input type="text"
                   name="cantidad"
                   value="1"
                   onkeydown="if(event.keyCode==13)buscar_producto()"
                   id="cantidad"
                   class="form-control">
            <div class="input-group-btn">
                <button type="button"
                        onclick="buscar_producto()"
                        class="btn btn-default"
                >
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>


    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color: #01579B;  color: #fff;">

            <tr>
                <th>
                    SSCC
                </th>
                <th>
                    UNIDAD MEDIDA
                </th>
                <th>
                    CANTIDAD
                </th>
                <th>NO. TARIMA</th>
            </tr>
            </thead>
            <tbody id="detalle">

            @foreach($entregas->groupBy('no_tarima') as  $key=> $tarima)
                @foreach($tarima as $correlativo=>$entrega)
                    <tr id="{{'tarima-'.$entrega->no_tarima.'-'.$loop->iteration}}">
                        @if ($loop->first)

                            <td rowspan="1">{{$entrega->sscc}}</td>
                            <td rowspan="1">{{$entrega->unidad_medida}}</td>
                            <td rowspan="1">{{$entrega->cantidad}}</td>
                            <td
                                id="tarima-{{$entrega->no_tarima}}"
                                rowspan="{{$tarima->count()}}"
                            >{{$entrega->no_tarima}}
                                @if($entrega->estado_tarima=='CREADO')
                                    <label class="label label-warning">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </label>
                                @elseif($entrega->estado_tarima=='USO')
                                    <label class="label label-warning">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </label>
                                @else
                                    <label class="label label-success">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </label>
                                @endif
                            </td>

                        @else
                            <td rowspan="1">{{$entrega->sscc}}</td>
                            <td rowspan="1">{{$entrega->unidad_medida}}</td>
                            <td rowspan="1">{{$entrega->cantidad}}</td>
                        @endif
                    </tr>
                @endforeach

            @endforeach

            </tbody>
        </table>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('produccion/entrega_pt')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>
    {!!Form::close()!!}

@endsection

@section('scripts')
    @include('entregas.entrega_pt.script')
@endsection

