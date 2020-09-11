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

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   readonly
                   id="producto"
                   value="{{$chaomin->producto->descripcion}}"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="id_presentacion">PRESENTACION</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="id_presentacion"
                   value="{{$chaomin->presentacion->descripcion}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">TURNO</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="id_presentacion"
                   value="{{$chaomin->id_turno}}"
                   class="form-control valor">
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
            <label for="LABEL_TITULO">PH DE SOLUCIÓN (8 a 11 ppm)</label>

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
            <label for="label_generico">TIEMPO DE MEZCLA ALTA (300 a 420 s)</label>

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
            <label for="label_generico">TIEMPO DE MEZCLA BAJA (450 a 630 S)</label>

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
            <label for="label_generico">TEMPERATURA CENTRAL DE SECADORA (DE 72 A 82 ºC)</label>

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
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">VELOCIDAD SECADORA PAS180 (58Hrz)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pas180_inicial" id="velocidad_pas180_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pas180_observaciones','velocidad_pas180_inicial')"
                   disabled
                   value="{{$chaomin->velocidad_pas180_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pas180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pas180_observaciones" id="velocidad_pas180_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasc180_inicial','velocidad_pas180_observaciones')"
                   disabled
                   value="{{$chaomin->velocidad_pas180_observaciones}}"
                   class="form-control valor">
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
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">EXTRACTOR ACTIVO (SI)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>

            <select class="form-control selectpicker valor"
                    id="extractor_activo_inicial"
                    name="extractor_activo_inicial"
                    disabled
                    onchange="document.getElementById('extractor_activo_observaciones').focus()">
                <option value="1" {{$chaomin->extractor_activo_inicial==0?'':'selected'}}>SI</option>
                <option value="0" {{$chaomin->extractor_activo_inicial==1?'':'selected'}}>NO</option>
            </select>


        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="extractor_activo_observaciones"
                   disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'ventilacion_inicial','extractor_activo_observaciones')"
                   id="extractor_activo_observaciones"
                   {{$chaomin->extractor_activo_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->extractor_activo_observaciones}}"
                   class="form-control valor">
        </div>
    </div>



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
            <label for="dato_inicial">VALOR</label>
            <select class="form-control selectpicker valor"
                    id="ventilacion_inicial"
                    name="ventilacion_inicial"
                    disabled
                    onchange="document.getElementById('ventilacion_observacion').focus()">
                <option value="1" {{$chaomin->ventilacion_inicial==0?'':'selected'}}>SI</option>
                <option value="0" {{$chaomin->ventilacion_inicial==1?'':'selected'}}>NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="ventilacion_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'verificacion_codificacion_lote','ventilacion_observacion')"
                   id="ventilacion_observacion"
                   value="{{$chaomin->ventilacion_observacion}}"
                   class="form-control valor">
        </div>
    </div>





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
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'verificacion_codificacion_lote','ventilacion_observacion')"
                   disabled
                   value="{{$chaomin->verificacion_codificacion_lote}}"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_final">VENCE: DD/MM/AAAA</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="verificacion_codificacion_vence" id="verificacion_codificacion_vence"
                       disabled
                       value="{{$chaomin->verificacion_codificacion_vence}}"
                       onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'verificacion_codificacion_obs','verificacion_codificacion_vence')"


                       class="form-control valor form-control pull-right">
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificacion_obs">OBSERVACIONES</label>
            <input type="text" name="verificacion_codificacion_obs" id="verificacion_codificacion_obs"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'maquina_inicial_1','verificacion_codificacion_obs')"
                   disabled
                   {{$chaomin->verificacion_codificacion_obs==null?'':'disabled'}}
                   value="{{$chaomin->verificacion_codificacion_obs}}"
                   class="form-control valor">
        </div>
    </div>





    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">SELLOS CUALITATIVO (MAQUINA #1)</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_final">VALOR</label>
            <select class="form-control selectpicker valor" id="maquina_inicial_1"
                    onchange="document.getElementById('sellos_observaciones_1').focus()"
                    disabled
                    name="maquina_inicial_1">
                <option value="1" {{$chaomin->maquina_inicial_1==0?'':'selected'}} >SI</option>
                <option value="0" {{$chaomin->maquina_inicial_1==1?'':'selected'}}>NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="sellos_observaciones_1">OBSERVACIONES</label>
            <input type="text" name="sellos_observaciones" id="sellos_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'maquina_inicial_2','sellos_observaciones_1')"
                   {{$chaomin->sellos_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->sellos_observaciones}}"
                   disabled
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">SELLOS CUALITATIVO (MAQUINA #2)</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_final">VALOR</label>
            <select class="form-control selectpicker valor"
                    disabled
                    onchange="document.getElementById('sellos_observaciones_2').focus()"
                    id="maquina_inicial_2" name="maquina_inicial_2">
                <option value="1" {{$chaomin->maquina_inicial_2==0?'':'selected'}} >SI</option>
                <option value="0" {{$chaomin->maquina_inicial_2==1?'':'selected'}} >NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="sellos_observaciones_2">OBSERVACIONES</label>
            <input type="text" name="sellos_observaciones_2" id="sellos_observaciones_2"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'observaciones_acciones','sellos_observaciones_2')"
                   {{$chaomin->sellos_observaciones_2==null?'':'disabled'}}
                   disabled
                   value="{{$chaomin->sellos_observaciones_2}}"
                   class="form-control valor">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico"></label>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="observaciones_acciones">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
            <input type="text" name="observaciones_acciones"
                   id="observaciones_acciones"
                   readonly
                   value="{{$chaomin->observaciones_acciones}}"
                   class="form-control valor">

        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">

            <a href="{{url('control/chaomin')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>

        </div>
    </div>
    {!!Form::close()!!}
@endsection


