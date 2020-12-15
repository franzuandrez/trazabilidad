<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Marketin</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        .popover {
            max-width: none;
        }
    </style>
    @yield('style')

</head>
<body style="background-color: #f5f5f5;">
<div class="navbar navbar-default" style="background-color: #01579B; border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target="#mynavbar-content">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}" style="color: #fff">MARKETIN</a>
        </div>
        <div class="collapse navbar-collapse" id="mynavbar-content">
            @can('registro')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Registro<b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('proveedores')
                                <li>
                                    <a href="{{url('registro/proveedores')}}">
                                        <i class="fa fa-users"></i>
                                        Proveedores
                                    </a>
                                </li>
                            @endcan
                            @can('presentaciones')
                                <li>
                                    <a href="{{url('registro/presentaciones')}}">
                                        <i class="fa fa-th-large"></i>
                                        Presentaciones
                                    </a>

                                </li>
                            @endcan
                            @can('dimensionales')
                                <li>

                                    <a href="{{url('registro/dimensionales')}}">
                                        <i class="fa fa-cubes"></i>
                                        Dimensionales
                                    </a>

                                </li>
                            @endcan
                            @can('productos')
                                <li>

                                    <a href="{{url('registro/productos')}}">
                                        <i class="fa fa-tags"></i>
                                        Productos
                                    </a>

                                </li>
                            @endcan
                            @can('actividades')
                                <li>

                                    <a href="{{url('registro/actividades')}}">
                                        <i class="fa fa-hand-lizard-o" aria-hidden="true"></i>
                                        Actividades
                                    </a>

                                </li>
                            @endcan
                            @can('categoria_clientes')
                                <li>

                                    <a href="{{url('registro/categoria_clientes')}}">
                                        <i class="fa fa-list-ol"></i>
                                        Categoria de Clientes
                                    </a>

                                </li>
                            @endcan
                            @can('clientes')
                                <li>

                                    <a href="{{url('registro/clientes')}}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Clientes
                                    </a>

                                </li>
                            @endcan
                            @can('localidades')
                                <li>

                                    <a href="{{url('registro/localidades')}}">
                                        <i class="fa fa-building" aria-hidden="true"></i>
                                        Localidades
                                    </a>

                                </li>
                            @endcan
                            @can('bodegas')
                                <li>
                                    <a href="{{url('registro/bodegas')}}">
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        Area
                                    </a>
                                </li>
                            @endcan
                            @can('sectores')
                                <li>
                                    <a href="{{url('registro/sectores')}}">
                                        <i class="fa fa-square-o" aria-hidden="true"></i>
                                        Bodega
                                    </a>
                                </li>
                            @endcan
                            @can('pasillos')
                                <li>
                                    <a href="{{url('registro/pasillos')}}">
                                        <i class="fa fa-pause" aria-hidden="true"></i>
                                        Pasillos
                                    </a>
                                </li>
                            @endcan
                            @can('racks')
                                <li>
                                    <a href="{{url('registro/racks')}}">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                        Racks
                                    </a>
                                </li>
                            @endcan
                            @can('niveles')
                                <li>
                                    <a href="{{url('registro/niveles')}}">
                                        <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
                                        Niveles
                                    </a>
                                </li>
                            @endcan
                            @can('posiciones')
                                <li>
                                    <a href="{{url('registro/posiciones')}}">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        Posiciones
                                    </a>
                                </li>
                            @endcan
                            @can('bines')
                                <li>
                                    <a href="{{url('registro/bines')}}">
                                        <i class="fa fa-inbox" aria-hidden="true"></i>
                                        Bines
                                    </a>
                                </li>
                            @endcan
                            @can('ubicaciones')
                                <li>
                                    <a href="{{url('registro/ubicaciones')}}">
                                        <i class="fa fa  fa-map-marker" aria-hidden="true"></i>
                                        Ubicaciones
                                    </a>
                                </li>
                            @endcan
                            @can('tipo_movimiento')
                                <li>
                                    <a href="{{url('registro/tipo_movimientos')}}">
                                        <i class="fa fa-arrows-h" aria-hidden="true"></i>
                                        Tipo Movimiento
                                    </a>
                                </li>
                            @endcan
                            @can('colaboradores')
                                <li>
                                    <a href="{{url('registro/colaboradores')}}">
                                        <i class="fa fa-male" aria-hidden="true"></i>
                                        Colaboradores
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('registro/impresoras')}}">
                                        <i class="fa fa fa-print" aria-hidden="true"></i>
                                        Impresoras
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('recepcion')
                <ul class="nav navbar-nav">
                    <li class="dropdown ">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Recepcion <b

                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('materia_prima')
                                <li>
                                    <a href="{{url('recepcion/materia_prima')}}">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i>
                                        Materia prima
                                    </a>
                                </li>
                            @endcan
                            @can('control_calidad')
                                <li>
                                    <a href="{{url('recepcion/transito')}}">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        Control Calidad
                                    </a>
                                </li>
                            @endcan
                            @can('ubicacion_producto')
                                <li>
                                    <a href="{{url('recepcion/ubicacion')}}">
                                        <i class="fa fa-building-o" aria-hidden="true"></i>
                                        Asignar Ubicacion
                                    </a>
                                </li>
                            @endcan
                            @can('kardex')
                                <li>
                                    <a href="{{url('recepcion/kardex')}}">
                                        <i class="fa fa-th-list" aria-hidden="true"></i>
                                        Existencias
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('movimientos/kardex')}}">
                                        <i class="fa fa-th-list" aria-hidden="true"></i>
                                        Kardex
                                    </a>
                                </li>

                            @endcan
                            <li>
                                <a href="{{url('reimpresion')}}">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Reimpresión
                                </a>
                            </li>
                            <li>
                                <a href="{{url('movimientos_inventario')}}">
                                    <i class="fa fa-arrows" aria-hidden="true"></i>
                                    Movimientos Inventario
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('produccion')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">
                            Produccion
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                            @can('requisiciones')
                                <li>
                                    <a href="{{url('produccion/requisiciones')}}">
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        Requisiciones
                                    </a>
                                </li>
                            @endcan
                            @can('picking')
                                <li>
                                    <a href="{{url('produccion/picking')}}">
                                        <i class="fa fa-hand-rock-o"></i>
                                        Picking
                                    </a>
                                </li>
                            @endcan

                            @can('control_trazabilidad')
                                <li>
                                    <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                                        Control Trazabilidad
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{url('produccion/devoluciones')}}">
                                    <i class="fa fa-backward" aria-hidden="true"></i>
                                    Devolucion
                                </a>
                            </li>
                            <li>
                                <a href="{{url('produccion/entrega_pt')}}">
                                    <i class="fa fa-step-forward" aria-hidden="true"></i>
                                    Entrega PT
                                </a>
                            </li>

                            <li>
                                <a href="{{url('produccion/recepcion_pt')}}">
                                    <i class="fa fa-backward" aria-hidden="true"></i>
                                    Recepcion PT
                                </a>
                            </li>

                            <li>
                                <a href="{{url('produccion/requisicion_pt')}}">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                    Requisicion PT
                                </a>
                            </li>

                            <li>
                                <a href="{{url('produccion/despacho')}}">
                                    <i class="fa fa-hand-rock-o"></i>
                                    Despacho
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('control_chaomein')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">
                            Control Chao mein
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            @can('liberacion_chaomein')
                                <li>
                                    <a href="{{url('control/chaomin')}}">
                                        <i class="fa fa fa-line-chart"></i>
                                        Liberacion
                                        Linea
                                        chao
                                        mein
                                    </a>
                                </li>
                            @endcan
                            @can('verficacion_materia_mezcladora')
                                <li>
                                    <a href="{{url('control/verificacion_materias')}}">
                                        <i class="fa fa-check-circle"></i>
                                        Verificacion
                                        materias
                                        primas
                                        en
                                        mezcladora
                                    </a>
                                </li>
                            @endcan
                            @can('mezcla_harina_chaomein')
                                <li>
                                    <a href="{{url('control/mezcla_harina')}}">
                                        <i class="fa fa-spoon"></i>
                                        Mezcla
                                        de
                                        Harina
                                    </a>
                                </li>
                            @endcan
                            @can('laminado_chaomein')
                                <li>
                                    <a href="{{url('control/laminado')}}">
                                        <i class="fa fa-th"></i>
                                        Laminado
                                    </a>
                                </li>
                            @endcan
                            @can('peso_humedo_chaomein')
                                <li>
                                    <a href="{{url('control/peso_humedo')}}">
                                        <i class="fa fa-signal"></i>
                                        Peso Humedo
                                    </a>
                                </li>
                            @endcan
                            @can('peso_humedo_chaomein')
                                <li>
                                    <a href="{{url('control/secado')}}">
                                        <i class="fa fa-signal"></i>
                                        Secado
                                    </a>
                                </li>
                            @endcan
                            @can('peso_seco_chaomein')
                                <li>
                                    <a href="{{url('control/peso_seco')}}">
                                        <i class="fa fa-bar-chart"></i>
                                        Peso Seco
                                    </a>
                                </li>
                            @endcan
                            @can('precocido_pasta')
                                <li>
                                    <a href="{{url('control/precocido')}}">
                                        <i class="fa fa-cutlery"></i>
                                        Pre-cocido
                                        de
                                        Pasta
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('control_sopas')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">
                            Control
                            Sopas
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            @can('liberacion_sopas')
                                <li>
                                    <a href="{{url('sopas/liberacion')}}">
                                        <i class="fa fa-flag-o"></i>
                                        Liberacion
                                        Linea
                                        Sopas
                                        Instantaneas
                                    </a>
                                </li>
                            @endcan
                            @can('verificacion_materia_sopas')
                                <li>
                                    <a href="{{url('control/verificacion_materias_chao')}}">
                                        <i class="fa fa-check"></i>
                                        Verificacion Materias en mezcladora de sopas
                                    </a>
                                </li>
                            @endcan
                            @can('verificacion_materia_sopas')
                                <li>
                                    <a href="{{url('sopas/solucion')}}">
                                        <i class="fa fa-check"></i>
                                        Verificacion Materias para solucion
                                    </a>
                                </li>
                            @endcan
                            @can('mezclado_sopas')
                                <li>
                                    <a href="{{url('sopas/mezclado_sopas')}}">
                                        <i class="fa fa-spinner"></i>
                                        Mezclado
                                        de
                                        Sopas
                                    </a>
                                </li>
                            @endcan
                            @can('laminado_sopas')
                                <li>
                                    <a href="{{url('sopas/laminado')}}">
                                        <i class="fa  fa-th-large"></i>
                                        Laminado
                                        y
                                        Precoccion
                                    </a>
                                </li>
                            @endcan
                            @can('fritura_ropas')
                                <li>
                                    <a href="{{url('sopas/fritura')}}">
                                        <i class="fa  fa fa fa-fire  "></i>
                                        Fritura
                                    </a>
                                </li>
                            @endcan
                            @can('peso_pasta')
                                <li>
                                    <a href="{{url('sopas/peso_pasta')}}">
                                        <i class="fa fa fa-industry"></i>
                                        Peso
                                        de
                                        la
                                        Pasta
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('condimentos')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Control
                            Condimentos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('bases_condimentos')
                                <li>
                                    <a href="{{url('bases_condimentos')}}"><i class="fa fa-map"></i>
                                        Base para condimentos
                                    </a>
                                </li>
                            @endcan
                            @can('peso_condimentos')
                                <li>
                                    <a href="{{url('peso_condimentos')}}"><i class="fa fa-inbox"></i>
                                        Peso sobre condimentos
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('reportes')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Reportes
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('trazabilidad_hacia_atras')
                                <li>
                                    <a href="{{url('operaciones/consultas/trazabilidad')}}"><i class="fa fa-map"></i>
                                        Trazabilidad Hacia Atras
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('operaciones/consultas/trazabilidad/hacia_adelante')}}"><i
                                            class="fa fa-map"></i>
                                        Trazabilidad Hacia Adelante
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('configuraciones')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                           style="background-color: #01579B;  color: #fff;">Configuraciones<b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('configuracion_impresion')
                                <li><a href="{{url('configuraciones/impresion')}}"><i
                                            class=" fa fa-wrench"></i>Impresion</a>
                                </li>
                            @endcan
                        </ul>
                </ul>
            @endcan

            @can('usuarios')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Usuarios<b
                                class="caret"></b></a>

                        <ul class="dropdown-menu">
                            @can('administrar')
                                <li><a href="{{url('users')}}"><i class="fa fa-cog"></i>Administrar</a></li>
                            @endcan

                            <li><a href="{{url('roles')}}"><i class=" fa fa-wrench"></i>Roles</a></li>

                        </ul>
                </ul>
            @endcan

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown menu">
                    <a href="#" data-toggle="dropdown"
                       id="lnk_username"
                       style="background-color: #01579B;  color: #fff;"
                       aria-expanded="true">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{Auth::user()->username}}<b class="caret"></b>
                        <a class="nav-link"
                           id="lnk_logout"
                           style="background-color: #01579B;  color: #fff;display: none"
                           href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Cerrar
                            Sesión</a>
                    </a>
                    <ul class="dropdown-menu" id="menu_username">
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Cerrar
                                Sesión</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('unautorized'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{ $message }}</p>
                </div>
            @endif
            @yield('contenido')
        </div>
    </div>
