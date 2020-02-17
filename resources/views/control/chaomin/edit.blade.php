@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">

@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-4 col-sm-12   col-sm-push-4   col-md-12   col-md-push-4  col-xs-12">
        <h3>LIBERACION DE LINEA PARA CHAO MEIN</h3>
    </div>

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Línea  Chaomin
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/chaomin/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <input type="hidden" id="id_chaomin" name="id_chaomin" value="{{$chaomin->id_chaomin}}">

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
            <label for="DATO_INICIAL">VALOR</label>
            <input type="number" step="any" lang="en" name="cant_solucion_carga" id="cant_solucion_carga"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'cantidad_solucion_observacion','cant_solucion_carga')"
                   {{$chaomin->cant_solucion_carga==null?'':'disabled'}}
                   value="{{$chaomin->cant_solucion_carga}}"

                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="cantidad_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="cantidad_solucion_observacion" id="cantidad_solucion_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion_inicial','cantidad_solucion_observacion')"
                   {{$chaomin->cantidad_solucion_observacion==null?'':'disabled'}}
                   value="{{$chaomin->cantidad_solucion_observacion}}"
                   class="form-control valor">
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
            <label for="ph_solucion">VALOR</label>
            <input type="number" step="any" name="ph_solucion_inicial" id="ph_solucion_inicial"
                   {{$chaomin->ph_solucion_inicial==null?'':'disabled'}}
                   value="{{$chaomin->ph_solucion_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion_observacion','ph_solucion_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="ph_solucion_observacion" id="ph_solucion_observacion"
                   {{$chaomin->ph_solucion_observacion==null?'':'disabled'}}
                   value="{{$chaomin->ph_solucion_observacion}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_seca_inicial','ph_solucion_observacion')"
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
            <label for="label_generico">TIEMPO DE MEZCLA SECO (60 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="mezcla_seca_inicial" id="mezcla_seca_inicial"
                   {{$chaomin->mezcla_seca_inicial==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_seca_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_seca_observacion','mezcla_seca_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_seca_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_seca_observacion" id="mezcla_seca_observacion"
                   {{$chaomin->mezcla_seca_observacion==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_seca_observacion}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_alta_inicial','mezcla_seca_observacion')"

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
            <label for="label_generico">TIEMPO DE MEZCLA ALTA (300 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta">VALOR</label>
            <input type="number" step="any" name="mezcla_alta_inicial" id="mezcla_alta_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_alta_observacion','mezcla_alta_inicial')"
                   {{$chaomin->mezcla_alta_inicial==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_alta_inicial}}"
                   class="form-control valor">
        </div>
    </div>



    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_alta_observacion" id="mezcla_alta_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_baja_inicial','mezcla_alta_observacion')"
                   {{$chaomin->mezcla_alta_observacion==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_alta_observacion}}"
                   class="form-control valor">
        </div>
    </div>




    <!---***********************-->

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico "> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">TIEMPO DE MEZCLA BAJA (600 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja">VALOR</label>
            <input type="number" step="any" name="mezcla_baja_inicial" id="mezcla_baja_inicial"
                   {{$chaomin->mezcla_baja_inicial==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_baja_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_baja_observacion','mezcla_baja_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_baja_observacion" id="mezcla_baja_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_reposo_inicial','mezcla_baja_observacion')"
                   {{$chaomin->mezcla_baja_observacion==null?'':'disabled'}}
                   value="{{$chaomin->mezcla_baja_observacion}}"
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
            <label for="label_generico">TEMPERATURA RECAMARA DE REPOSO (MÁS DE 36 °C)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="temperatura_reposo_inicial" id="temperatura_reposo_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_reposo_observacion','temperatura_reposo_inicial')"
                   {{$chaomin->temperatura_reposo_inicial==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_reposo_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_reposo_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_reposo_observacion" id="temperatura_reposo_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ancho_cartucho_inicial','temperatura_reposo_observacion')"
                   {{$chaomin->temperatura_reposo_observacion==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_reposo_observacion}}"
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
            <label for="label_generico ">ANCHO DEL CARTUCHO (1.0 m, 1.5 m y 1.8 m)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="ancho_cartucho_inicial" id="ancho_cartucho_inicial"
                   {{$chaomin->ancho_cartucho_inicial==null?'':'disabled'}}
                   value="{{$chaomin->ancho_cartucho_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ancho_cartucho_observacion','ancho_cartucho_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ancho_cartucho_observacion">OBSERVACIONES</label>
            <input type="text" name="ancho_cartucho_observacion" id="ancho_cartucho_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_1_inicial','ancho_cartucho_observacion')"
                   {{$chaomin->ancho_cartucho_observacion==null?'':'disabled'}}
                   value="{{$chaomin->ancho_cartucho_observacion}}"
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
            <label for="label_generico">PARAMETROS PRE-COCEDORA 1 TEMPERATURA (98 A 105)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="temperatura_precocedora_1_inicial"
                   id="temperatura_precocedora_1_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_1_observacion','temperatura_precocedora_1_inicial')"
                   {{$chaomin->temperatura_precocedora_1_inicial==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_precocedora_1_inicial}}"
                   class="form-control valor">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_1_observacion" id="temperatura_precocedora_1_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_1_inicial','temperatura_precocedora_1_observacion')"
                   {{$chaomin->temperatura_precocedora_1_observacion==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_precocedora_1_observacion}}"
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
            <label for="label_generico">PARAMETROS PRE-COCEDORA 1 TIEMPO (10 A 30 MIN)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="tiempo_precocedora_1_inicial" id="tiempo_precocedora_1_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_1_observacion','tiempo_precocedora_1_inicial')"
                   {{$chaomin->tiempo_precocedora_1_inicial==null?'':'disabled'}}
                   value="{{$chaomin->tiempo_precocedora_1_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_1_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_1_observacion" id="tiempo_precocedora_1_observacion"
                   {{$chaomin->tiempo_precocedora_1_observacion==null?'':'disabled'}}
                   value="{{$chaomin->tiempo_precocedora_1_observacion}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_2_inicial','tiempo_precocedora_1_observacion')"
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
            <label for="label_generico">PARAMETROS PRE-COCEDORA 2 TEMPERATURA (100 A 105)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="temperatura_precocedora_2_inicial"
                   id="temperatura_precocedora_2_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_2_observacion','temperatura_precocedora_2_inicial')"
                   {{$chaomin->temperatura_precocedora_2_inicial==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_precocedora_2_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_2_observacion" id="temperatura_precocedora_2_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_2_inicial','temperatura_precocedora_2_observacion')"
                   {{$chaomin->temperatura_precocedora_2_observacion==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_precocedora_2_observacion}}"
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
            <label for="label_generico">PARAMETROS PRE-COCEDORA 2 TIEMPO (10 A 30 MIN)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="tiempo_precocedora_2_inicial" id="tiempo_precocedora_2_inicial"
                   {{$chaomin->tiempo_precocedora_2_inicial==null?'':'disabled'}}
                   value="{{$chaomin->tiempo_precocedora_2_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_2_observacion','tiempo_precocedora_2_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_2_observacion" id="tiempo_precocedora_2_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_central_inicial','tiempo_precocedora_2_observacion')"
                   {{$chaomin->tiempo_precocedora_2_observacion==null?'':'disabled'}}
                   value="{{$chaomin->tiempo_precocedora_2_observacion}}"
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
            <label for="label_generico">TEMPERATURA CENTRAL DE SECADORA (DE 72 A 80 ºC)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="temperatura_central_inicial" id="temperatura_central_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_central_observaciones','temperatura_central_inicial')"
                   {{$chaomin->temperatura_central_inicial==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_central_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_central_observaciones">OBSERVACIONES</label>
            <input type="text" name="temperatura_central_observaciones" id="temperatura_central_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pass200_inicial','temperatura_central_observaciones')"
                   {{$chaomin->temperatura_central_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->temperatura_central_observaciones}}"
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
            <label for="label_generico">VELOCIDAD SECADORA PAS200 (53HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pass200_inicial" id="velocidad_pass200_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pass200_observaciones','velocidad_pass200_inicial')"
                   {{$chaomin->velocidad_pass200_inicial==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pass200_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pass200_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pass200_observaciones" id="velocidad_pass200_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasc180_inicial','velocidad_pass200_observaciones')"
                   {{$chaomin->velocidad_pass200_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pass200_observaciones}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pasc180_inicial" id="velocidad_pasc180_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasc180_observaciones','velocidad_pasc180_inicial')"
                   {{$chaomin->velocidad_pasc180_inicial==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasc180_inicial}}"
                   class="form-control valor">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasc180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasc180_observaciones" id="velocidad_pasc180_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pask180_inicial','velocidad_pasc180_observaciones')"
                   {{$chaomin->velocidad_pasc180_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasc180_observaciones}}"
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
            <label for="label_generico">VELOCIDAD SECADORA PASK180 (60HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pask180_inicial" id="velocidad_pask180_inicial"
                   {{$chaomin->velocidad_pask180_inicial==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pask180_inicial}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pask180_observaciones','velocidad_pask180_inicial')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pask180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pask180_observaciones" id="velocidad_pask180_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasi180_inicial','velocidad_pask180_observaciones')"
                   {{$chaomin->velocidad_pask180_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pask180_observaciones}}"
                   class="form-control valor ">
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
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pasi180_inicial" id="velocidad_pasi180_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasi180_observaciones','velocidad_pasi180_inicial')"
                   {{$chaomin->velocidad_pasi180_inicial==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasi180_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasi180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasi180_observaciones" id="velocidad_pasi180_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasm160_inicial','velocidad_pasi180_observaciones')"
                   {{$chaomin->velocidad_pasi180_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasi180_observaciones}}"
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
            <label for="label_generico valor">VELOCIDAD SECADORA PASM160 (60HRZ)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number" step="any" name="velocidad_pasm160_inicial" id="velocidad_pasm160_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasm160_observaciones','velocidad_pasm160_inicial')"
                   {{$chaomin->velocidad_pasm160_inicial==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasm160_inicial}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasm160_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasm160_observaciones" id="velocidad_pasm160_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)
                       next(this,'extractor_activo_inicial','velocidad_pasm160_observaciones')"
                   {{$chaomin->velocidad_pasm160_observaciones==null?'':'disabled'}}
                   value="{{$chaomin->velocidad_pasm160_observaciones}}"
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
            <label for="label_generico">EXTRACTOR ACTIVO (SI)</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>

            <select class="form-control selectpicker valor"
                    id="extractor_activo_inicial"
                    name="extractor_activo_inicial"

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
                   {{$chaomin->ventilacion_observacion==null?'':'disabled'}}
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
                   {{$chaomin->verificacion_codificacion_lote==null?'':'disabled'}}
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
                       {{$chaomin->verificacion_codificacion_vence==null?'':'disabled'}}
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
                    onchange="document.getElementById('sellos_observaciones_2').focus()"
                    id="maquina_inicial_2" name="maquina_inicial_2">
                <option value="1" {{$chaomin->verificacion_codificacion_obs==0?'':'selected'}} >SI</option>
                <option value="0" {{$chaomin->verificacion_codificacion_obs==1?'':'selected'}} >NO</option>
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
                   value="{{$chaomin->observaciones_acciones}}"
                   class="form-control valor">

        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default"
                    onclick="guardar()"
                    type="button">
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

@section('scripts')
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            setDate: new Date()

        });

        function clearSelect(select) {

            $(select).find('option:not(:first)').remove();
            $(select).selectpicker('refresh');
        }

        function guardar() {
           // document.getElementById('no_orden_produccion').disabled = false;
            habilitar_formulario();
            $('form').submit();
        }

        function addToSelect(value, txt, select) {

            let option = `<option value='${value}'>${txt}</option>`;
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

        function buscar_siguiente() {
            Array.prototype.slice.call(document.getElementsByTagName('INPUT'))
                .filter(
                    e => (e.type === "text" || e.type === "number") & (e.disabled === false) & (e.id !== "") & (e.name !== "")
                )[0].focus();
        }

        function continuar_liberacion() {

            const total_faltante = Array.prototype.slice.call(document.getElementsByClassName('valor')).filter(e => e.value == "" && e.tagName != "DIV").length;
            if (total_faltante > 0) {
                buscar_siguiente();
                start_job("{{url('control/chaomin/nuevo_registro')}}", document.getElementById('id_chaomin').value);
            }
        }

        continuar_liberacion();
    </script>
    <script>

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            setDate: new Date()

        });
        $(document).ready(function () {

            $("#btnAdd").click(function () {
                addToTable();
            });


        });
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        function validar(input, inicial, final, result, observaciones, next) {

            console.log(input.value);
            if (input.value < inicial || input.value > final) {

                result.disabled = false;
                observaciones.disabled = false;
                result.focus();
            } else {
                result.value = "";
                observaciones.value = "";
                result.disabled = true;
                observaciones.disabled = true;
                next.focus();
            }

        }

        function ValidacionCombox(evaluador, seleccion, observacion, siguiente) {
            let Valor = $(evaluador).val();
            //let bodegas = $('#extractor_activo_final');
            if (Valor == "NO") {
                observacion.disabled = false;
                seleccion.disabled = false;
                $(seleccion).selectpicker('refresh');
                seleccion.focus();
            } else {
                observacion.value = "";
                observacion.disabled = true;
                seleccion.disabled = true;
                $(seleccion).selectpicker('refresh');
                siguiente.focus();
            }

        }


        function ValidacionCartucho(evaluador, valor1, valor2, valor3, dato_final, observacion, siguiente,) {

            //let bodegas = $('#extractor_activo_final');
            if (evaluador.value == valor1 || evaluador.value == valor2 || evaluador.value == valor3) {
                dato_final.value = "";
                observacion.value = "";
                dato_final.disabled = true;
                observacion.disabled = true;
                siguiente.focus();
            } else {
                dato_final.value = "";
                observacion.value = "";
                dato_final.disabled = false;
                observacion.disabled = false;
                dato_final.focus();
            }

        }


        function cambiar_combobox(id) {

            setTimeout(function () {
                document.getElementById(id).disabled = false;
                $('#' + id).selectpicker('refresh').selectpicker('toggle');
            }, 100);

        }

        function habilitar_formulario() {

            Array.prototype.slice.call
            (document.getElementsByClassName('form-control'))
                .map(function (e) {
                        e.disabled = false;
                        if (e.tagName === "SELECT") {
                            $(e).selectpicker('refresh');
                        }
                    }
                )

            ;
            Array.prototype.slice.call(document.getElementsByClassName('form-control')).map(e => e.readOnly = false);
        }

        async function iniciar_linea_chaomein(e) {


            let url = "{{url('control/chaomin/verficar_no_orden_produccion')}}";
            let no_orden_produccion = document.getElementById('no_orden_produccion').value;
            let response = await iniciar(url, no_orden_produccion);
            if (response.status == 0) {
                alert(response.message);
            } else {

                document.getElementById('no_orden_produccion').disabled = true;
                document.getElementById('id_presentacion').disabled = false;
                document.getElementById('id_turno').disabled = false;
                document.getElementById('producto').disabled = false;
                $('#id_turno').selectpicker('refresh');
                $('#id_presentacion').selectpicker('refresh');
                $('#producto').selectpicker('refresh');
                gl_productos = response.data;
                cargar_productos(response.data);

                // cambiar_combobox('id_producto');
                //document.getElementById('id_chaomin').value = response.id;
                {{-- // start_job("{{url('control/chaomin/nuevo_registro')}}", document.getElementById('id_chaomin').value);--}}
            }


        }

        function iniciar_liberacion() {

            const id_presentacion = document.getElementById('id_presentacion').value;
            const id_producto = document.getElementById('producto').value;
            const id_turno = document.getElementById('id_turno').value;
            const no_orden_produccion = document.getElementById('no_orden_produccion').value;
            if (id_presentacion === "") {
                alert("Seleccione presentacion");
                return;
            }
            if (id_producto === "") {
                alert("Seleccione Producto");
                return;
            }
            if (id_turno === "") {
                alert("Seleccione Turno");
                return;
            }
            if (no_orden_produccion === "") {
                alert("Especifique no orden de producccion");
                return;
            }

            $.ajax(
                {
                    type: "POST",
                    url: "{{url('control/chaomin/iniciar')}}",
                    data: {
                        id_presentacion: id_presentacion,
                        id_producto: id_producto,
                        no_orden_produccion: no_orden_produccion,
                        id_turno: id_turno
                    },
                    success: function (response) {

                        if (response.status == 1) {
                            habilitar_formulario();
                            document.getElementById('id_presentacion').disabled = true;
                            document.getElementById('producto').disabled = true;
                            document.getElementById('id_turno').disabled = true;
                            document.getElementById('no_orden_produccion').disabled = true;
                            document.getElementById('btn_buscar_orden').disabled = true;
                            $('#id_turno').selectpicker('refresh');
                            $('#id_presentacion').selectpicker('refresh');
                            $('#producto').selectpicker('refresh');
                            document.getElementById('id_chaomin').value = response.data.id_chaomin;
                            start_job("{{url('control/chaomin/nuevo_registro')}}", document.getElementById('id_chaomin').value);
                        } else {
                            alert(response.message);
                        }


                    },
                    error: function (error) {
                        console.log(error)
                    }
                }
            );

        }

        function focus_next(element) {

            if (element.tagName === "SELECT") {
                cambiar_combobox(element.id);
            } else {
                element.focus();
            }


        }

        async function next(actual, next, field) {


            let new_value = actual.value;
            let url = "{{url('control/chaomin/nuevo_registro')}}";

            let id_chaomin = document.getElementById('id_chaomin').value;
            const fields = array_registros(field, new_value);
            let response = await insertar_registros(url, fields, id_chaomin);
            if (response.status == 1) {
                let next_element = document.getElementById(next);
                actual.disabled = true;
                if (next_element.disabled == true) {
                    buscar_siguiente();
                } else {
                    focus_next(next_element);
                }

            } else {
                actual.focus();
                alert(response.message);
            }

        }


        function cargar_productos(productos) {

            const select = document.getElementById('producto');
            $(select).empty();
            let option = '<option value="" selected>SELECCIONE PRODUCTO</option>';

            const es_unico = productos.length === 1;

            if (es_unico) {
                option += `<option selected value="${productos[0].id_producto}" >${productos[0].descripcion}</option>`;
                cargar_presentaciones(productos[0].id_producto);
            } else {
                productos.forEach(function (e) {
                    option += `<option value="${e.id_producto}" >${e.descripcion}</option>`;
                })
            }
            $(select).append(option);
            $(select).selectpicker('refresh');

        }


        var gl_productos = [];

        function cargar_presentaciones(id) {

            if (id !== "") {
                const presentaciones = gl_productos.find(e => e.id_producto == id).presentaciones;
                const select = document.getElementById('id_presentacion');
                $(select).empty();
                let option = '<option value="" selected>SELECCIONE PRESENTACION</option>';
                const es_unico = presentaciones.length === 1;
                if (es_unico) {
                    option += `<option selected value="${presentaciones[0].id_presentacion}" >${presentaciones[0].descripcion}</option>`;
                } else {
                    presentaciones.forEach(function (e) {
                        option += `<option value="${e.id_presentacion}" >${e.descripcion}</option>`;
                    })
                }
                $(select).append(option);
                $(select).selectpicker('refresh');
            }


        }
    </script>
@endsection
