<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Company</title>
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

        .btn-primary {
            background-color: #1f3c88;
            border-color: #4d5491;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #1f3c88;
            border-color: #4d5491;
        }

        .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
            background-color: #1f3c88;
            border-color: #1f3c88;
        }

        .pagination > li > a, .pagination > li > span {
            color: #1f3c88;
        }

        .form-control:focus {
            border-color: #1f3c88;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
        }

        .bg-light-blue, .label-primary, .modal-primary .modal-body {
            background-color: #1f3c88 !important;
        }

        .btn-success {
            color: #fff;
            background-color: #5893d4;
            border-color: #5893d4;
        }

        .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
            background-color: #5893d4 !important;
        }

        .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
            background-color: #5893d4 !important;
        }

        .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
            background-color: #f7b633 !important;
        }
        .btn-warning {
            color: #fff;
            background-color: #f7b633;
            border-color: #f7b633;
        }
    </style>
    @yield('style')

</head>
<body style="background-color: #f5f5f5;">
<div class="" style="background-color: #f7b633;">
    <div class="container-fluid">

        <div class="navbar-header ">
            <button type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target="#mynavbar-content">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}" style="color: #fff">Company</a>
        </div>

        <div class="collapse navbar-collapse" id="mynavbar-content">
            @can('registro')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #f7b633;  color: #fff;">Catalogos<b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('proveedores')
                                <li>
                                    <a href="{{url('registro/proveedores')}}">
                                        <i class="fa fa-truck"></i>
                                        Proveedores
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
                            @endcan
                            @can('productos')
                                <li>

                                    <a href="{{url('registro/productos')}}">
                                        <i class="fa fa-tags"></i>
                                        Productos
                                    </a>

                                </li>
                            @endcan
                            @can('clientes')
                                <li>

                                    <a href="{{url('registro/clientes')}}">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        Clientes
                                    </a>

                                </li>
                            @endcan
                            @can('actividades')
                                <li>

                                    <a href="{{url('registro/actividades')}}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        Actividades
                                    </a>

                                </li>
                            @endcan
                            <li role="separator" class="divider"></li>
                            @can('localidades')
                                <li>
                                    <a href="{{url('registro/localidades')}}">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                        Localidades
                                    </a>
                                </li>
                            @endcan
                            @can('bodegas')
                                <li>
                                    <a href="{{url('registro/bodegas')}}">
                                        <i class="fa fa-square" aria-hidden="true"></i>
                                        Bodega
                                    </a>
                                </li>
                            @endcan
                            @can('sectores')
                                <li>
                                    <a href="{{url('registro/sectores')}}">
                                        <i class="fa fa-square-o" aria-hidden="true"></i>
                                        Sector
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



                            @can('usuarios')
                                <li role="separator" class="divider"></li>
                                @can('administrar')
                                    <li><a href="{{url('users')}}"><i class="fa fa-user"></i>Usuarios</a></li>
                                @endcan
                                <li><a href="{{url('roles')}}"><i class=" fa  fa-key"></i>Roles</a></li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan
            @can('recepcion')
                <ul class="nav navbar-nav">
                    <li class="dropdown ">
                        <a href="#" data-toggle="dropdown" style="background-color: #f7b633;  color: #fff;">Ingreso <b

                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('materia_prima')
                                <li>
                                    <a href="{{url('recepcion/materia_prima')}}">
                                        <i class="fa fa-th-large" aria-hidden="true"></i>
                                        Materias primas
                                    </a>
                                </li>
                            @endcan
                            @can('control_calidad')
                                <li>
                                    <a href="{{url('recepcion/transito')}}">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        Control de Calidad
                                    </a>
                                </li>
                            @endcan
                            @can('ubicacion_producto')
                                <li>
                                    <a href="{{url('recepcion/ubicacion')}}">
                                        <i class=" fa fa-shopping-cart" aria-hidden="true"></i>
                                        Ubicacion
                                    </a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                </ul>
            @endcan

            @can('produccion')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #f7b633;  color: #fff;">
                            Produccion
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                            @can('requisiciones')
                                <li>
                                    <a href="{{url('produccion/requisiciones')}}">
                                        <i class=" fa fa-file-text" aria-hidden="true"></i>
                                        Requisiciones
                                    </a>
                                </li>
                            @endcan
                            @can('picking')
                                <li>
                                    <a href="{{url('produccion/picking')}}">
                                        <i class="fa fa-cart-plus"></i>
                                        Recolección
                                    </a>
                                </li>
                            @endcan

                            @can('control_trazabilidad')
                                <li>
                                    <a href="{{url('produccion/trazabilidad_chao_mein')}}">
                                        <i class="fa fa-exchange" aria-hidden="true"></i>
                                        Trazabilidad
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{url('produccion/devoluciones')}}">
                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                    Devoluciones
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('produccion')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #f7b633;  color: #fff;">
                            Producto Terminado
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('produccion/entrega_pt')}}">
                                    <i class="fa fa fa-archive" aria-hidden="true"></i>
                                    Entregas
                                </a>
                            </li>

                            <li>
                                <a href="{{url('produccion/recepcion_pt')}}">
                                    <i class="fa  fa-hdd-o" aria-hidden="true"></i>
                                    Recepciones
                                </a>
                            </li>

                            <li>
                                <a href="{{url('produccion/requisicion_pt')}}">
                                    <i class=" fa fa-file-text" aria-hidden="true"></i>
                                    Requisiciones
                                </a>
                            </li>
                            <li>
                                <a href="{{url('produccion/despacho')}}">
                                    <i class="fa fa-cart-plus"></i>
                                    Despachos
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            @endcan

            @can('reportes')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" style="background-color: #f7b633;  color: #fff;">Reportes
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @can('kardex')
                                <li>
                                    <a href="{{url('recepcion/kardex')}}">
                                        <i class="fa fa-th-list" aria-hidden="true"></i>
                                        Existencias
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('movimientos/kardex')}}">
                                        <i class="fa fa-exchange" aria-hidden="true"></i>
                                        Movimientos
                                    </a>
                                </li>
                            @endcan
                            @can('trazabilidad_hacia_atras')
                                <li>
                                    <a href="{{url('operaciones/consultas/trazabilidad')}}"><i class="fa fa-history"></i>
                                        Traz. Hacia Atras
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('operaciones/consultas/trazabilidad/hacia_adelante')}}"><i
                                            class="fa  fa-long-arrow-right"></i>
                                        Traz. Hacia Adelante
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown menu">
                    <a href="#" data-toggle="dropdown"
                       id="lnk_username"
                       style="background-color: #f7b633;  color: #fff;"
                       aria-expanded="true">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{Auth::user()->nombre}}<b class="caret"></b>
                        <a class="nav-link"
                           id="lnk_logout"
                           style="background-color: #f7b633;  color: #fff;display: none"
                           href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Salir</a>
                    </a>
                    <ul class="dropdown-menu" id="menu_username">
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Salir
                                </a>
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
