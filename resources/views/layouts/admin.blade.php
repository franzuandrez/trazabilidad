<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Cantonesa</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
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
            <a class="navbar-brand" href="{{url('/')}}" style="color: #fff">CANTONESA</a>
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
                                        Bodegas
                                    </a>
                                </li>
                            @endcan
                            @can('sectores')
                                <li>
                                    <a href="{{url('registro/sectores')}}">
                                        <i class="fa fa-square-o" aria-hidden="true"></i>
                                        Sectores
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
                            @endcan
                        </ul>
                    </li>
                </ul>
            @endcan

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Recepcion <b

                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url('recepcion/materia_prima')}}">
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                Materia prima
                            </a>
                        </li>
                        <li>
                            <a href="{{url('recepcion/transito')}}">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                Transito a materia prima
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Produccion<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('produccion/mezcladora')}}"><i class="fa fa-spinner"></i>Mezcladora</a></li>
                        <li><a href="{{url('produccion/laminado')}}"><i class="fa fa-tasks"></i>Laminado y Precocción de
                                Sopas</a></li>
                        <li><a href="{{url('produccion/frituras')}}"><i class="fa fa-fire"></i>Frituras de Sopas</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Control
                        Chaomin<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('control/chaomin')}}"><i class="fa fa-line-chart"></i>Línea para ChaoMin</a>
                        </li>
                        <li><a href="{{url('control/mezcla_harina')}}"><i class="fa fa-spoon"></i>Mezcla de Harina</a>
                        </li>
                        <li><a href="{{url('control/laminado')}}"><i class="fa fa-th"></i>Laminado</a></li>
                        <li><a href="{{url('control/peso_humedo')}}"><i class="fa fa-signal"></i>Peso Humedo</a></li>
                        <li><a href="{{url('control/peso_seco')}}"><i class="fa fa-bar-chart"></i>Peso Seco</a></li>
                        <li><a href="{{url('control/precocido')}}"><i class="fa fa-cutlery"></i>Pre-cocido de Pasta</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Control Sopas<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('sopas/mezclado_sopas')}}"><i class="fa fa-balance-scale"></i>Mezclado de
                                Sopas</a></li>
                        <li><a href="{{url('sopas/peso_pasta')}}"><i class="fa fa-industry"></i>Peso de la Pasta</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Usuarios<b
                            class="caret"></b></a>

                    <ul class="dropdown-menu">

                        <li><a href="{{url('users')}}"><i class="fa fa-cog"></i>Administrar</a></li>


                        <li><a href="{{url('roles')}}"><i class=" fa fa-wrench"></i>Roles</a></li>

                    </ul>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"
                       style="background-color: #01579B;  color: #fff;">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        {{Auth::user()->username}}<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-sign-out"></i>Cerrar
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
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@yield('scripts')
</body>
