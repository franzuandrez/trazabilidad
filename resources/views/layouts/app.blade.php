<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GRUPO BARCODE,S.A</title>

    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="ICON_GBC" href="{{asset('img/GBCicon_sidra.png')}}">
    <link rel="shortcut icon" href="{{asset('img/GBCicon_sidra.png')}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .btn-primary{
            background-color: #01579B;
        }
    </style>
</head>
<body id="app-layout" style=' background-color: #f5f5f5; margin:0px' >
<nav class="navbar navbar-default" style="background-color: #01579B; border-radius: 0px;" >
    <div class="container " >
        <div class="navbar-header ">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse ">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">



            <ul class="nav navbar-nav navbar-right">

                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" style="background-color: #01579B;  color: #fff;" href="{{ url('/login') }}">Iniciar Sesión</a></li>


                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle bg-primary" data-toggle="dropdown" role="button" aria-expanded="false" style="color:#fff">
                            {{ Auth::user()->username }} <span class="caret "></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('dashboard/')}}"><i class="fa fa-btn fa-sign-in"></i>Menu Principal</a></li>
                            <li><a href="{{url('/logout')}}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesion</a></li>
                        </ul>



                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
