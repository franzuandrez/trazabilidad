@extends('layouts.admin')
@section('style')
    <style>
        .page-header {
            margin-top: 20px;
            margin-bottom: 02px;
            padding-bottom: 0;
        }
    </style>
@endsection
@section('contenido')
    @component('componentes.nav',['operation'=>'Ver',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-eye',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent
    <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="page-header">
            <h2>
                <small>&nbsp;&nbsp; INFORMACIÓN COMERCIAL .</small>
            </h2>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">RAZON SOCIAL</label>
                <input type="text" name="razon_social" readonly value="{{$proveedor->razon_social}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE COMERCIAL</label>
                <input type="text" name="nombre_comercial" readonly value="{{$proveedor->nombre_comercial}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NIT</label>
                <input type="text" name="nit" readonly value="{{$proveedor->nit}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION FISCAL</label>
                <input type="text" name="direccion_fiscal" readonly value="{{$proveedor->direccion_fiscal}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION PLANTA</label>
                <input type="text" name="direccion_planta" readonly value="{{$proveedor->direccion_planta}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE CONTACTO</label>
                <input type="text" name="nombre_contacto" readonly value="{{$proveedor->nombre_contacto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">TELEFONO DE CONTACTO</label>
                <input type="text" name="telefono_contacto" readonly value="{{$proveedor->telefono_contacto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">E-MAIL</label>
                <input type="text" name="email" readonly value="{{$proveedor->email}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">REGIMEN TRIBUTARIO</label>
                <input type="text" name="regimen_tributario" readonly value="{{$proveedor->regimen_tributario}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE COMERCIO</label>
                <input type="text" name="patente_comercio" readonly value="{{$proveedor->patente_comercio}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE SOCIEDAD</label>
                <input type="text" name="patente_sociedad" readonly value="{{$proveedor->patente_sociedad}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIAS DE CREDITO</label>
                <input type="text" name="dias_credito" readonly value="{{$proveedor->dias_credito}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">MONTO DE CREDITO</label>
                <input type="text" name="monto_credito" readonly value="{{$proveedor->monto_credito}}"
                       class="form-control">
            </div>
        </div>

    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="page-header">
            <h2>
                <small>&nbsp;&nbsp; INFORMACIÓN BÁSICA DE CALIDAD</small>
            </h2>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->programa_bpm_implementado == 1)
                    <input type="checkbox" class="custom-control-input" checked id="programa_bpm_implementado" value="1"
                           name="programa_bpm_implementado" onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" id="programa_bpm_implementado" value="1"
                           name="programa_bpm_implementado" onclick="return false;">
                @endif

                <label class="custom-control-label" for="programa_bpm_implementado">¿Cuenta con Programa de BPM
                    implementadas, documentadas y evaluadas?</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->otros_programas == 1)
                    <input type="checkbox" value="1" checked class="custom-control-input" id="otros_programas"
                           name="otros_programas" onclick="return false;">
                @else
                    <input type="checkbox" value="1" class="custom-control-input" id="otros_programas"
                           name="otros_programas" onclick="return false;">
                @endif

                <label class="custom-control-label" for="otros_programas">¿Cuenta con otros Programas
                    Prerrequisito implementados, documentados y evaluados?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->sistema_haccp == 1)
                    <input type="checkbox" value="1" checked class="custom-control-input" id="sistema_haccp"
                           name="sistema_haccp" onclick="return false;">
                @else
                    <input type="checkbox" value="1" class="custom-control-input" id="sistema_haccp"
                           name="sistema_haccp" onclick="return false;">
                @endif
                <label class="custom-control-label" for="sistema_haccp">¿Cuenta con Sistema HACCP Iplementado,
                    Documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->programa_capacitacion == 1)
                    <input type="checkbox" class="custom-control-input" checked id="programa_capacitacion" value="1"
                           name="programa_capacitacion" onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" id="programa_capacitacion" value="1"
                           name="programa_capacitacion" onclick="return false;">
                @endif

                <label class="custom-control-label" for="programa_capacitacion">¿Cuenta con un Programa de
                    Capacitación implementado documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->sistema_trazabilidad == 1 )
                    <input type="checkbox" class="custom-control-input" checked id="sistema_trazabilidad" value="1"
                           name="sistema_trazabilidad" onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" checked id="sistema_trazabilidad" value="1"
                           name="sistema_trazabilidad" onclick="return false;">
                @endif

                <label class="custom-control-label" for="sistema_trazabilidad">¿Cuenta con un Sistema de
                    Trazabilidad implementado, documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->sistema_calidad_auditado_intermamente == 1)
                    <input type="checkbox" class="custom-control-input"
                           checked
                           id="sistema_calidad_auditado_intermamente"
                           value="1"
                           name="sistema_calidad_auditado_intermamente"
                           onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_intermamente"
                           value="1"
                           name="sistema_calidad_auditado_intermamente"
                           onclick="return false;">
                @endif

                <label class="custom-control-label" for="sistema_calidad_auditado_intermamente">¿Su Sistema de
                    Calidad y/o sus componentes es auditado internamente?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->sistema_calidad_auditado_por_terceros == 1)
                    <input type="checkbox" class="custom-control-input" checked
                           id="sistema_calidad_auditado_por_terceros" value="1"
                           name="sistema_calidad_auditado_por_terceros"
                           onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_por_terceros"
                           value="1"
                           name="sistema_calidad_auditado_por_terceros"
                           onclick="return false;">
                @endif

                <label class="custom-control-label" for="sistema_calidad_auditado_por_terceros">¿Su Sistema de
                    Calidad y/o sus componentes es auditado por terceros?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->certificaciones == 1)
                    <input type="checkbox" class="custom-control-input" checked id="certificaciones" value="1"
                           name="certificaciones"
                           onclick="return false;">
                @else
                    <input type="checkbox" class="custom-control-input" id="certificaciones" value="1"
                           name="certificaciones"
                           onclick="return false;">
                @endif

                <label class="custom-control-label" for="certificaciones">Certificaciones.</label>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="page-header" id="datos-reclamante">
            <h2>
                <small>&nbsp;&nbsp; REFERENCIAS COMERCIALES.</small>
            </h2>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <table id="detalle_referencias"
                   class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>EMPRESA</th>
                <th>TELEFONO</th>
                <th>DIRECCION</th>
                <th>CONTACTO</th>
                </thead>
                <tbody>
                @if(!$proveedor->referencias_comerciales->isEmpty())
                    @foreach($proveedor->referencias_comerciales as $key=>$referencia)
                        <tr>

                            <td>
                                <input type="hidden" value=' {{$referencia->nombre_empresa}}' name=empresa[]>
                                {{$referencia->nombre_empresa}}
                            </td>
                            <td>
                                <input type="hidden" value=' {{$referencia->telefono}}' name=telefono[]>
                                {{$referencia->telefono}}
                            </td>
                            <td>
                                <input type="hidden" value=' {{$referencia->direccion}}' name=direccion[]>
                                {{$referencia->direccion}}
                            </td>
                            <td>
                                <input type="hidden" value=' {{$referencia->contacto}}' name=contacto[]>
                                {{$referencia->contacto}}
                            </td>
                        </tr>

                    @endforeach
                @endif

                </tbody>
            </table>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="observaciones">OBSERVACIONES</label>
                <input id="observaciones" type="text" name="observaciones" value="{{$proveedor->observaciones}}"
                       class="form-control">
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <a href="{{url('registro/proveedores')}}">
                <button class="btn btn-default" type="button">
                    <span class="fa fa-backward"></span>
                    REGRESAR
                </button>
            </a>
        </div>
    </div>

    {!!Form::close()!!}

    </div>
@endsection