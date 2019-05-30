<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Colorlib">
    <meta name="description" content="#">
    <meta name="keywords" content="#">
    <!-- Page Title -->
    <title>Tortas Ya!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
    <!-- Simple line Icon -->
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css')}}">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css')}}">
    <!-- Hover Effects -->
    <link rel="stylesheet" href="{{ asset('css/set1.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <!--============================= HEADER =============================-->
    <div class="nav-menu">
        <div class="bg transition">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!--<a class="navbar-brand" href="#">Tortas Ya!</a>-->
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/logotipo-blanco.svg') }}" class="img-fluid">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-menu"></span>
              </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    
                                    
                                    
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Contacto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Nosotros</a>
                                    </li>
                                    @guest
                                    <li><a href="{{ route('login') }}" class="btn btn-outline-light top-btn"><span class="ti-user"></span> Ingresar</a></li>
                                    @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bienvenido, {{ title_case(Auth::user()->nombre) }} <span class="icon-arrow-down"></span></a>

                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="{{ route('usuario.favoritos') }}">Favoritos</a>
                                            <a class="dropdown-item" href="{{ route('usuario.direcciones') }}">Direcciones</a>
                                            <a class="dropdown-item" href="{{ route('usuario.datos') }}">Datos</a>
                                            <a class="dropdown-item" href="{{ route('usuario.pedidos') }}">Pedidos</a>
                                        </div>
                                    </li>
                                    @endguest
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <!--============================= FOOTER =============================-->
    <footer class="main-block dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                       <span class="text-white">© {{ date('Y') }} TortasYa.com Todos los derechos Reservados.</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--//END FOOTER -->




    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>

</html>
