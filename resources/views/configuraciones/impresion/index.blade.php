@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')

    @include('componentes.alert-success')
    @include('componentes.alert-error')

    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa fa-cogs',
    'submenu_icon'=>'a fa-print',
    'operation_icon'=>'',])
        @slot('menu')
            Configuracion
        @endslot
        @slot('submenu')
            Impresion
        @endslot
    @endcomponent

    <form action="{{route('configuraciones.impresion.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <h3>IMPRESION DE ETIQUETAS PARA TARIMAS</h3>
            </div>
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-6">
                <div class="form-group">
                    <label for="DATO_INICIAL">Cantidad</label>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                <div class="input-group">
                    <input
                        id="cantidad_etiqueta_tarima"
                        class="form-control">
                    <div class="input-group-btn">
                        <button
                            onclick="imprimir_etiqueta_tarima()"
                            type="button" class="btn btn-default">
                            <i class="fa fa-print"
                               aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <h3>DATOS DE IMPRESION</h3>
            </div>
        </div>
        @foreach($configuraciones as $configuracion)
            <div class="row">
                @include('configuraciones.impresion.configuracion')
            </div>
        @endforeach
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-default" type="submit">
                        <span class=" fa fa-check"></span> GUARDAR
                    </button>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function imprimir_etiqueta_tarima() {

            const cantidad_etiqueta_tarima = parseInt(document.getElementById('cantidad_etiqueta_tarima').value)

            if (cantidad_etiqueta_tarima === 0 || cantidad_etiqueta_tarima === null) {
                alert("Cantidad invalida");
                document.getElementById('cantidad_etiqueta_tarima').focus();
                return;
            }
            $.ajax({
                url: "{{url('imprimir_etiquetas_tarima')}}",
                type: "post",
                data: {
                    cantidad: cantidad_etiqueta_tarima
                },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        alert(response.data);
                        document.getElementById('cantidad_etiqueta_tarima').value = "";
                    }
                }
            });
        }
    </script>
@endsection
