@extends('layouts.admin')
@section('style')
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
@endsection
@section('contenido')
    @include('componentes.alert-success')
    @include('componentes.alert-error')
    @component('componentes.nav',['operation'=>'LIST',
    'menu_icon'=>'fa-print',
    'submenu_icon'=>'',
    'operation_icon'=>'',])
        @slot('menu')
            Reimpresion
        @endslot
        @slot('submenu')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <a href="javascript:modal_reimpresion()" data-placement="top" title="Imprimir" data-toggle="tooltip"><img
                    src="{{asset('imagenes_web/imprimir.png')}}" width="50" height="50"></a>
            <a href="javascript:procesar_pendientes()" data-placement="top" title="Impresiones pendientes"
               data-toggle="tooltip"><img
                    src="{{asset('imagenes_web/confirmar.png')}}" width="50" height="50"></a>
        </div>

    </div>

    @component('componentes.alert-no-selecction')
        @slot('mensaje')
            Seleccionar PRODUCTO
        @endslot
    @endcomponent
    <div id="content">
        @include('reimpresion.index')
    </div>
    <div class="loading">
        <i class="fa fa-refresh fa-spin "></i><br/>
        <span>Cargando</span>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/ajax-crud.js')}}"></script>
    <script src="{{asset('js-brc/generico/index.js')}}"></script>
    <script>
        function modal_reimpresion() {
            let item = getItemSelected();

            if (item == null) {
                $('#errorToEdit').modal();
            } else {
                $('#modal-reimpresion-' + item).modal();
            }

        }

        function procesar_pendientes() {

            $('.loading').show();

            setTimeout(function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{url('reimpresion/procesar_pendientes')}}',
                    type: 'get',
                    data: {_token: CSRF_TOKEN},
                    success: function (response) {
                        $('.loading').hide();
                    },
                    error: function (e) {
                        $('.loading').hide();
                    }

                });
            }, 1500)

        }

        function reimprimir() {
            let item = getItemSelected();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            let cantidad = document.getElementById('cantidad-' + item).value;
            const url = '{{url('reimpresion/reimprimir')}}' + '?id=' + item + '&cantidad=' + cantidad;
            $('.loading').show();
            $.ajax({
                url: url,
                type: 'post',
                data: {_token: CSRF_TOKEN},
                success: function (response) {

                    console.log(response);

                    $('#modal-reimpresion-' + item).modal('hide');
                    $('.loading').hide();
                },
                error: function (e) {
                    $('#modal-reimpresion-' + item).modal('hide');
                    $('.loading').hide();
                    alert(e);
                }


            });

        }
    </script>
@endsection
