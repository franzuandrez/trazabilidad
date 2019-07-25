@extends('layouts.admin')
@section('contenido')
    @component('componentes.nav',['operation'=>'crear',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-plus',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent

        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <form class="form" role="form">
                    <div class="page-header" id="datos-reclamante">
                        <h2>
                            <small>INFORMACIÓN COMERCIAL  </small>
                        </h2>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Razón Social</label>
                            <input type="text" name="razon_social" value="{{old('razon_social')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Nombre Comercial</label>
                            <input type="text" name="nombre_comercial" value="{{old('nombre_comercial')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">NIT</label>
                            <input type="text" name="nit" value="{{old('nit')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Dirección Fiscal</label>
                            <input type="text" name="direccion_fiscal" value="{{old('direccion_fiscal')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Dirección Planta</label>
                            <input type="text" name="direccion_planta" value="{{old('direccion_planta')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Nombre y puesto de contacto</label>
                            <input type="text" name="nombre_contacto" value="{{old('nombre_contacto')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Teléfono de Contacto</label>
                            <input type="text" name="telefono_contacto" value="{{old('telefono_contacto')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">E-mail</label>
                            <input type="text" name="email" value="{{old('email')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Régimen Tributario</label>
                            <input type="text" name="regimen_tributario" value="{{old('regimen_tributario')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Patente de Comercio</label>
                            <input type="text" name="patente_comercio" value="{{old('patente_comercio')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Patente de Sociedad</label>
                            <input type="text" name="patente_sociedad" value="{{old('patente_sociedad')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Días de Crédito</label>
                            <input type="text" name="dias_credito" value="{{old('dias_credito')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Monto de Crédito</label>
                            <input type="text" name="monto_credito" value="{{old('monto_credito')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Horario de Entregas</label>
                            <input type="text" name="horario_entrega" value="{{old('horario_entrega')}}"
                                   class="form-control">
                        </div>
                    </div>

                    <div class="page-header" id="datos-reclamante">
                        <h2>
                            <small> INFORMACIÓN BÁSICA DE CALIDAD.</small>
                        </h2>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="programa_bpm_implementado" name="programa_bpm_implementado">
                            <label class="custom-control-label" for="programa_bpm_implementado" >¿Cuenta con Programa de BPM implementadas, documentadas y evaluadas?</label>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="otros_programas" name="otros_programas">
                            <label class="custom-control-label" for="otros_programas" >¿Cuenta con otros Programas Prerrequisito implementados, documentados y evaluados?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sistema_haccp" name="sistema_haccp">
                            <label class="custom-control-label" for="sistema_haccp">¿Cuenta con Sistema HACCP Iplementado, Documentado y evaluado?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="programa_capacitacion" name="programa_capacitacion">
                            <label class="custom-control-label" for="programa_capacitacion" >¿Cuenta con un Programa de Capacitación implementado documentado y evaluado?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sistema_trazabilidad" name="sistema_trazabilidad">
                            <label class="custom-control-label" for="sistema_trazabilidad">¿Cuenta con un Sistema de Trazabilidad implementado, documentado y evaluado?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_intermamente" name="sistema_calidad_auditado_intermamente">
                            <label class="custom-control-label" for="sistema_calidad_auditado_intermamente">¿Su Sistema de Calidad y/o sus componentes es auditado internamente?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_por_terceros" name="sistema_calidad_auditado_por_terceros">
                            <label class="custom-control-label" for="sistema_calidad_auditado_por_terceros">¿Su Sistema de Calidad y/o sus componentes es auditado por terceros?</label>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="certificaciones" name="certificaciones">
                            <label class="custom-control-label" for="certificaciones">Certificaciones.</label>
                        </div>
                    </div>



                    <div class="page-header" id="datos-reclamante">
                        <h2>
                            <small> REFERENCIAS COMERCIALES.</small>
                        </h2>
                    </div>

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Empresa</label>
                            <input id="empresa"  type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input id="telefono"  type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">Dirección</label>
                            <input id="direccion" type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10">
                        <div class="form-group">
                            <label for="nombre">Contacto</label>
                            <input id="contacto" type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1 col-md-1 col-xs-2">
                        <br>
                        <div class="form-group">
                            <button id="btnAdd1" class="btn btn-default block" style="margin-top: 5px;" type="button"><span class=" fa fa-plus"></span> </button>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

                        <table id="detalles1" class="table table-striped table-bordered table-condensed table-hover">

                            <thead style="background-color: #01579B;  color: #fff;">
                            <th>OPCION</th>
                            <th>EMPRESA</th>
                            <th>TELEFONO</th>
                            <th>DIRECCION</th>
                            <th>CONTACTO</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="nombre">OBSERVACIONES</label>
                            <input id="contacto" type="text" name="descripcion" value="{{old('descripcion')}}"
                                   class="form-control">
                        </div>
                    </div>





                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-default" type="submit">
                                <span class=" fa fa-check"></span> GUARDAR
                            </button>
                            <a href="{{url('registro/proveedores')}}">
                                <button class="btn btn-default" type="button">
                                    <span class="fa fa-remove"></span>
                                    CANCELAR
                                </button>
                            </a>

                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span></button>
                        <h4 class="modal-title">Advertencia</h4>
                    </div>
                    <div class="modal-body">
                        <p>Complete todo los campos...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

@endsection