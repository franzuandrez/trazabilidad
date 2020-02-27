@extends('layouts.admin')

@section('style')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/tools.css')}}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">

@endsection

@section('contenido')
    <div class="col-lg-12 col-lg-push-3 col-sm-12     col-md-12    col-xs-12">
        <h3>LIBERACION DE LINEA DE SOPAS INSTANTANEAS</h3>
    </div>

    @component('componentes.nav',['operation'=>'Crear',
    'menu_icon'=>'fa fa-check-square-o',
    'submenu_icon'=>'a fa-line-chart',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Control
        @endslot
        @slot('submenu')
            Línea  Sopas Instantaneas
        @endslot
    @endcomponent


    {!!Form::open(array('url'=>'sopas/liberacion/create','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}


    <input type="hidden" id="id_sopa" name="id_sopa" value="{{$sopa->id_sopa}}">
    <input type="hidden" id="no_orden_produccion" name="no_orden_produccion" disabled value="{{$sopa->id_sopa}}">

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="producto">PRODUCTO</label>
            <input type="text"
                   readonly
                   id="producto"
                   value="{{$sopa->producto->descripcion}}"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="id_presentacion">PRESENTACION</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="id_presentacion"
                   value="{{$sopa->presentacion->descripcion}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <label for="turno">TURNO</label>
        <div class="form-group">
            <input type="text"
                   readonly
                   id="id_presentacion"
                   value="{{$sopa->id_turno}}"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <hr>
    </div>

    @include('componentes.loading')
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="solucion_carga"> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="solucion_carga">INDENTIFICACION DEL CARTUCHO (1.25mm)</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="DATO_INICIAL">VALOR</label>
            <input type="number" step="any" lang="en" name="identificacion_cartucho" id="identificacion_cartucho"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'identificacion_cartucho_observaciones','identificacion_cartucho')"
                   {{$sopa->identificacion_cartucho==null?'':'disabled'}}
                   value="{{$sopa->identificacion_cartucho}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="identificacion_cartucho_observaciones">OBSERVACIONES</label>
            <input type="text" name="identificacion_cartucho_observaciones" id="identificacion_cartucho_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'presion_vapor','identificacion_cartucho_observaciones')"
                   {{$sopa->identificacion_cartucho_observaciones==null?'':'disabled'}}
                   value="{{$sopa->identificacion_cartucho_observaciones}}"
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
            <label for="LABEL_TITULO">PRESION VAPOR (0.2-0.3 MPa)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="presion_vapor">VALOR</label>
            <input type="number" step="any" name="presion_vapor" id="presion_vapor"
                   {{$sopa->presion_vapor==null?'':'disabled'}}
                   value="{{$sopa->presion_vapor}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'presion_vapor_observaciones','presion_vapor')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="presion_vapor_observaciones">OBSERVACIONES</label>
            <input type="text" name="presion_vapor_observaciones" id="presion_vapor_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_del_aceite_set','presion_vapor_observaciones')"
                   {{$sopa->presion_vapor_observaciones==null?'':'disabled'}}
                   value="{{$sopa->presion_vapor_observaciones}}"
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
            <label for="label_generico">TEMPERATURA DEL ACEITE (+160 C)</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_del_aceite_set">VALOR</label>
            <input type="number" step="any" name="temperatura_del_aceite_set" id="temperatura_del_aceite_set"
                   {{$sopa->temperatura_del_aceite_set==null?'':'disabled'}}
                   value="{{$sopa->temperatura_del_aceite_set}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_del_aceite_set_observaciones','temperatura_del_aceite_set')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_del_aceite_set_observaciones">OBSERVACIONES</label>
            <input type="text" name="temperatura_del_aceite_set_observaciones"
                   id="temperatura_del_aceite_set_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion','temperatura_del_aceite_set_observaciones')"
                   {{$sopa->temperatura_del_aceite_set_observaciones==null?'':'disabled'}}
                   value="{{$sopa->temperatura_del_aceite_set_observaciones}}"
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
            <label for="label_generico">PH SOLUCION (10 - 11))</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion">VALOR</label>
            <input type="number" step="any" name="ph_solucion" id="ph_solucion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'ph_solucion_observaciones','ph_solucion')"
                   {{$sopa->ph_solucion==null?'':'disabled'}}
                   value="{{$sopa->ph_solucion}}"
                   class="form-control valor">
        </div>
    </div>



    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="ph_solucion_observaciones">OBSERVACIONES</label>
            <input type="text" name="ph_solucion_observaciones" id="ph_solucion_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'compuestos_polares_libres_frio','ph_solucion_observaciones')"
                   {{$sopa->ph_solucion_observaciones==null?'':'disabled'}}
                   value="{{$sopa->ph_solucion_observaciones}}"
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
            <label for="label_generico">FRIO</label>

        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="compuestos_polares_libres_frio">% COMPUESTOS SOLARES LIBRES (0 A 24)</label>
            <input type="number" step="any" name="compuestos_polares_libres_frio" id="compuestos_polares_libres_frio"
                   {{$sopa->compuestos_polares_libres_frio==null?'':'disabled'}}
                   value="{{$sopa->compuestos_polares_libres_frio}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'compuestos_polares_libres_antes','compuestos_polares_libres_frio')"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="indice_acidez_frio">INDICE DE ACIDEZ (0 A 2 )</label>
            <input type="number" step="any" name="indice_acidez_frio" id="indice_acidez_frio"
                   {{$sopa->indice_acidez_frio==null?'':'disabled'}}
                   value="{{$sopa->indice_acidez_frio}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'indice_acidez_antes','indice_acidez_frio')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura_aceite_frio">TEMPERATURA DE ACEITE</label>
            <input type="number" step="any" name="temperatura_aceite_frio" id="temperatura_aceite_frio"
                   {{$sopa->temperatura_aceite_frio==null?'':'disabled'}}
                   value="{{$sopa->temperatura_aceite_frio}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_aceite_antes','temperatura_aceite_frio')"
                   class="form-control valor">
        </div>
    </div>







    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico "> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">ANTES</label>

        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="compuestos_polares_libres_antes">COMPUESTOS SOLARES LIBRES (0 A 24)</label>
            <input type="number" step="any" name="compuestos_polares_libres_antes" id="compuestos_polares_libres_antes"
                   {{$sopa->compuestos_polares_libres_antes==null?'':'disabled'}}
                   value="{{$sopa->compuestos_polares_libres_antes}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'compuestos_polares_libres_durante','compuestos_polares_libres_antes')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="indice_acidez_antes">INDICE DE ACIDEZ (0 A 2 )</label>
            <input type="number" step="any" name="indice_acidez_antes" id="indice_acidez_antes"
                   {{$sopa->indice_acidez_antes==null?'':'disabled'}}
                   value="{{$sopa->indice_acidez_antes}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'indice_acidez_durante','indice_acidez_antes')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura_aceite_antes">
                TEMPERATURA DE ACEITE
            </label>
            <input type="number" step="any" name="temperatura_aceite_antes" id="temperatura_aceite_antes"
                   {{$sopa->temperatura_aceite_antes==null?'':'disabled'}}
                   value="{{$sopa->temperatura_aceite_antes}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_aceite_durante','temperatura_aceite_antes')"
                   class="form-control valor">
        </div>
    </div>



    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico "> </label>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">DURANTE</label>

        </div>
    </div>


    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="compuestos_polares_libres_durante">COMPUESTOS SOLARES LIBRES (0 A 24)</label>
            <input type="number" step="any" name="compuestos_polares_libres_durante" id="compuestos_polares_libres_durante"
                   {{$sopa->compuestos_polares_libres_durante==null?'':'disabled'}}
                   value="{{$sopa->compuestos_polares_libres_durante}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'compuestos_polares_libres_despues','compuestos_polares_libres_durante')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="indice_acidez_durante">INDICE DE ACIDEZ (0 A 2 )</label>
            <input type="number" step="any" name="indice_acidez_durante" id="indice_acidez_durante"
                   {{$sopa->indice_acidez_durante==null?'':'disabled'}}
                   value="{{$sopa->indice_acidez_durante}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'indice_acidez_despues','indice_acidez_durante')"
                   class="form-control valor">
        </div>
    </div>



    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura_aceite_durante">
                TEMPERATURA DE ACEITE
            </label>
            <input type="number" step="any" name="temperatura_aceite_durante" id="temperatura_aceite_durante"
                   {{$sopa->temperatura_aceite_durante==null?'':'disabled'}}
                   value="{{$sopa->temperatura_aceite_durante}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_aceite_despues','temperatura_aceite_durante')"
                   class="form-control valor">
        </div>
    </div>





    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">DESPUES</label>

        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="compuestos_polares_libres_despues">DESP</label>
            <input type="number" step="any" name="compuestos_polares_libres_despues" id="compuestos_polares_libres_despues"
                   {{$sopa->compuestos_polares_libres_despues==null?'':'disabled'}}
                   value="{{$sopa->compuestos_polares_libres_despues}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'compuestos_polares_libres_observaciones','compuestos_polares_libres_despues')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="indice_acidez_despues">DESP</label>
            <input type="number" step="any" name="indice_acidez_despues" id="indice_acidez_despues"
                   {{$sopa->indice_acidez_despues==null?'':'disabled'}}
                   value="{{$sopa->indice_acidez_despues}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'indice_acidez_observaciones','indice_acidez_despues')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="temperatura_aceite_despues">DESP</label>
            <input type="number" step="any" name="temperatura_aceite_despues" id="temperatura_aceite_despues"
                   {{$sopa->temperatura_aceite_despues==null?'':'disabled'}}
                   value="{{$sopa->temperatura_aceite_despues}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_aceite_obsevaciones','temperatura_aceite_despues')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="compuestos_polares_libres_observaciones">OBSERVACIONES/COMPUESTOS SOLARES LIBRES </label>
            <input type="number" step="any" name="compuestos_polares_libres_observaciones" id="compuestos_polares_libres_observaciones"
                   {{$sopa->compuestos_polares_libres_observaciones==null?'':'disabled'}}
                   value="{{$sopa->compuestos_polares_libres_observaciones}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'indice_acidez_frio','compuestos_polares_libres_observaciones')"
                   class="form-control valor">
        </div>
    </div>


    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="indice_acidez_observaciones">OBSERVACIONES /
                INDICE DE ACIDEZ (0 A 2 )
            </label>
            <input type="number" step="any" name="indice_acidez_observaciones" id="indice_acidez_observaciones"
                   {{$sopa->indice_acidez_observaciones==null?'':'disabled'}}
                   value="{{$sopa->indice_acidez_observaciones}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'temperatura_aceite_frio','indice_acidez_observaciones')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="temperatura_aceite_obsevaciones">OBSERVACIONES/ TEMPERATURA DE ACEITE </label>
            <input type="number" step="any" name="temperatura_aceite_obsevaciones" id="temperatura_aceite_obsevaciones"
                   {{$sopa->temperatura_aceite_obsevaciones==null?'':'disabled'}}
                   value="{{$sopa->temperatura_aceite_obsevaciones}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'porcentaje_solucion','temperatura_aceite_obsevaciones')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="label_generico">% DE SOLUCION 30%</label>

        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="porcentaje_solucion">VALOR</label>
            <input type="number" step="any" name="porcentaje_solucion" id="porcentaje_solucion"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'porcentaje_solucion_observaciones','porcentaje_solucion')"
                   {{$sopa->porcentaje_solucion==null?'':'disabled'}}
                   value="{{$sopa->porcentaje_solucion}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="porcentaje_solucion_observaciones">OBSERVACIONES</label>
            <input type="text" name="porcentaje_solucion_observaciones" id="porcentaje_solucion_observaciones"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'verificacion_codificado_lote','porcentaje_solucion_observaciones')"
                   {{$sopa->porcentaje_solucion_observaciones==null?'':'disabled'}}
                   value="{{$sopa->porcentaje_solucion_observaciones}}"
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
            <label for="label_generico ">
                VERIFICACION DE CODIFICADO
            </label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificado_lote">LOTE </label>
            <input type="number" step="any" name="verificacion_codificado_lote" id="verificacion_codificado_lote"
                   {{$sopa->verificacion_codificado_lote==null?'':'disabled'}}
                   value="{{$sopa->verificacion_codificado_lote}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'verificacion_codificado_vence','verificacion_codificado_lote')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_codificado_vence">VENCE</label>
            <input type="text" name="verificacion_codificado_vence" id="verificacion_codificado_vence"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_molde_superior','verificacion_codificado_vence')"
                   {{$sopa->verificacion_codificado_vence==null?'':'disabled'}}
                   value="{{$sopa->verificacion_codificado_vence}}"
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
            <label for="label_generico">MEDIDAS DEL MOLDE </label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="medidas_molde_superior">SUPERIOR</label>
            <input type="number" step="any" name="medidas_molde_superior"
                   id="medidas_molde_superior"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_molde_inferior','medidas_molde_superior')"
                   {{$sopa->medidas_molde_superior==null?'':'disabled'}}
                   value="{{$sopa->medidas_molde_superior}}"
                   class="form-control valor">
        </div>
    </div>


    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="medidas_molde_inferior">INFERIOR</label>
            <input type="text" name="medidas_molde_inferior" id="medidas_molde_inferior"
                   {{$sopa->medidas_molde_inferior==null?'':'disabled'}}
                   value="{{$sopa->medidas_molde_inferior}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_molde_altura','medidas_molde_inferior')"

                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="temperatura_precocedora_1_observacion">ALTURA</label>
            <input type="text" name="medidas_molde_altura" id="medidas_molde_altura"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_nido_superior','medidas_molde_altura')"
                   {{$sopa->medidas_molde_altura==null?'':'disabled'}}
                   value="{{$sopa->medidas_molde_altura}}"
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
            <label for="label_generico">MEDIDAS DEL NIDO</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="medidas_nido_superior">SUPERIOR</label>
            <input type="number" step="any" name="medidas_nido_superior" id="medidas_nido_superior"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_nido_inferior','medidas_nido_superior')"
                   {{$sopa->medidas_nido_superior==null?'':'disabled'}}
                   value="{{$sopa->medidas_nido_superior}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="medidas_nido_inferior">INFERIOR</label>
            <input type="text" name="medidas_nido_inferior" id="medidas_nido_inferior"
                   {{$sopa->medidas_nido_inferior==null?'':'disabled'}}
                   value="{{$sopa->medidas_nido_inferior}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'medidas_nido_altura','medidas_nido_inferior')"
                   class="form-control valor">
        </div>
    </div>
    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="medidas_nido_altura">ALTURA</label>
            <input type="text" name="medidas_nido_altura" id="medidas_nido_altura"
                   {{$sopa->medidas_nido_altura==null?'':'disabled'}}
                   value="{{$sopa->medidas_nido_altura}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempos_mezcla_seco','medidas_nido_altura')"
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
            <label for="label_generico">TIEMPOS DE MEZCLA</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempos_mezcla_seco">EN SECO</label>
            <input type="number" step="any" name="tiempos_mezcla_seco"
                   id="tiempos_mezcla_seco"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempos_mezcla_alta','tiempos_mezcla_seco')"
                   {{$sopa->tiempos_mezcla_seco==null?'':'disabled'}}
                   value="{{$sopa->tiempos_mezcla_seco}}"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempos_mezcla_alta">ALTA</label>
            <input type="text" name="tiempos_mezcla_alta" id="tiempos_mezcla_alta"
                   {{$sopa->tiempos_mezcla_alta==null?'':'disabled'}}
                   value="{{$sopa->tiempos_mezcla_alta}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'tiempos_mezcla_baja','tiempos_mezcla_alta')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempos_mezcla_baja">BAJA</label>
            <input type="text" name="tiempos_mezcla_baja" id="tiempos_mezcla_baja"
                   {{$sopa->tiempos_mezcla_baja==null?'':'disabled'}}
                   value="{{$sopa->tiempos_mezcla_baja}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'verificacion_material','tiempos_mezcla_baja')"
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
            <label for="label_generico">VEFIFICACION DE MATERIALES</label>

        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="verificacion_material">VALOR</label>
            <input type="number" step="any" name="verificacion_material" id="verificacion_material"
                   {{$sopa->verificacion_material==null?'':'disabled'}}
                   value="{{$sopa->verificacion_material}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'verificacion_material_observaciones','verificacion_material')"
                   class="form-control valor">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
            <label for="tiempo_precedore_2_observacion">OBSERVACIONES</label>
            <input type="text" name="verificacion_material_observaciones" id="verificacion_material_observaciones"
                   {{$sopa->verificacion_material_observaciones==null?'':'disabled'}}
                   value="{{$sopa->verificacion_material_observaciones}}"
                   onkeydown="if(event.keyCode==9||event.keyCode==13)next(this,'observaciones_acciones','verificacion_material_observaciones')"
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
                   value="{{$sopa->observaciones}}"
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

        function clearSelect(select) {

            $(select).find('option:not(:first)').remove();
            $(select).selectpicker('refresh');
        }

        function guardar() {
            document.getElementById('no_orden_produccion').disabled = false;
            habilitar_formulario();
            $('form').submit();
        }

        function addToSelect(value, txt, select) {

            let option = `<option value='${value}'>${txt}</option>`;
            $(select).append(option);
            $(select).selectpicker('refresh');
        }

    </script>
    <script>
        $('#hamburger').click(function () {
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

        async function iniciar_linea_sopas(e) {


            let url = "{{url('sopas/liberacion/verficar_no_orden_produccion')}}";
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

                cargar_productos(response.data);
                gl_productos = response.data;

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
                    url: "{{url('sopas/liberacion/iniciar')}}",
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
                            document.getElementById('id_sopa').value = response.data.id_sopa;
                            start_job("{{url('sopas/liberacion/nuevo_registro')}}", document.getElementById('id_sopa').value);
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
            let url = "{{url('sopas/liberacion/nuevo_registro')}}";

            let id_chaomin = document.getElementById('id_sopa').value;
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

        function buscar_siguiente() {
            Array.prototype.slice.call(document.getElementsByTagName('INPUT'))
                .filter(
                    e => (e.type == "text" || e.type == "number") & (e.disabled == false) & (e.id != "")
                )[0].focus();
        }


        function cargar_productos(productos) {

            const select = document.getElementById('producto');
            $(select).empty();
            let option = '<option value="" selected>SELECCIONE PRODUCTO</option>';

            const es_unico = productos.length === 1;

            if (es_unico) {
                option += `<option selected value="${productos[0].id_producto}" >${productos[0].descripcion}</option>`;
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
    </script>
@endsection
