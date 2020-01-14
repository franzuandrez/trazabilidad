@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <style>
        .floatingmenu_label {
            width: 150px;
            text-align: right;
            padding-right: 10px;
            position: absolute;
            left: -160px;
            color: #454545;
            white-space: nowrap;
        }

        #btnExit.show {
            -webkit-transform: translateY(-125%);
            transform: translateY(-125%);
        }

        #btnUsers.show {
            -webkit-transform: translateY(-250%);
            transform: translateY(-250%);
        }

        #btnJobs.show {
            -webkit-transform: translateY(-375%);
            transform: translateY(-375%);
        }

        #btnReports.show {
            -webkit-transform: translateY(-500%);
            transform: translateY(-500%);
        }

        #btnFilters.show {
            -webkit-transform: translateY(-625%);
            transform: translateY(-625%);
        }

        #hamburger {
            z-index: 10;
            position: fixed;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            bottom: 10%;
            right: 5%;
            background-color: #01579b;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 2px 2px 10px rgba(10, 10, 10, 0.3);
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
        }

        #hamburger .icon-bar {
            display: block;
            background-color: #FFFFFF;
            width: 22px;
            height: 2px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        #hamburger .icon-bar+.icon-bar {
            margin-top: 4px;
        }

        .hamburger-nav {
            z-index: 9;
            position: fixed;
            bottom: 10.5%;
            right: 5.5%;
            width: 150px;
            height: 50px;
            background-color: #f9f9f9;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            visibilty: hidden;
            opacity: 0;
            box-shadow: 3px 3px 10px 0px rgba(0, 0, 0, 0.48);
            cursor: pointer;
            -webkit-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        #hamburger.show {
            box-shadow: 7px 7px 10px 0px rgba(0, 0, 0, 0.48);
        }

        #hamburger.show #wrapper {
            -webkit-transition: -webkit-transform 0.4s ease-in-out;
            transition: -webkit-transform 0.4s ease-in-out;
            transition: transform 0.4s ease-in-out;
            transition: transform 0.4s ease-in-out, -webkit-transform 0.4s ease-in-out;
            -webkit-transform: rotateZ(90deg);
            transform: rotateZ(90deg);
        }

        #hamburger.show #one {
            -webkit-transform: translateY(6px) rotateZ(45deg) scaleX(0.9);
            transform: translateY(6px) rotateZ(45deg) scaleX(0.9);
        }

        #hamburger.show #two {
            opacity: 0;
        }

        #hamburger.show #thr {
            -webkit-transform: translateY(-6px) rotateZ(-45deg) scaleX(0.9);
            transform: translateY(-6px) rotateZ(-45deg) scaleX(0.9);
        }

        .hamburger-nav.show {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endsection

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Chaomin
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'control/chaomin/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}



    <input type="hidden" id="id_chaomin">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="turno">NO ORDEN DE PRODUCCION</label>
            <input type="text" name="no_orden_produccion" value="{{old('no_orden_produccion')}}"
                   id="no_orden_produccion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)iniciar_linea_chaomein()"
                   class="form-control">

        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACION</label>
            <select name="id_presentacion" class="form-control selectpicker" disabled="" id="id_presentacion">
                <option value="">SELECCIONAR PRESENTACION</option>
                @foreach($presentaciones as $presentacion)
                    <option value="{{$presentacion->id_presentacion}}">{{$presentacion->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>






    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <select class="form-control selectpicker" data-live-search="true" id="id_turno" name="id_turno" disabled>
                <option value="" selected>SELECCIONE UN TURNO</option>
                <option value="TURNO 1">TURNO 1</option>
                <option value="TURNO 2">TURNO 2</option>
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
            <label for="DATO_INICIAL">VALOR</label>
            <input type="number"  step=".01" name="cant_solucion_carga" id="cant_solucion_carga"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'cantidad_solucion_observacion','cant_solucion_carga')" disabled
                   value="{{old('cant_solucion_carga')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="cantidad_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="cantidad_solucion_observacion" id="cantidad_solucion_observacion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion_inicial','cantidad_solucion_observacion')" disabled
                   value="{{old('cantidad_solucion_observacion')}}"
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
            <label for="ph_solucion">VALOR</label>
            <input type="number"  step=".01" name="ph_solucion_inicial" id="ph_solucion_inicial" disabled
                   value="{{old('ph_solucion_inicial')}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion_observacion','ph_solucion_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="ph_solucion_observacion" id="ph_solucion_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_seca_inicial','ph_solucion_observacion')"
                   value="{{old('ph_solucion_observacion')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="mezcla_seca_inicial" id="mezcla_seca_inicial"
                   value="{{old('mezcla_seca_inicial')}}" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_seca_observacion','mezcla_seca_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_seca_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_seca_observacion" id="mezcla_seca_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_alta_inicial','mezcla_seca_observacion')"
                   value="{{old('mezcla_seca_observacion')}}"
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
            <label for="label_generico">TIEMPO DE MEZCLA ALTA (300 S)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta">VALOR</label>
            <input type="number"  step=".01" name="mezcla_alta_inicial" id="mezcla_alta_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_alta_observacion','mezcla_alta_inicial')"
                   value="{{old('mezcla_alta_inicial')}}" disabled

                   class="form-control">
        </div>
    </div>



    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_alta_observacion" id="mezcla_alta_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_baja_inicial','mezcla_alta_observacion')"
                   value="{{old('mezcla_alta_observacion')}}"
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
            <label for="mezcla_baja">VALOR</label>
            <input type="number"  step=".01" name="mezcla_baja_inicial" id="mezcla_baja_inicial"
                   value="{{old('mezcla_baja_inicial')}}" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'mezcla_baja_observacion','mezcla_baja_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_baja_observacion" id="mezcla_baja_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_reposo_inicial','mezcla_baja_observacion')"
                   value="{{old('mezcla_baja_observacion')}}"
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
            <label for="label_generico">TEMPERATURA RECAMARA DE REPOSO (MÁS DE 36 °C)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="temperatura_reposo_inicial" id="temperatura_reposo_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_reposo_observacion','temperatura_reposo_inicial')"
                   value="{{old('temperatura_reposo_inicial')}}" disabled=""
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_reposo_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_reposo_observacion" id="temperatura_reposo_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ancho_cartucho_inicial','temperatura_reposo_observacion')"
                   value="{{old('temperatura_reposo_observacion')}}"
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
            <label for="label_generico">ANCHO DEL CARTUCHO (1.0 m, 1.5 m y 1.8 m)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="ancho_cartucho_inicial" id="ancho_cartucho_inicial"
                   value="{{old('ancho_cartucho_inicial')}}" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ancho_cartucho_observacion','ancho_cartucho_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ancho_cartucho_observacion">OBSERVACIONES</label>
            <input type="text" name="ancho_cartucho_observacion" id="ancho_cartucho_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_1_inicial','ancho_cartucho_observacion')"
                   value="{{old('ancho_cartucho_observacion')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="temperatura_precocedora_1_inicial" id="temperatura_precocedora_1_inicial"
                   value="{{old('temperatura_precocedora_1_inicial')}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_1_observacion','temperatura_precocedora_1_inicial')"
                    disabled
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_1_observacion" id="temperatura_precocedora_1_observacion"
                   disabled=""
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_1_inicial','temperatura_precocedora_1_observacion')"
                   value="{{old('temperatura_precocedora_1_observacion')}}"
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
            <label for="label_generico">PARAMETROS PRE-COCEDORA 1 TIEMPO (10 A 30 MIN)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="tiempo_precocedora_1_inicial" id="tiempo_precocedora_1_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_1_observacion','tiempo_precocedora_1_inicial')"
                   value="{{old('tiempo_precocedora_1_inicial')}}" disabled
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_1_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_1_observacion" id="tiempo_precocedora_1_observacion" disabled
                   value="{{old('tiempo_precocedora_1_observacion')}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_2_inicial','tiempo_precocedora_1_observacion')"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01"  name="temperatura_precocedora_2_inicial" id="temperatura_precocedora_2_inicial"

                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_precocedora_2_observacion','temperatura_precocedora_2_inicial')"
                   value="{{old('temperatura_precocedora_2_inicial')}}" disabled=""
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_2_observacion" id="temperatura_precocedora_2_observacion" disabled=""
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_2_inicial','temperatura_precocedora_2_observacion')"
                   value="{{old('temperatura_precocedora_2_observacion')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="tiempo_precocedora_2_inicial" id="tiempo_precocedora_2_inicial"
                   value="{{old('tiempo_precocedora_2_inicial')}}" disabled=""
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempo_precocedora_2_observacion','tiempo_precocedora_2_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precocedora_2_observacion" id="tiempo_precocedora_2_observacion" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_central_inicial','tiempo_precocedora_2_observacion')"
                   value="{{old('tiempo_precocedora_2_observacion')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="temperatura_central_inicial" id="temperatura_central_inicial"
                   value="{{old('temperatura_central_inicial')}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_central_observaciones','temperatura_central_inicial')"
                   disabled
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_central_observaciones">OBSERVACIONES</label>
            <input type="text" name="temperatura_central_observaciones" id="temperatura_central_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pass200_inicial','temperatura_central_observaciones')"
                   value="{{old('temperatura_central_observaciones')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="velocidad_pass200_inicial" id="velocidad_pass200_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pass200_observaciones','velocidad_pass200_inicial')"
                   value="{{old('velocidad_pass200_inicial')}}" disabled=""
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pass200_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pass200_observaciones" id="velocidad_pass200_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasc180_inicial','velocidad_pass200_observaciones')"
                   value="{{old('velocidad_pass200_observaciones')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="velocidad_pasc180_inicial" id="velocidad_pasc180_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasc180_observaciones','velocidad_pasc180_inicial')"
                   value="{{old('velocidad_pasc180_inicial')}}" disabled=""
                   class="form-control">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasc180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasc180_observaciones" id="velocidad_pasc180_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pask180_inicial','velocidad_pasc180_observaciones')"
                   value="{{old('velocidad_pasc180_observaciones')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="velocidad_pask180_inicial" id="velocidad_pask180_inicial"
                   value="{{old('velocidad_pask180_inicial')}}" disabled=""
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pask180_observaciones','velocidad_pask180_inicial')"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pask180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pask180_observaciones" id="velocidad_pask180_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasi180_inicial','velocidad_pask180_observaciones')"
                   value="{{old('velocidad_pask180_observaciones')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="velocidad_pasi180_inicial" id="velocidad_pasi180_inicial" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasi180_observaciones','velocidad_pasi180_inicial')"
                   value="{{old('velocidad_pasi180_inicial')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasi180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasi180_observaciones" id="velocidad_pasi180_observaciones" disabled
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasm160_inicial','velocidad_pasi180_observaciones')"
                   value="{{old('velocidad_pasi180_observaciones')}}"
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
            <label for="dato_inicial">VALOR</label>
            <input type="number"  step=".01" name="velocidad_pasm160_inicial" id="velocidad_pasm160_inicial"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'velocidad_pasm160_observaciones','velocidad_pasm160_inicial')"
                   value="{{old('velocidad_pasm160_inicial')}}" disabled=""
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasm160_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasm160_observaciones" id="velocidad_pasm160_observaciones" disabled=""
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'extractor_activo_inicial','velocidad_pasm160_observaciones')"
                   value="{{old('velocidad_pasm160_observaciones')}}"
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
            <label for="label_generico">EXTRACTOR ACTIVO</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <!--<select name="id_localidad" class="form-control selectpicker" id="localidades" >-->
            <select class="form-control selectpicker" data-live-search="true" id="extractor_activo_inicial"
                    name="extractor_activo_inicial"
                    onchange="ValidacionCombox(this,  document.getElementById('extractor_activo_final'), document.getElementById('extractor_activo_observacion') , document.getElementById('ventilacion_inicial') )">
                <option value="" selected>SELECCIONE UNA OPCION</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="extractor_activo_observacion" id="extractor_activo_observacion" disabled
                   value="{{old('extractor_activo_observacion')}}"
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
            <label for="dato_inicial">VALOR</label>
            <select class="form-control selectpicker" data-live-search="true" id="ventilacion_inicial"
                    name="ventilacion_inicial"
                    onchange="ValidacionCombox(this,  document.getElementById('ventilacion_final'), document.getElementById('ventilacion_observacion') , document.getElementById('verificacion_codificacion_lote') )">
                <option value="" selected>SELECCIONE UNA OPCION</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="ventilacion_observacion" id="ventilacion_observacion" disabled
                   value="{{old('ventilacion_observacion')}}"
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
            <label for="label_generico">VERIFICACION CODIFICADO</label>
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">LOTE: CODMMDDAATUR</label>
            <input type="text" name="verificacion_codificacion_lote" id="verificacion_codificacion_lote"
                   value="{{old('verificacion_codificacion_lote')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="dato_final">VENCE: DD/MM/AAAA</label>
            <input type="text" name="verificacion_codificacion_vence" id="verificacion_codificacion_vence" disabled
                   value="{{old('verificacion_codificacion_vence')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificacion_obs">OBSERVACIONES</label>
            <input type="text" name="verificacion_codificacion_obs" id="verificacion_codificacion_obs" disabled
                   value="{{old('verificacion_codificacion_obs')}}"
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
            <label for="label_generico">SELLOS CUALITATIVO</label>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_final">MAQUINA</label>
            <select class="form-control selectpicker" data-live-search="true" id="id_maquina" name="id_maquina">
                <option value="" selected>SELECCIONE UNA OPCION</option>
                <option value="1">MAQ # 1</option>
                <option value="2">MAQ # 2</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="dato_inicial">VALOR</label>
            <input type="text" name="maquina_inicial" id="maquina_inicial" value="{{old('maquina_inicial')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="sellos_observaciones" id="sellos_observaciones"
                   value="{{old('sellos_observaciones')}}"
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
            <input type="text" name="observaciones_acciones" value="{{old('observaciones_acciones')}}"

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

