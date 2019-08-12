@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
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
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="presentacion">PRESENTACION</label>
            <select name="id_presentacion" class="form-control selectpicker" id="presentacion">
                <option value="">SELECCIONAR PRESENTACION</option>
                @foreach($presentaciones as $presentacion)
                    <option value="{{$presentacion->id_presentacion}}">{{$presentacion->descripcion}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label>Fecha</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input id="fecha" type="text" class="form-control pull-right" id="datepicker">
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="responsable_monitoreo">RESPONSABLE DEL MONITOREO</label>
            <select name="id_responsable" class="form-control selectpicker" id="responsable_monitoreo">
                <option value="">SELECCIONAR RESPONSABLE</option>
                @foreach($responsables as $responsable)
                    <option value="{{$responsable->id}}">{{$responsable->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="turno">TURNO</label>
            <input type="text" name="turno" value="{{old('turno')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="solucion_carga">CANTIDAD DE SOLUCIÓN POR CARGA (158.4 A 168.5 LBS)</label>
            <input type="text" name="solucion_carga" value="{{old('solucion_carga')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="cantidad_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="cantidad_solucion_observacion" value="{{old('cantidad_solucion_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion">PH DE SOLUCIÓN (11PPM)</label>
            <input type="text" name="ph_solucion" value="{{old('ph_solucion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion_observacion">OBSERVACIONES</label>
            <input type="text" name="ph_solucion_observacion" value="{{old('ph_solucion_observacion')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_seca">TIEMPO DE MEZCLA SECO (60 S)</label>
            <input type="text" name="mezcla_seca" value="{{old('mezcla_seca')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_seca_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_seca_observacion" value="{{old('mezcla_seca_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta">TIEMPO DE MEZCLA ALTA (300 S)</label>
            <input type="text" name="mezcla_alta" value="{{old('mezcla_alta')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_alta_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_alta_observacion" value="{{old('mezcla_alta_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja">TIEMPO DE MEZCLA BAJA (600 S)</label>
            <input type="text" name="mezcla_baja" value="{{old('mezcla_baja')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="mezcla_baja_observacion">OBSERVACIONES</label>
            <input type="text" name="mezcla_baja_observacion" value="{{old('mezcla_baja_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_reposo">TEMPERATURA RECAMARA DE REPOSO (MÁS DE 36 °C)</label>
            <input type="text" name="temperatura_reposo" value="{{old('temperatura_reposo')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_reposo_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_reposo_observacion" value="{{old('temperatura_reposo_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ancho_cartucho">ANCHO DEL CARTUCHO (1.0 m, 1.5 m y 1.8 m)</label>
            <input type="text" name="ancho_cartucho" value="{{old('ancho_cartucho')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="ancho_cartucho_observacion">OBSERVACIONES</label>
            <input type="text" name="ancho_cartucho_observacion" value="{{old('ancho_cartucho_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1">PARAMETROS PRE-COCEDORA 1 TEMPERATURA (98 A 105)</label>
            <input type="text" name="temperatura_precocedora_1" value="{{old('temperatura_precocedora_1')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_1_observacion"
                   value="{{old('temperatura_precocedora_1_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_1">PARAMETROS PRE-COCEDORA 1 TIEMPO (10 A 30 MIN)</label>
            <input type="text" name="tiempo_precedore_1" value="{{old('tiempo_precedore_1')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_1_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precedore_1_observacion" value="{{old('tiempo_precedore_1_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1">PARAMETROS PRE-COCEDORA 2 TEMPERATURA (100 A 105)</label>
            <input type="text" name="temperatura_precocedora_1" value="{{old('temperatura_precocedora_1')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">OBSERVACIONES</label>
            <input type="text" name="temperatura_precocedora_1_observacion"
                   value="{{old('temperatura_precocedora_1_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2">PARAMETROS PRE-COCEDORA 2 TIEMPO (10 A 30 MIN)</label>
            <input type="text" name="tiempo_precedore_2" value="{{old('tiempo_precedore_2')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2_observacion">OBSERVACIONES</label>
            <input type="text" name="tiempo_precedore_2_observacion" value="{{old('tiempo_precedore_2_observacion')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_central">TEMPERATURA CENTRAL DE SECADORA (DE 72 A 80 ºC)</label>
            <input type="text" name="temperatura_central" value="{{old('temperatura_central')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="temperatura_central_observaciones">OBSERVACIONES</label>
            <input type="text" name="temperatura_central_observaciones"
                   value="{{old('temperatura_central_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pass200">VELOCIDAD SECADORA PAS200 (53HRZ)</label>
            <input type="text" name="velocidad_pass200" value="{{old('velocidad_pass200')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pass200_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pass200_observaciones" value="{{old('velocidad_pass200_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasc180">VELOCIDAD SECADORA PASC180 (58HRZ)</label>
            <input type="text" name="velocidad_pasc180" value="{{old('velocidad_pasc180')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasc180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasc180_observaciones" value="{{old('velocidad_pasc180_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pask180">VELOCIDAD SECADORA PASK180 (60HRZ)</label>
            <input type="text" name="velocidad_pask180" value="{{old('velocidad_pask180')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pask180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pask180_observaciones" value="{{old('velocidad_pask180_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasi180">VELOCIDAD SECADORA PASI180 (60HRZ)</label>
            <input type="text" name="velocidad_pasi180" value="{{old('velocidad_pasi180')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasi180_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasi180_observaciones" value="{{old('velocidad_pasi180_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasm160">VELOCIDAD SECADORA PASM160 (60HRZ)</label>
            <input type="text" name="velocidad_pasm160" value="{{old('velocidad_pasm160')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="velocidad_pasm160_observaciones">OBSERVACIONES</label>
            <input type="text" name="velocidad_pasm160_observaciones" value="{{old('velocidad_pasm160_observaciones')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo">EXTRACTOR ACTIVO</label>
            <input type="text" name="extractor_activo" value="{{old('extractor_activo')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="extractor_activo_observaciones">OBSERVACIONES</label>
            <input type="text" name="extractor_activo_observaciones" value="{{old('extractor_activo_observaciones')}}"
                   class="form-control">
        </div>
    </div>

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

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificado">VERIFICACION CODIFICADO LOTE: CODMMDDAATUR VENCE: DD/MM/AAAA</label>
            <input type="text" name="verificacion_codificado" value="{{old('verificacion_codificado')}}"
                   class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificado_observaciones">OBSERVACIONES</label>
            <input type="text" name="verificacion_codificado_observaciones"
                   value="{{old('verificacion_codificado_observaciones')}}"
                   class="form-control">
        </div>
    </div>

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

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="observaciones">OBSERVACIONES/ACCIONES CORRECTIVAS</label>
            <input type="text" name="observaciones" value="{{old('observaciones')}}"
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
    <script>
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
    </script>
@endsection
