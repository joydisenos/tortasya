<!DOCTYPE html>
<html lang="es">

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

    <link rel="icon" href="{{asset('images/logo-01.png')}}" type="image/png" />

    <link rel="stylesheet" href="{{ asset('css/toastr.css')}}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
                                    
                                    <li><a href="#" class="btn btn-outline-light top-btn" data-toggle="modal" data-target="#login-modal"><span class="ti-user"></span> Ingresar</a></li>
                                    @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bienvenido, {{ title_case(Auth::user()->nombre) }} <span class="icon-arrow-down"></span></a>

                                        <div class="dropdown-menu menu-pri" aria-labelledby="navbarDropdownMenuLink">
                                            @role('admin|dev')
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('admin.configuraciones') }}"><i class="fa fa-cog mr-3" aria-hidden="true"></i> Configuraciones</a>
                                            @else

                                            @role('negocio|dev')
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.productos') }}"><i class="fa fa-birthday-cake mr-3" aria-hidden="true"></i> Productos</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.ventas') }}"><i class="fa fa-money mr-3" aria-hidden="true"></i> Ventas</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil</a>
                                            @else
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.favoritos') }}"><i class="fa fa-heart mr-3" aria-hidden="true"></i> Favoritos</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.direcciones') }}"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Direcciones</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Perfil</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.pedidos') }}"><i class="fa fa-birthday-cake mr-3" aria-hidden="true"></i> Pedidos</a>
                                            @endrole
                                            
                                            @endrole

                                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out mr-3" aria-hidden="true"></i> Salir</a>

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

    @guest
    <!-- Modal -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
    
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="tab-btn nav-link active" data-target=".login" href="#">Iniciar Sesión</a>
                  </li>
                  <li class="nav-item">
                    <a class="tab-btn nav-link" data-target=".registro" href="#">Regístrate</a>
                  </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body mt-4 mb-4 login">

              <form method="POST" action="{{ route('login') }}">
                        @csrf

                <div class="container-fluid">
                <div class="form-group row justify-content-center">

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                    
                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        
                        <div class="row pl-4 pr-4 justify-content-center">
                            
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check">
                                 @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                    </div>
                            </div>

                        </div>
                        

                        <div class="form-group row mb-0 justify-content-center">
                                <div class="col-md-10 text-center">
                                    <button type="submit" class="btn btn-danger btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                </div>

                  
                    
                 
            </form>
              </div>

              <div class="modal-body modal-body mt-4 mb-4 ocultar registro">
                  <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme su contraseña" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-danger btn-block">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
              </div>


            </div>
          </div>
        </div>


         <div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
    
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="tab-btn nav-link active" data-target=".alta" href="#">Tengo negocio</a>
                  </li>
                  <li class="nav-item">
                    <a class="tab-btn nav-link" data-target=".sugerir" href="#">Sugerir negocio</a>
                  </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body mt-4 mb-4 alta">

              <form method="POST" action="{{ route('alta') }}">
                        @csrf

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <p>
                                    Tengo negocio o soy un emprendedor@: Activa tu negocio online de forma rapida. 
                                    <br>Por favor, bríndanos los siguientes datos
                                </p>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="nombre_negocio" type="text" class="form-control @error('nombre_negocio') is-invalid @enderror" name="nombre_negocio" value="{{ old('nombre_negocio') }}" placeholder="Nombre de su Negocio" required autocomplete="nombre_negocio" autofocus>

                                @error('nombre_negocio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme su contraseña" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-danger btn-block">
                                    Dar de alta
                                </button>
                            </div>
                        </div>
                    </form>
              </div>

              <div class="modal-body modal-body mt-4 mb-4 ocultar sugerir">
                   <form method="POST" action="{{ route('sugerir') }}">
                        @csrf

                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <p>
                                    ¿Quieres pedir a un negocio o emprededor@ que aun NO está en Tortas Ya?
                                    <br>
                                    Por favor, bríndanos los siguientes datos nos pondremos en contacto lo antes posible.
                                </p>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="nombre_negocio" type="text" class="form-control @error('nombre_negocio') is-invalid @enderror" name="nombre_negocio" value="{{ old('nombre_negocio') }}" placeholder="Nombre de su Negocio" required autocomplete="nombre_negocio" autofocus>

                                @error('nombre_negocio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-danger btn-block">
                                    Sugerir
                                </button>
                            </div>
                        </div>
                    </form>
              </div>
              </div>


            </div>
          </div>
        
    @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest




    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/toastr.js')}}"></script>
    @if (session('status'))
    <script>
        toastr.success( '{{ session("status") }}' );
    </script>
    @endif

    @if ($errors->any())
    
            @foreach ($errors->all() as $error)
                <script>
                    toastr.error( '{{ $error }}' );
                </script>
            @endforeach
        
    @endif
    
    <script>
        $(document).ready(function(){
            $('.tab-btn').click(function(e){

                e.preventDefault();

                button = $(this);
                parent = '#' + button.parents('.modal').attr('id');
                target = button.data('target');
               
                $(parent + ' .modal-body').hide();
                $(target).show();

                $(parent + ' .tab-btn').removeClass('active');
                button.addClass('active');

            });
        })
    </script>
</body>

</html>