@section('scripts')
    <script src="{{asset('js-brc/tools/nuevo_registro.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function clearSelect(select) {

            $(select).find('option:not(:first)').remove();
            $(select).selectpicker('refresh');
        }

        function addToSelect(value, txt, select) {

            let option = `<option value='${value}'>${txt}</option>`;
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

    </script>
    <script>
        $('#hamburger').click(function() {
            $('#hamburger').toggleClass('show');
            $('.hamburger-nav').toggleClass('show');
        });
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


        function habilitar_formulario(){

            Array.prototype.slice.call(document.getElementsByClassName('form-control')).map(e=>e.disabled = false);
            Array.prototype.slice.call(document.getElementsByClassName('form-control')).map(e=>e.readOnly = false);
        }

        async function iniciar_linea_chaomein(e) {


            let url = "{{url('control/chaomin/iniciar')}}";
            let no_orden_produccion = document.getElementById('no_orden_produccion').value;
            let response = await iniciar(url, no_orden_produccion);
            if (response.status == 0) {
                alert(response.message);
            } else {
                habilitar_formulario();
                document.getElementById('no_orden_produccion').disabled  =true;
                document.getElementById('cant_solucion_carga').focus();
                document.getElementById('id_chaomin').value = response.id;
            }


        }

        async function next(actual, next, field,e) {


            let new_value = actual.value;
            let url = "{{url('control/chaomin/nuevo_registro')}}";

            let id_chaomin  =document.getElementById('id_chaomin').value;
            let response = await nuevo_registro(url, field, new_value, id_chaomin);

            if (response.status == 1) {
                let next_element = document.getElementById(next);
                actual.disabled = true;

                if(next_element.disabled==true){

                    Array.prototype.slice.call(document.getElementsByTagName('INPUT'))
                        .filter(
                            e=>(e.type=="text" || e.type=="number" ) & (e.disabled==false)  & (e.id!="")
                        )[0].focus();

                }else{
                    next_element.focus();
                }



            } else {
                actual.focus();
                alert(response.message);
            }

        }





    </script>
@endsection