</div>

<footer>
    <center>
        <strong> &copy; 2019 <a>GRUPO BARCODE, S.A.</a></strong> TODOS LOS DERECHOS RESERVADOS.
    </center>
</footer>


<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>
<script>

    var height = 0;
    var width = 0;
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $(function () {
            $('[data-toggle="popover"]').popover()
        });
        height = window.screen.availHeight;
        width = window.screen.availWidth;
        if (height < 740 || width < 400) {
            document.getElementById('lnk_username').style.display = "none";
            document.getElementById('lnk_logout').style.display = "block";
        }


    });
    $(window).resize(function () {
        height = window.screen.availHeight;
        width = window.screen.availWidth;

        if (height < 740 || width < 380) {
            document.getElementById('lnk_username').style.display = "none";
            document.getElementById('lnk_logout').style.display = "block";
        } else {
            document.getElementById('lnk_username').style.display = "block";
            document.getElementById('lnk_logout').style.display = "none";
        }

    });
    $('form').on('keydown', 'input', function (event) {
        if (event.which == 13) {
            event.preventDefault();
            var $this = $(event.target);
            var index = parseFloat($this.attr('data-index'));
            $('[data-index="' + (index + 1).toString() + '"]').focus();
        }
    });
</script>
@yield('scripts')
</body>
