@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>LIBERACION DE LINEA PARA CHAO MEIN</h3>
    </div>
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Línea  Chaomin
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/chaomin/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="no_orden_produccion"
                   readonly
                   value="{{$chaomin->no_orden_produccion}}"
                   class="form-control">

        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACION</label>
            <select name="id_presentacion"
                    disabled
                    class="form-control selectpicker" id="id_presentacion">

                @foreach( $presentaciones as $presentacion )
                    @if($chaomin->id_presentacion == $presentacion->id_presentacion)
                        <option value="{{$presentacion->id_presentacion}}" selected>{{$presentacion->descripcion}}</option>
                    @else
                        <option value="{{$presentacion->id_presentacion}}" >{{$presentacion->descripcion}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>






    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <select class="form-control selectpicker" data-live-search="true" id="id_turno"
                    disabled
                    name="id_turno">
                <option value="" selected>SELECCIONE UN TURNO</option>
                <option value="TURNO 1">TURNO 1</option>
                <option value="TURNO 2">TURNO 2</option>
                <option value="" selected>{{ $chaomin->id_turno}}</option>
                class="form-control selectpicker" id="id_presentacion">
            </select>
        </div>
    </div>

    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="solucion_carga"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="solucion_carga">CANTIDAD DE SOLUCIÓN POR CARGA</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="DATO_INICIAL">DATO INICIAL</label>
            <input type="text" name="cant_solucion_carga" id="cant_solucion_carga"
                   onkeydown="if(event.keyCode==13)validar(this,158.4,168.5,document.getElementById('cant_carga_salida'),document.getElementById('cantidad_solucion_observacion'),document.getElementById('ph_solucion_inicial'))"
                   readonly
                   value="{{$chaomin->cant_solucion_carga}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="cantidad_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="cantidad_solucion_observacion" id="cantidad_solucion_observacion" readonly
                   readonly
                   value="{{$chaomin->cantidad_solucion_observacion}}"
                   class="form-control">
        </div>
    </div>



    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="LABEL_GENERICO"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="LABEL_TITULO">PH DE SOLUCIÓN</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion">DATO INICIAL</label>
            <input type="text" name="ph_solucion_inicial" id="ph_solucion_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,11,11,document.getElementById('ph_solucion_final'),document.getElementById('ph_solucion_observacion'),document.getElementById('mezcla_seca_inicial'))"
                   readonly
                   value="{{$chaomin->ph_solucion_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="ph_solucion_observacion" id="ph_solucion_observacion" readonly
                   readonly
                   value="{{$chaomin->ph_solucion_observacion}}"
                   class="form-control">
        </div>
    </div>



    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TIEMPO DE MEZCLA SECO (60 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="mezcla_seca_inicial" id="mezcla_seca_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,60,60,document.getElementById('mezcla_seca_final'),document.getElementById('mezcla_seca_observacion'),document.getElementById('mezcla_alta_inicial'))"
                   readonly
                   value="{{$chaomin->mezcla_seca_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_seca_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_seca_observacion" id="mezcla_seca_observacion" readonly
                   readonly
                   value="{{$chaomin->mezcla_seca_observacion}}"
                   class="form-control">
        </div>
    </div>



    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TIEMPO DE MEZCLA ALTA (300 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta">DATO INICIAL</label>
            <input type="text" name="mezcla_alta_inicial" id="mezcla_alta_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,300,300,document.getElementById('mezcla_alta_final'),document.getElementById('mezcla_alta_observacion'),document.getElementById('mezcla_baja_inicial'))"
                   readonly
                   value="{{$chaomin->mezcla_alta_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_alta_observacion" id="mezcla_alta_observacion" rEADONLY
                   readonly
                   value="{{$chaomin->mezcla_alta_observacion}}"
                   class="form-control">
        </div>
    </div>




    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TIEMPO DE MEZCLA BAJA (600 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja">DATO INICIAL</label>
            <input type="text" name="mezcla_baja_inicial" id="mezcla_baja_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,600,600,document.getElementById('mezcla_baja_final'),document.getElementById('mezcla_baja_observacion'),document.getElementById('temperatura_reposo_inicial'))"
                   readonly
                   value="{{$chaomin->mezcla_baja_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_baja_observacion" id="mezcla_baja_observacion" READONLY
                   readonly
                   value="{{$chaomin->mezcla_baja_observacion}}"
                   class="form-control">
        </div>
    </div>


    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TEMPERATURA RECAMARA DE REPOSO (MÁS DE 36 °C)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="temperatura_reposo_inicial" id="temperatura_reposo_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,36,90000000,document.getElementById('temperatura_reposo_final'),document.getElementById('temperatura_reposo_observacion'),document.getElementById('ancho_cartucho_inicial'))"
                   readonly
                   value="{{$chaomin->temperatura_reposo_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_reposo_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_reposo_observacion" id="temperatura_reposo_observacion" readonly
                   readonly
                   value="{{$chaomin->temperatura_reposo_observacion}}"
                   class="form-control">
        </div>
    </div>


    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">ANCHO DEL CARTUCHO (1.0 m, 1.5 m y 1.8 m)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="ancho_cartucho_inicial" id="ancho_cartucho_inicial"
                   onkeydown="if(event.keyCode==13)ValidacionCartucho(this, 1, 1.5, 1.8, document.getElementById('ancho_cartucho_final'),document.getElementById('ancho_cartucho_observacion'),document.getElementById('temperatura_precocedora_1_inicial'))"
                   readonly
                   value="{{$chaomin->ancho_cartucho_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ancho_cartucho_observacion">OBSERVACIONES</label>
            <input type="text" name="ancho_cartucho_observacion" id="ancho_cartucho_observacion" readonly
                   readonly
                   value="{{$chaomin->ancho_cartucho_observacion}}"
                   class="form-control">
        </div>
    </div>


    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">PARAMETROS PRE-COCEDORA 1 TEMPERATURA (98 A 105)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="temperatura_precocedora_1_inicial" id="temperatura_precocedora_1_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,98,105,document.getElementById('temperatura_precocedora_1_final'),document.getElementById('temperatura_precocedora_1_observacion'),document.getElementById('tiempo_precocedora_1_inicial'))"
                   readonly
                   value="{{$chaomin->temperatura_precocedora_1_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_1_observacion" id="temperatura_precocedora_1_observacion"

                   readonly
                   value="{{$chaomin->temperatura_precocedora_1_observacion}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">PARAMETROS PRE-COCEDORA 1 TIEMPO (10 A 30 MIN)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="tiempo_precocedora_1_inicial" id="tiempo_precocedora_1_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,10,30,document.getElementById('tiempo_precocedora_1_final'),document.getElementById('tiempo_precocedora_1_observacion'),document.getElementById('temperatura_precocedora_2_inicial'))"
                   readonly
                   value="{{$chaomin->tiempo_precocedora_1_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_1_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_1_observacion" id="tiempo_precocedora_1_observacion" readonly
                   readonly
                   value="{{$chaomin->tiempo_precocedora_1_observacion}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">PARAMETROS PRE-COCEDORA 2 TEMPERATURA (100 A 105)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="temperatura_precocedora_2_inicial" id="temperatura_precocedora_2_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,100,105,document.getElementById('temperatura_precocedora_2_final'),document.getElementById('temperatura_precocedora_2_observacion'),document.getElementById('tiempo_precocedora_2_inicial'))"
                   readonly
                   value="{{$chaomin->temperatura_precocedora_2_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_2_observacion" id="temperatura_precocedora_2_observacion"
                   readonly
                   value="{{$chaomin->temperatura_precocedora_2_observacion}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">PARAMETROS PRE-COCEDORA 2 TIEMPO (10 A 30 MIN)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="tiempo_precocedora_2_inicial" id="tiempo_precocedora_2_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,10,30,document.getElementById('tiempo_precocedora_2_final'),document.getElementById('tiempo_precocedora_2_observacion'),document.getElementById('temperatura_central_inicial'))"
                   readonly
                   value="{{$chaomin->tiempo_precocedora_2_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_2_observacion" id="tiempo_precocedora_2_observacion" readonly
                   readonly
                   value="{{$chaomin->tiempo_precocedora_2_observacion}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TEMPERATURA CENTRAL DE SECADORA (DE 72 A 80 ºC)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="temperatura_central_inicial" id="temperatura_central_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,72,80,document.getElementById('temperatura_central_final'),document.getElementById('temperatura_central_observaciones'),document.getElementById('velocidad_pass200_inicial'))"
                   readonly
                   value="{{$chaomin->temperatura_central_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_central_observaciones">OBSERVACIONES</label>
            <input type="text" name="temperatura_central_observaciones" id="temperatura_central_observaciones" readonly
                   readonly
                   value="{{$chaomin->temperatura_central_observaciones}}"
                   class="form-control">
        </div>
    </div>


    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PAS200 (53HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="velocidad_pass200_inicial" id="velocidad_pass200_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,53,53,document.getElementById('velocidad_pass200_final'),document.getElementById('velocidad_pass200_observaciones'),document.getElementById('velocidad_pasc180_inicial'))"
                   readonly
                   value="{{$chaomin->velocidad_pass200_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pass200_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pass200_observaciones" id="velocidad_pass200_observaciones" readonly
                   readonly
                   value="{{$chaomin->velocidad_pass200_observaciones}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PASC180 (58HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="velocidad_pasc180_inicial" id="velocidad_pasc180_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,58,58,document.getElementById('velocidad_pasc180_final'),document.getElementById('velocidad_pasc180_observaciones'),document.getElementById('velocidad_pask180_inicial'))"
                   readonly
                   value="{{$chaomin->velocidad_pasc180_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasc180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasc180_observaciones" id="velocidad_pasc180_observaciones" readonly
                   value="{{$chaomin->velocidad_pasc180_observaciones}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PASK180 (60HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="velocidad_pask180_inicial" id="velocidad_pask180_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,60,60,document.getElementById('velocidad_pask180_final'),document.getElementById('velocidad_pask180_observaciones'),document.getElementById('velocidad_pasi180_inicial'))"
                   readonly
                   value="{{$chaomin->velocidad_pask180_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pask180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pask180_observaciones" id="velocidad_pask180_observaciones" readonly
                   readonly
                   value="{{$chaomin->velocidad_pask180_observaciones}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PASI180 (60HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="velocidad_pasi180_inicial" id="velocidad_pasi180_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,60,60,document.getElementById('velocidad_pasi180_final'),document.getElementById('velocidad_pasi180_observaciones'),document.getElementById('velocidad_pasm160_inicial'))"
                   readonly
                   value="{{$chaomin->velocidad_pasi180_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasi180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasi180_observaciones" id="velocidad_pasi180_observaciones" readonly
                   readonly
                   value="{{$chaomin->velocidad_pasi180_observaciones}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PASM160 (60HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="velocidad_pasm160_inicial" id="velocidad_pasm160_inicial"

                   onkeydown="if(event.keyCode==13)validar(this,60,60,document.getElementById('velocidad_pasm160_final'),document.getElementById('velocidad_pasm160_observaciones'),document.getElementById('extractor_activo_inicial'))"
                   readonly
                   value="{{$chaomin->velocidad_pasm160_inicial}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasm160_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasm160_observaciones" id="velocidad_pasm160_observaciones" readonly=""
                   readonly
                   value="{{$chaomin->velocidad_pasm160_observaciones}}"
                   class="form-control">
        </div>
    </div>

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">EXTRACTOR ACTIVO</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <!--<select name="id_localidad" class="form-control selectpicker" id="localidades" >-->
            <select class="form-control selectpicker" data-live-search="true" id="extractor_activo_inicial"
                    disabled
                    name="extractor_activo_inicial"
                    onchange="ValidacionCombox(this,  document.getElementById('extractor_activo_final'), document.getElementById('extractor_activo_observacion') , document.getElementById('ventilacion_inicial') )">
                <option value="" selected>{{ $chaomin->extractor_activo_inicial}}</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="extractor_activo_observacion" id="extractor_activo_observacion" readonly
                   readonly
                   value="{{$chaomin->extractor_activo_observacion}}"
                   class="form-control">
        </div>
    </div>




    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VENTILACION IDEAL ACORDE A PRODUCTO</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <select class="form-control selectpicker" data-live-search="true" id="ventilacion_inicial"
                    name="ventilacion_inicial"
                    disabled
                    onchange="ValidacionCombox(this,  document.getElementById('ventilacion_final'), document.getElementById('ventilacion_observacion') , document.getElementById('verificacion_codificacion_lote') )">
                <!--<option value="" selected>SELECCIONE UNA OPCION</option>-->
                <option value="" selected>{{ $chaomin->ventilacion_inicial}}</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="ventilacion_observacion" id="ventilacion_observacion" readonly
                   readonly
                   value="{{$chaomin->ventilacion_observacion}}"
                   class="form-control">
        </div>
    </div>


    <!--
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ventilacion_ideal">VENTILACIÓN IDEAL (ACORDE A PRODUCTO) SI</label>
            <input type="text" name="ventilacion_ideal" value="{{old('ventilacion_ideal')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ventilacion_ideal_observaciones">OBSERVACIONES</label>
            <input type="text" name="ventilacion_ideal_observaciones" value="{{old('ventilacion_ideal_observaciones')}}"
                   class="form-control">
        </div>
    </div>
    -->



    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VERIFICACION CODIFICADO</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">LOTE: CODMMDDAATUR</label>
            <input type="text" name="verificacion_codificacion_lote" id="verificacion_codificacion_lote"
                   readonly
                   value="{{$chaomin->verificacion_codificacion_lote}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_final">VENCE: DD/MM/AAAA</label>
            <input type="text" name="verificacion_codificacion_vence" id="verificacion_codificacion_vence" readonly
                   readonly
                   value="{{$chaomin->verificacion_codificacion_vence}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificacion_obs">OBSERVACIONES</label>
            <input type="text" name="verificacion_codificacion_obs" id="verificacion_codificacion_obs" readonly
                   readonly
                   value="{{$chaomin->verificacion_codificacion_obs}}"
                   class="form-control">
        </div>
    </div>



    <!--
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="sello_1">SELLOS (CUALITATIVO) MAQ. #1</label>
            <input type="text" name="sello_1" value="{{old('sello_1')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="sellor_1_observaciones">OBSERVACIONES</label>
            <input type="text" name="sellor_1_observaciones" value="{{old('sellor_1_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="sello_2">SELLOS (CUALITATIVO) MAQ. #2</label>
            <input type="text" name="sello_2" value="{{old('sello_2')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="sellor_2_observaciones">OBSERVACIONES</label>
            <input type="text" name="sellor_2_observaciones" value="{{old('sellor_2_observaciones')}}"
                   class="form-control">
        </div>
    </div>
-->

    <!---***********************-->
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">SELLOS CUALITATIVO</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_final">MAQUINA</label>
            <select class="form-control selectpicker" data-live-search="true" id="id_maquina" disabled="" name="id_maquina">
                <option value="" selected>{{ $chaomin->id_maquina}}</option>
                <option value="1">MAQ # 1</option>
                <option value="2">MAQ # 2</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">DATO INICIAL</label>
            <input type="text" name="maquina_inicial" id="maquina_inicial"
                   readonly
                   value="{{$chaomin->maquina_inicial}}"
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="sellos_observaciones" id="sellos_observaciones"
                   readonly
                   value="{{$chaomin->sellos_observaciones}}"
                   class="form-control">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"></label>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observaciones">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
            <input type="text" name="observaciones_acciones" id="observaciones_acciones"
                   readonly
                   value="{{$chaomin->observaciones_acciones}}"

                   class="form-control">

        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('control/chaomin')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-remove"></span>
                    CANCELAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection


