@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Ingreso',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-shopping-cart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Recepcion
        @endslot
        @slot('submenu')
            Materia Prima
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'recepcion/materia_prima/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_producto">MATERIA PRIMA</label>
            <select name="id_producto"
                    class="form-control selectpicker"
                    onchange="cargarProveedores()"
            >
                <option value=""> SELECCIONE PRODUCTO</option>
                @foreach($productos as $producto)
                    <option value="{{$producto->id_producto}}">{{$producto->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="id_proveedor">PROVEEDOR</label>
            <select name="id_proveedor"
                    class="form-control selectpicker"
            >
                <option value=""> SELECCIONE PROVEEDOR</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>FECHA INGRESO</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker">
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="documento_proveedor">DOCUMENTO PROVEEDOR</label>
            <input type="text" name="documento_proveedor" value="{{old('documento_proveedor')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="orden_compra">NO. ORDEN DE COMPRA</label>
            <input type="text" name="orden_compra" value="{{old('orden_compra')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab" aria-expanded="false">
                        Documentos y Vehiculos
                    </a>
                </li>
                <li class="">
                    <a href="#tab_2" data-toggle="tab" aria-expanded="false">
                        Empaque y Etiqueta
                    </a>
                </li>
                <li class="">
                    <a href="#tab_3" data-toggle="tab" aria-expanded="true">
                        Detalles de lotes
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">Proveedor aprobado</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion2">
                            <label class="custom-control-label" for="opcion2">Producto acorde con Orden
                                de Compra</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" for="opcion3">Cantidad acorde con orden
                                de Compra</label>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Certificado de análisis</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion4">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="opcion4">Existente</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion5">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion5">Correspondiente
                                a No. Lote</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion6">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion6">De acuerdo a
                                especificación</label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Limpieza interna de vehìculo</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion7">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion7">Sin polvo y/o
                                suciedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion8">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion8">Sin Material
                                Ajeno</label>

                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <label for="nombre">Condiciones Internas vehiculos</label>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion9">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion9">Ausencia de
                                Plagas</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input" id="opcion10"> <label
                                    class="custom-control-label" style="font-weight: normal" for="opcion10">Sin
                                Humedad</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion11">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion11">Sin
                                óxido</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion12">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion12">Ausencia de
                                olores extraños</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion13">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion13">Ausencia de
                                material extraño</label>

                        </div>
                        <div class="custom-control custom-checkbox">

                            <input type="checkbox" class="custom-control-input" id="opcion14"> <label
                                    class="custom-control-label" style="font-weight: normal" for="opcion14">Cerrado y
                                con llave</label>

                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion15">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion15">Sin
                                agujeros</label>

                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">


                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">

                        <label for="nombre">Empaque</label>

                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-4 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion3">No
                                golpeado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion3">Sin
                                rotulas</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" style="font-weight: normal"
                                   for="opcion3">Cerrado</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion3">Seco y
                                Limpio</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion3">
                            <label class="custom-control-label" style="font-weight: normal" for="opcion3">Sin material
                                extraño</label>
                        </div>

                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">Producto debidamente identificado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">Identificación de producto legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">No. de lote presente</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">No. de lote legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">Fecha de vencimiento presente y
                                legible</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opcion1">
                            <label class="custom-control-label" for="opcion1">Contenido Neto declarado</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
                            <input type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Cantidad</label>
                            <input id="cantidad" type="text" onkeypress="return justNumbers(event);" name="descripcion"
                                   value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">No. de Lote</label>
                            <input id="lote" type="text" onkeypress="return justNumbers(event);" name="descripcion"
                                   value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-8 col-md-8 col-xs-10">
                        <div class="form-group">
                            <label>Fecha de Vendimiento</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="vencimiento" type="text" class="form-control pull-right" id="datepicker">

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-md-2 col-xs-2">
                        <br>
                        <div class="form-group">
                            <button id="btnAdd" class="btn btn-default block" style="margin-top: 5px;" type="button">
                                <span class=" fa fa-plus"></span></button>
                        </div>
                    </div>


                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">

                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>OPCION</th>
                            <th>CANTIDAD</th>
                            <th>NO. LOTES</th>
                            <th>FECHA VENCIMIENTO</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    {!!Form::close()!!}

@endsection
@section('scripts')

    <script>
        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });
    </script>
    <script>
        function cargarProveedores() {
            //NOT IMPLEMENTED
        }
    </script>
@endsection
