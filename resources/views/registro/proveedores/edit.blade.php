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
    @component('componentes.nav',['operation'=>'Editar',
    'menu_icon'=>'fa-file-text',
    'submenu_icon'=>'fa fa-users',
    'operation_icon'=>'fa-pencil',])
        @slot('menu')
            Registro
        @endslot
        @slot('submenu')
            Proveedores
        @endslot
    @endcomponent


    {!!Form::model($proveedor,['method'=>'PATCH','route'=>['proveedores.update',$proveedor->id_proveedor]])!!}
    {{Form::token()}}
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

        <div class="page-header">
            <h2>
                <small>&nbsp;&nbsp; INFORMACIÓN COMERCIAL .</small>
            </h2>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">RAZON SOCIAL</label>
                <input type="text" name="razon_social" value="{{$proveedor->razon_social}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE COMERCIAL</label>
                <input type="text" name="nombre_comercial" value="{{$proveedor->nombre_comercial}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NIT</label>
                <input type="text" name="nit" value="{{$proveedor->nit}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION FISCAL</label>
                <input type="text" name="direccion_fiscal" value="{{$proveedor->direccion_fiscal}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION PLANTA</label>
                <input type="text" name="direccion_planta" value="{{$proveedor->direccion_planta}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">NOMBRE CONTACTO</label>
                <input type="text" name="nombre_contacto" value="{{$proveedor->nombre_contacto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">TELEFONO DE CONTACTO</label>
                <input type="text" name="telefono_contacto" value="{{$proveedor->telefono_contacto}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">E-MAIL</label>
                <input type="text" name="email" value="{{$proveedor->email}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">REGIMEN TRIBUTARIO</label>
                <input type="text" name="regimen_tributario" value="{{$proveedor->regimen_tributario}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE COMERCIO</label>
                <input type="text" name="patente_comercio" value="{{$proveedor->patente_comercio}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">PATENTE DE SOCIEDAD</label>
                <input type="text" name="patente_sociedad" value="{{$proveedor->patente_sociedad}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIAS DE CREDITO</label>
                <input type="text" name="dias_credito" value="{{$proveedor->dias_credito}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">MONTO DE CREDITO</label>
                <input type="text" name="monto_credito" value="{{$proveedor->monto_credito}}"
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
                           name="programa_bpm_implementado">
                @else
                    <input type="checkbox" class="custom-control-input" id="programa_bpm_implementado" value="1"
                           name="programa_bpm_implementado">
                @endif

                <label class="custom-control-label" for="programa_bpm_implementado">¿Cuenta con Programa de BPM
                    implementadas, documentadas y evaluadas?</label>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->otros_programas == 1)
                    <input type="checkbox" value="1" checked class="custom-control-input" id="otros_programas"
                           name="otros_programas">
                @else
                    <input type="checkbox" value="1" class="custom-control-input" id="otros_programas"
                           name="otros_programas">
                @endif

                <label class="custom-control-label" for="otros_programas">¿Cuenta con otros Programas
                    Prerrequisito implementados, documentados y evaluados?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->sistema_haccp == 1)
                    <input type="checkbox" value="1" checked class="custom-control-input" id="sistema_haccp"
                           name="sistema_haccp">
                @else
                    <input type="checkbox" value="1" class="custom-control-input" id="sistema_haccp"
                           name="sistema_haccp">
                @endif
                <label class="custom-control-label" for="sistema_haccp">¿Cuenta con Sistema HACCP Iplementado,
                    Documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->programa_capacitacion == 1)
                    <input type="checkbox" class="custom-control-input" checked id="programa_capacitacion" value="1"
                           name="programa_capacitacion">
                @else
                    <input type="checkbox" class="custom-control-input" id="programa_capacitacion" value="1"
                           name="programa_capacitacion">
                @endif

                <label class="custom-control-label" for="programa_capacitacion">¿Cuenta con un Programa de
                    Capacitación implementado documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->sistema_trazabilidad == 1 )
                    <input type="checkbox" class="custom-control-input" checked id="sistema_trazabilidad" value="1"
                           name="sistema_trazabilidad">
                @else
                    <input type="checkbox" class="custom-control-input" checked id="sistema_trazabilidad" value="1"
                           name="sistema_trazabilidad">
                @endif

                <label class="custom-control-label" for="sistema_trazabilidad">¿Cuenta con un Sistema de
                    Trazabilidad implementado, documentado y evaluado?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">

                @if($proveedor->sistema_calidad_auditado_intermamente == 1)
                    <input type="checkbox" class="custom-control-input" checked
                           id="sistema_calidad_auditado_intermamente" value="1"
                           name="sistema_calidad_auditado_intermamente">
                @else
                    <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_intermamente"
                           value="1"
                           name="sistema_calidad_auditado_intermamente">
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
                           name="sistema_calidad_auditado_por_terceros">
                @else
                    <input type="checkbox" class="custom-control-input" id="sistema_calidad_auditado_por_terceros"
                           value="1"
                           name="sistema_calidad_auditado_por_terceros">
                @endif

                <label class="custom-control-label" for="sistema_calidad_auditado_por_terceros">¿Su Sistema de
                    Calidad y/o sus componentes es auditado por terceros?</label>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="custom-control custom-checkbox">
                @if($proveedor->certificaciones == 1)
                    <input type="checkbox" class="custom-control-input" checked id="certificaciones" value="1"
                           name="certificaciones">
                @else
                    <input type="checkbox" class="custom-control-input" id="certificaciones" value="1"
                           name="certificaciones">
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

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="rc_empresa">EMPRESA</label>
                <input id="rc_empresa" type="text" name="rc_empresa" value="{{old('rc_empresa')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="rc_telefono">TELEFONO</label>
                <input id="rc_telefono" type="text" name="rc_telefono" value="{{old('rc_telefono')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="nombre">DIRECCION</label>
                <input id="rc_direccion" type="text" name="rc_direccion" value="{{old('rc_direccion')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10">
            <div class="form-group">
                <label for="rc_contacto">CONTACTO</label>
                <input id="rc_contacto" type="text" name="rc_contacto" value="{{old('rc_contacto')}}"
                       class="form-control">
            </div>
        </div>
        <div class="col-lg-1 col-sm-1 col-md-1 col-xs-2">
            <br>
            <div class="form-group">
                <button id="btnAddReferencias" class="btn btn-default block" style="margin-top: 5px;"
                        type="button"><span class=" fa fa-plus"></span></button>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <table id="detalle_referencias"
                   class="table table-striped table-bordered table-condensed table-hover">

                <thead style="background-color: #01579B;  color: #fff;">
                <th>OPCION</th>
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
                                <button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button>
                            </td>
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
    {!!Form::close()!!}
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
@section('scripts')
    <script>
        $("#btnAddReferencias").click(function () {
            addToTableComerciales();
        });

        function addToTableComerciales() {
            if ($("#rc_empresa").val() != "" && $("#rc_telefono").val() != "" && $("#rc_direccion").val() != "" && $("#rc_contacto").val() != "") {
                let empresa = $("#rc_empresa");
                let telefono = $("#rc_telefono");
                let direccion = $("#rc_direccion");
                let contacto = $("#rc_contacto");

                let row =
                    `<tr>
            <td><button onclick=removeFromTable(this) type="button" class="btn btn-warning">x</button></td>
            <td><input type="hidden" value='${empresa.val()}' name=empresa[]>${empresa.val()}</td>
            <td><input type="hidden" value='${telefono.val()}' name=telefono[]>${telefono.val()}</td>
            <td ><input type="hidden" value ='${direccion.val()}'  name=direccion[] >${direccion.val()}</td>
            <td ><input type="hidden" value ='${contacto.val()}'  name=contacto[] >${contacto.val()}</td>
            </tr>`;

                $("#detalle_referencias").append(row);
                empresa.val('');
                telefono.val('');
                direccion.val('');
                contacto.val('');
            } else {
                $('#modal-default').modal('show');
                return false;
            }
        }

        function removeFromTable(element) {

            let td = $(element).parent();
            td.parent().remove();

            let tdNext = td.next();
            let tdNextNext = tdNext.next();
            addToSelect(tdNext);
            addToTarea(tdNextNext);
        }

    </script>
@endsection
@endsection