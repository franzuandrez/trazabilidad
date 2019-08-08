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
            <a class="navbar-brand" href="{{url('/')}}" style="color: #fff">CANTONESA</a>
        </div>
        <div class="collapse navbar-collapse" id="mynavbar-content">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Registro<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>

                            <a href="{{url('registro/proveedores')}}">
                                <i class="fa fa-users"></i>
                                Proveedores
                            </a>

                        </li>

                        <li>

                            <a href="{{url('registro/presentaciones')}}">
                                <i class="fa fa-th-large"></i>
                                Presentaciones
                            </a>

                        </li>

                        <li>

                            <a href="{{url('registro/dimensionales')}}">
                                <i class="fa fa-cubes"></i>
                                Dimensionales
                            </a>

                        </li>

                        <li>

                            <a href="{{url('registro/productos')}}">
                                <i class="fa fa-tags"></i>
                                Productos
                            </a>

                        </li>

                        <li>

                            <a href="{{url('registro/actividades')}}">
                                <i class="fa fa-hand-lizard-o" aria-hidden="true"></i>
                                Actividades
                            </a>

                        </li>

                        <li>

                            <a href="{{url('registro/categoria_clientes')}}">
                                <i class="fa fa-list-ol"></i>
                                Categoria de Clientes
                            </a>

                        </li>
                        <li>

                            <a href="{{url('registro/clientes')}}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Clientes
                            </a>

                        </li>
                        <li>

                            <a href="{{url('registro/localidades')}}">
                                <i class="fa fa-building" aria-hidden="true"></i>
                                Localidades
                            </a>

                        </li>
                        <li>
                            <a href="{{url('registro/bodegas')}}">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                                Bodegas
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/sectores')}}">
                                <i class="fa fa-square-o" aria-hidden="true"></i>
                                Sectores
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/pasillos')}}">
                                <i class="fa fa-pause" aria-hidden="true"></i>
                                Pasillos
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/racks')}}">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                Racks
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/niveles')}}">
                                <i class="fa fa-sort-numeric-desc" aria-hidden="true"></i>
                                Niveles
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/posiciones')}}">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                Posiciones
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/bines')}}">
                                <i class="fa fa-inbox" aria-hidden="true"></i>
                                Bines
                            </a>
                        </li>
                        <li>
                            <a href="{{url('registro/tipo_movimientos')}}">
                                <i class="fa fa-arrows-h" aria-hidden="true"></i>
                                Tipo Movimiento
                            </a>
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
                        <li><a href="{{url('control/chaomin')}}"><i class="fa fa-line-chart"></i>Línea para ChaoMin</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" style="background-color: #01579B;  color: #fff;">Control Sopas<b
                            class="caret"></b></a>
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
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.es.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@yield('scripts')
</body>
