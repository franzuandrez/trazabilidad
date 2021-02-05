@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <style>
        .ocultar {
            visibility: hidden;
        }

        .mostrar {
            visibility: visible;
        }
    </style>
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>CONTROL DE TRAZABILIDAD</h3>
    </div>
    @component('componentes.nav',['operation'=>'Finalizar',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>'fa fa-list-alt ',
    'operation_icon'=>'fa-check',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Control Trazabilidad
        @endslot
    @endcomponent

    {!!Form::open(array('url'=>'produccion/trazabilidad_chao_mein/finalizar/'.$control->id_control,'method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <input type="hidden" name="id_producto" id="id_producto" value="{{$control->id_producto}}">
    <input type="hidden" name="id_control" id="id_control" value="{{$control->id_control}}">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   name="producto"
                   readonly
                   value="{{$control->producto->descripcion}}"
                   id="producto"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-2 col-md-2 col-xs-6">
        <div class="form-group">
            <label for="unidad_medida">U.MEDIDA</label>
            <input type="text"
                   name="unidad_medida"
                   readonly
                   value="{{$control->producto->unidad_medida}}"
                   id="unidad_medida"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-6">
        <div class="form-group">
            <label for="best_by">BEST BY</label>
            <input type="text"
                   name="best_by"
                   readonly
                   value="{{$control->fecha_vencimiento->format('d/m/Y')}}"
                   id="best_by"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ordenes">ORDENES</label>
            <input type="text"
                   name="ordenes"
                   id="ordenes"
                   value="{{
                   substr_replace(
                           $control->requisiciones->reduce(function($carry,$item){
                                return $item->no_orden_produccion.",".$carry;
                           }),"",-1
                       )
                   }}"
                   readonly
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="lote_pt">LOTE</label>
            <input type="text"
                   name="lote_produccion"
                   id="lote_produccion"
                   value="{{$control->lote}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text"
                   name="turno"
                   id="turno"
                   readonly
                   value="{{$control->id_turno}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_programada">CANTIDAD PROGRAMADA</label>
            <input type="text"
                   name="cantidad_programada"
                   id="cantidad_programada"
                   value="{{$control->cantidad_programada}}"
                   readonly
                   class="form-control">
        </div>
    </div>

    @if($control->producto->tipo_producto == 'PT')
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="cantidad_produccion">CANTIDAD PRODUCCION</label>
            <div class="input-group">
                <input type="text"
                       name="cantidad_produccion"
                       id="cantidad_produccion"
                       readonly
                       {{$control->cantidad_producida !=null && $control->cantidad_producida !="" ? 'disabled':''}}
                       value="{{$control->cantidad_producida==null?0:$control->cantidad_producida }}"
                       class="form-control">
                <div class="input-group-btn">
                    <button
                        onclick="modal_entregas_parciales()"
                        type="button" class="btn btn-default">
                        <i class="fa fa-plus"

                           aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        @include('produccion.control_trazabilidad.entregas_parciales')
    @else
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_produccion">CANTIDAD PRODUCCION</label>
                <input type="text"
                       name="cantidad_produccion"
                       id="cantidad_produccion"
                       {{$control->cantidad_producida !=null && $control->cantidad_producida !="" ? 'disabled':''}}
                       value="{{$control->cantidad_producida }}"
                       class="form-control">
            </div>
        </div>
    @endif
    @if($control->producto->tipo_producto == 'PT')
        <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_etiquetas_corrugado">UNIDAD DE DISTRIBUCION</label>
                <input type="text"
                       name="cantidad_etiquetas_corrugado"
                       id="cantidad_etiquetas_corrugado"
                       readonly
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="cantidad_etiquetas_unidades">UNIDADES S/ETIQUETA</label>
                <input type="text"
                       name="cantidad_etiquetas_unidades"
                       id="cantidad_etiquetas_unidades"
                       readonly
                       class="form-control">
            </div>
        </div>
    @endif

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#insumos" data-toggle="tab" aria-expanded="false">
                    INSUMOS
                </a>
            </li>
            <li class="">
                <a href="#involucrados" data-toggle="tab" aria-expanded="false">
                    COLABORADORES INVOLUCRADOS
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="insumos">
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead style="background-color: #01579B;  color: #fff;">
                        <tr>
                            <th>INSUMO</th>
                            <th>NO LOTE</th>

                            <th>CANTIDAD</th>
                            <th>CANTIDAD UTILIZADA</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_insumos">
                        @foreach($control->detalle_insumos as $insumo)
                            <tr>
                                <td>
                                    <input type="hidden" name="insumo[]" value="{{$insumo->id_detalle_insumo}}">
                                    {{$insumo->producto->codigo_interno}}
                                </td>
                                <td>
                                    {{$insumo->lote}}
                                </td>
                                <td>
                                    {{$insumo->cantidad}}
                                </td>
                                <td style="width: 15%">
                                    @if($insumo->cantidad_utilizada!=null)
                                        {{$insumo->cantidad_utilizada}}
                                    @else
                                        <input class="form-control cantidad_utilizada "
                                               value=""
                                               data-index="{{$insumo->id_detalle_insumo}}"
                                               id="cantidad_utilizada-{{$insumo->id_detalle_insumo}}"
                                               name="cantidad_utilizada[]">

                                        <input class="form-control cantidad_maxima "
                                               type="hidden"
                                               id="cantidad_maxima-{{$insumo->id_detalle_insumo}}"
                                               value="{{$insumo->cantidad}}"
                                               name="cantidad_maxima[]">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane " id="involucrados">
                <br>
                @include('produccion.control_trazabilidad.listado_colaboradores')
            </div>
        </div>

    </div>

    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
    @include('produccion.control_trazabilidad.colaboradores')
    @include('produccion.control_trazabilidad.alerta-finalizar')


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            @if($control->status!=3)
                <button class="btn btn-default"
                        type="button"
                        onclick="finalizar_control_trazabilidad()"
                >
                    <span class=" fa fa-check"></span> GUARDAR
                </button>
            @endif
            <a href="{{url('produccion/trazabilidad_chao_mein')}}">
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
    @include('produccion.control_trazabilidad.main_script')
    <script>
        function mostrar_cantidad_impresiones() {

            let control_trazabilidad = getControlTrazabilidad();
            let cantidad_produccion_no_seteada = control_trazabilidad.cantidad_producida == null;
            let es_producto_terminado = control_trazabilidad.producto.tipo_producto === 'PT';
            if (es_producto_terminado) {
                if (cantidad_produccion_no_seteada) {
                    calcular_cantidad_impresiones(control_trazabilidad.producto);
                } else {
                    setear_cantidad_impresiones_corrugados(control_trazabilidad.producto, control_trazabilidad.cantidad_producida);
                }
            }
        }


        function calcular_cantidad_impresiones(producto) {

            let element = document.getElementById("cantidad_produccion");

            element.addEventListener("keyup", function () {
                setear_cantidad_impresiones_corrugados(producto, document.getElementById("cantidad_produccion").value);
            });
        }

        function setear_cantidad_impresiones_corrugados(producto, cantidad_producida) {

            let factor = producto.cantidad_unidades;
            let total_etiquetas_corrugados = parseInt(cantidad_producida / factor);
            let total_etiquetas_unidades = parseInt(cantidad_producida % factor);
            document.getElementById('cantidad_etiquetas_corrugado').value = total_etiquetas_corrugados;
            document.getElementById('cantidad_etiquetas_unidades').value = total_etiquetas_unidades;

        }

        function calcular_impresiones_parciales() {
            let control_trazabilidad = getControlTrazabilidad();
            let element = document.getElementById("cantidad_produccion_parcial");
            element.addEventListener("keyup", function () {
                setear_cantidad_impresiones_corrugados_parciales(control_trazabilidad.producto, document.getElementById("cantidad_produccion_parcial").value);
            });

        }

        function setear_cantidad_impresiones_corrugados_parciales(producto, cantidad_producida) {

            let factor = producto.cantidad_unidades;
            let total_etiquetas_corrugados = parseInt(cantidad_producida / factor);
            let total_etiquetas_unidades = parseInt(cantidad_producida % factor);
            document.getElementById('cantidad_etiquetas_corrugado_parcial').value = total_etiquetas_corrugados;
            document.getElementById('cantidad_etiquetas_unidades_parcial').value = total_etiquetas_unidades;
        }

        function setear_cantidad_impresiones_unidades(total_etiquetas_unidades) {
            document.getElementById('cantidad_etiquetas_unidades').value = total_etiquetas_unidades;
        }

        function getControlTrazabilidad() {

            let control_trazabilidad = [];
            control_trazabilidad = @json($control);
            return control_trazabilidad;
        }

        function modal_entregas_parciales() {

            $('#entregas_parciales').modal();
        }


        function realizar_entrega_parcial() {


            let cantidad_produccion_parcial = document.getElementById('cantidad_produccion_parcial').value;
            if (cantidad_produccion_parcial.value === "" || cantidad_produccion_parcial == 0) {
                alert("Cantidad de produccion parcial en blanco");
                document.getElementById('cantidad_produccion_parcial').focus();
                return;
            }

            let cantidad_etiquetas_corrugado_parcial = document.getElementById('cantidad_etiquetas_corrugado_parcial').value;
            let cantidad_etiquetas_unidades_parcial = document.getElementById('cantidad_etiquetas_unidades_parcial').value;

            $.ajax({
                url: "{{url('entregas_parciales').'/'.$control->id_control}}",
                type: 'POST',
                data: {
                    cantidad_etiquetas_corrugado_parcial: cantidad_etiquetas_corrugado_parcial,
                    cantidad_etiquetas_unidades_parcial: cantidad_etiquetas_unidades_parcial,
                    ip: $('#impresoras').val(),
                    impresora: $('#impresoras').text(),
                    cantidad_produccion_parcial: cantidad_produccion_parcial
                }, success: function (response) {
                    console.log(response)
                }, error: function (err) {
                    console.log(err)
                }
            });

            let row = `<tr>
                <td>   ${$('#impresoras').text()}</td>
                <td> ${cantidad_produccion_parcial} </td>
                <td>${cantidad_etiquetas_corrugado_parcial}</td>
                <td>${cantidad_etiquetas_unidades_parcial}</td>
            <tr>`;

            $('#listado_entregas_parciales').prepend(row);
            $('#cantidad_etiquetas_unidades_parcial').val("");
            $('#cantidad_etiquetas_corrugado_parcial').val("");
            $('#cantidad_produccion_parcial').val("");


            document.getElementById('cantidad_produccion').value = parseInt(document.getElementById('cantidad_produccion').value || 0) + parseInt(cantidad_produccion_parcial);
            setear_cantidad_impresiones_corrugados(getControlTrazabilidad().producto, document.getElementById("cantidad_produccion").value);


        }

        mostrar_cantidad_impresiones();
        calcular_impresiones_parciales();
    </script>
@endsection
