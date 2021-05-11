@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Verificacion',
    'menu_icon'=>' fa fa fa-cube ',
    'submenu_icon'=>' fa fa fa-user ',
    'operation_icon'=>'fa-check',])
        @slot('menu')
            Produccion
        @endslot
        @slot('submenu')
            Supervision Tarimas
        @endslot
    @endcomponent
    @include('componentes.alert-error')


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

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

    </div>



    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="no_tarima">NO. TARIMA</label>
            <div class="input-group">
                <input type="text"
                       id="no_tarima"
                       maxlength="20"
                       onkeydown="if(event.keyCode==13)buscar_tarima()"
                       name="no_tarima"
                       class="form-control">
                <div class="input-group-btn">
                    <a href="javascript:buscar_tarima()">
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-check " aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="javascript:limpiar_tarima()"
                    >
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-trash " aria-hidden="true"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <label for="cantidad">CANTIDAD</label>
            <div class="input-group">
                <input type="text"
                       id="cantidad"
                       onkeydown="if(event.keyCode==13)agregar()"
                       name="cantidad"
                       class="form-control">
                <div class="input-group-btn">
                    <a href="javascript:agregar()"
                    >
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-check " aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="javascript:limpiar_cantidad()"
                    >
                        <button type="button" class="btn btn-default">
                            <i class="fa fa-trash " aria-hidden="true"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="table-responsive">
                <table
                    class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color: #01579B;  color: #fff;">
                    <th></th>
                    <th>NO. TARIMA</th>
                    <th>CANTIDAD</th>

                    </thead>
                    <tbody id="listado_tarimas">
                    @foreach($entrega_det as $det)
                        @if($det->fecha_supervision != null)
                            <tr id="tarima-{{$det->no_tarima}}" class="tarima_agregada">
                                <td>
                                    <label class="label label-success">
                                        <i class="fa fa-check"></i>
                                    </label>
                                </td>
                                <td>{{$det->no_tarima}}</td>
                                <td>{{$det->total_cajas}}</td>

                            </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <a href="{{url('produccion/supervision')}}">
                    <button class="btn btn-default"
                            id="btnGuardar"
                            disabled
                            type="button">
                        <span class=" fa fa-check"></span> GUARDAR
                    </button>
                </a>
                <a href="{{url('produccion/supervision')}}">
                    <button class="btn btn-default" type="button">
                        <span class="fa fa-remove"></span>
                        CANCELAR
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function tarimas() {

            const tarimas = @json($entrega_det);

            return tarimas;
        }


        function get_tarima(no_tarima) {

            const tarima = tarimas().filter(x => x.no_tarima == no_tarima);

            return tarima;
        }

        function buscar_tarima() {

            const no_tarima = document.getElementById('no_tarima').value.trim();

            const tarima = get_tarima(no_tarima);

            if (tarima.length == 0) {
                alert("Tarima no encontrada");
                return;
            }

            document.getElementById('cantidad').focus();


        }

        function agregar() {

            const no_tarima = document.getElementById('no_tarima').value.trim();

            const tarima = get_tarima(no_tarima);

            if (tarima.length == 0) {
                alert("Tarima no encontrada");
                return;
            }

            const cantidad = parseInt(document.getElementById('cantidad').value.trim());

            console.log(cantidad, tarima[0].total_cajas);

            if (cantidad != parseInt(tarima[0].total_cajas)) {
                alert("Cantidad incorrecta");
                return;
            }


            $.ajax({
                url: "{{url('produccion/supervision/verficar_tarima')}}",
                type: "post",
                data: {
                    no_tarima: no_tarima,
                    cantidad: cantidad
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        limpiar_tarima();
                        limpiar_cantidad();
                        add_to_table(no_tarima, cantidad)
                    } else {
                        alert(response.data);

                    }
                },
                error: function (err) {
                    alert(err.message)
                }
            });


        }

        function limpiar_tarima() {
            document.getElementById('no_tarima').value = "";

        }

        function limpiar_cantidad() {
            document.getElementById('cantidad').value = "";
        }

        function add_to_table(no_tarima, cantidad) {

            let row = ` <tr id="tarima-${no_tarima}" class="tarima_agregada">
                                <td>
                                    <label class="label label-success">
                                        <i class="fa fa-check"></i>
                                    </label>
                                </td>
                        <td>${no_tarima}</td>
                        <td>${cantidad}</td>
                    </tr>    `;

            $('#listado_tarimas').append(row);

            const habilitar_boton_guardar = document.getElementsByClassName('tarima_agregada').length == tarimas().length;
            if (habilitar_boton_guardar) {
                document.getElementById('btnGuardar').disabled = false;
            }
        }
    </script>
@endsection
