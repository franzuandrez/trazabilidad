@extends('layouts.admin')

@section('contenido')

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-square-o',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Sectores
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
            <label for="fecha">FECHA</label>
            <input type="text" name="fecha" value="{{old('fecha')}}"
                   class="form-control">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="responsable_monitoreo">RESPONSABLE DEL MONITOREO</label>
            <input type="text" name="responsable_monitoreo" value="{{old('responsable_monitoreo')}}"
                   class="form-control">
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

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span class=" fa fa-check"></span> GUARDAR
            </button>
            <a href="{{url('registro/sectores')}}">
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
@endsection
