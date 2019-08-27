@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
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


    {{--
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <button class="btn btn-default" type="submit">
                    <span class=" fa fa-check"></span> GUARDAR
                </button>
                <a href="{{url('recepcion/materia_prima')}}">
                    <button class="btn btn-default" type="button">
                        <span class="fa fa-remove"></span>
                        CANCELAR
                    </button>
                </a>

            </div>
        </div>
        <div class="modal fade modal-slide-in-right" aria-hidden="true"
             role="dialog" tabindex="-1" id="not_found">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" align="center">PRODUCTO NO ENCONTRADO</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-check"></span>
                            ACEPTAR
                        </button>
                    </div>
                </div>
            </div>

        </div>
        --}}


@endsection

