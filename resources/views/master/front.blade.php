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

    <link href="{{ asset('maps/leaflet.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .list-group-item{
            font-size: 12px;
        }
        .foot-menu{
            font-size: 12px;
        }
        .app{
            min-height: 200px;
        }
        .principal{
            overflow: hidden;
            width: 100%;
        }
        .color-primary{
            color: #C01829;
        }
        @media (max-width: 992px){
                .navbar-collapse{
                    background-color:rgba(0,0,0,0.6);
                    text-align: center;
                }
                .navbar-collapse li{
                    margin-bottom: 15px;
                }
            }
    </style>

    @yield('header')

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
                                <img src="{{ asset('images/logotipo-blanco.svg') }}" class="img-fluid"> <br>
                                <div class="text-right">
                                    <small class="text-white">By </small> <img src="{{ asset('images/logo-casa.png') }}" style="width: 100px" alt="logo Casa Costa Repostería">
                                </div>
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-menu"></span>
              </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    
                                    
                                    <li class="nav-item">
                                        <a class="btn btn-outline-light top-btn sugiere" href="#" data-toggle="modal" data-target="#registro-modal"><i class="fa fa-rocket mr-2"></i> Sugiere Negocios</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="mailto:contacto@tortaya.cl">Contacto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a>
                                    </li>
                                    @guest
                                    
                                    <li><a href="#" class="btn btn-outline-light top-btn" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user mr-2"></i> Ingresar</a></li>
                                    @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link btn btn-outline-light top-btn" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ title_case(Auth::user()->nombre) }} <span class="icon-arrow-down"></span></a>

                                        <div class="dropdown-menu menu-pri" aria-labelledby="navbarDropdownMenuLink">
                                            @role('admin|dev')
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('admin.usuarios') }}"><i class="fa fa-users mr-3" aria-hidden="true"></i> Usuarios</a>
                                            
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('admin.configuraciones') }}"><i class="fa fa-cog mr-3" aria-hidden="true"></i> Configuraciones</a>
                                            
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('admin.sugerencias') }}"><i class="fa fa-check mr-3" aria-hidden="true"></i> Sugerencias</a>
                                            @else

                                            @role('negocio|dev')
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.productos') }}"><i class="fa fa-birthday-cake mr-3" aria-hidden="true"></i> Mis Productos</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.ventas') }}"><i class="fa fa-money mr-3" aria-hidden="true"></i> Mis Ventas</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('negocio.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Mi Perfil</a>
                                            @else
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.favoritos') }}"><i class="fa fa-heart mr-3" aria-hidden="true"></i> Mis Favoritos</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.direcciones') }}"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Mis Direcciones</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.datos') }}"><i class="fa fa-info-circle mr-3" aria-hidden="true"></i> Mi Perfil</a>
                                            <a class="dropdown-item mb-2 text-white" href="{{ route('usuario.pedidos') }}"><i class="fa fa-birthday-cake mr-3" aria-hidden="true"></i> Mis Pedidos</a>
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
    <footer class="main-block background-primary">
        <div class="container">
            

            <div class="row">
                <div class="col-md-2">
                    <ul class="list-unstyled foot-menu">
                        <a href="{{ route('nosotros') }}">
                            <li class="text-white mb-2">
                                Nosotros
                            </li>
                        </a>

                        <a href="{{ route('nosotros.pagina' , 'beneficios-para-los-consumidores') }}">
                            <li class="text-white mb-2">
                                Beneficios para los Consumidores
                            </li>
                        </a>

                        <a href="{{ route('nosotros.pagina' , 'preguntas-frecuentes') }}">
                            <li class="text-white mb-2">
                                Preguntas Frecuentes
                            </li>
                        </a>
                    </ul>
                </div>

                <div class="col-md-2">
                    <ul class="list-unstyled foot-menu">

                        
                        <a href="#" data-toggle="modal" data-target="#registro-modal">
                            <li class="text-white mb-2">
                                Sugiere Negocios
                            </li>
                        </a>

                        <a href="{{ route('nosotros.pagina' , 'beneficios-para-las-empresas-emprendedores-y-pastelerias') }}">
                            <li class="text-white mb-2">
                                Beneficios para las empresas, emprendedores y Pastelerías
                            </li>
                        </a>

                        <a href="{{ route('nosotros.pagina' , 'terminos-y-condiciones') }}">
                            <li class="text-white mb-2">
                                Términos y Condiciones
                            </li>
                        </a>
                    </ul>
                </div>

                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>

                <div class="col-md-2">
                    <p class="text-white">Síguenos en:</p>
                    <ul class="list-unstyled list-inline">
                        <a href="https://www.instagram.com/tortasya.cl">
                            <li class="text-white mb-2 list-inline-item mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 512 512" width="20px" class=""><g><path d="m305 256c0 27.0625-21.9375 49-49 49s-49-21.9375-49-49 21.9375-49 49-49 49 21.9375 49 49zm0 0" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/><path d="m370.59375 169.304688c-2.355469-6.382813-6.113281-12.160157-10.996094-16.902344-4.742187-4.882813-10.515625-8.640625-16.902344-10.996094-5.179687-2.011719-12.960937-4.40625-27.292968-5.058594-15.503906-.707031-20.152344-.859375-59.402344-.859375-39.253906 0-43.902344.148438-59.402344.855469-14.332031.65625-22.117187 3.050781-27.292968 5.0625-6.386719 2.355469-12.164063 6.113281-16.902344 10.996094-4.882813 4.742187-8.640625 10.515625-11 16.902344-2.011719 5.179687-4.40625 12.964843-5.058594 27.296874-.707031 15.5-.859375 20.148438-.859375 59.402344 0 39.25.152344 43.898438.859375 59.402344.652344 14.332031 3.046875 22.113281 5.058594 27.292969 2.359375 6.386719 6.113281 12.160156 10.996094 16.902343 4.742187 4.882813 10.515624 8.640626 16.902343 10.996094 5.179688 2.015625 12.964844 4.410156 27.296875 5.0625 15.5.707032 20.144532.855469 59.398438.855469 39.257812 0 43.90625-.148437 59.402344-.855469 14.332031-.652344 22.117187-3.046875 27.296874-5.0625 12.820313-4.945312 22.953126-15.078125 27.898438-27.898437 2.011719-5.179688 4.40625-12.960938 5.0625-27.292969.707031-15.503906.855469-20.152344.855469-59.402344 0-39.253906-.148438-43.902344-.855469-59.402344-.652344-14.332031-3.046875-22.117187-5.0625-27.296874zm-114.59375 162.179687c-41.691406 0-75.488281-33.792969-75.488281-75.484375s33.796875-75.484375 75.488281-75.484375c41.6875 0 75.484375 33.792969 75.484375 75.484375s-33.796875 75.484375-75.484375 75.484375zm78.46875-136.3125c-9.742188 0-17.640625-7.898437-17.640625-17.640625s7.898437-17.640625 17.640625-17.640625 17.640625 7.898437 17.640625 17.640625c-.003906 9.742188-7.898437 17.640625-17.640625 17.640625zm0 0" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/><path d="m256 0c-141.363281 0-256 114.636719-256 256s114.636719 256 256 256 256-114.636719 256-256-114.636719-256-256-256zm146.113281 316.605469c-.710937 15.648437-3.199219 26.332031-6.832031 35.683593-7.636719 19.746094-23.246094 35.355469-42.992188 42.992188-9.347656 3.632812-20.035156 6.117188-35.679687 6.832031-15.675781.714844-20.683594.886719-60.605469.886719-39.925781 0-44.929687-.171875-60.609375-.886719-15.644531-.714843-26.332031-3.199219-35.679687-6.832031-9.8125-3.691406-18.695313-9.476562-26.039063-16.957031-7.476562-7.339844-13.261719-16.226563-16.953125-26.035157-3.632812-9.347656-6.121094-20.035156-6.832031-35.679687-.722656-15.679687-.890625-20.6875-.890625-60.609375s.167969-44.929688.886719-60.605469c.710937-15.648437 3.195312-26.332031 6.828125-35.683593 3.691406-9.808594 9.480468-18.695313 16.960937-26.035157 7.339844-7.480469 16.226563-13.265625 26.035157-16.957031 9.351562-3.632812 20.035156-6.117188 35.683593-6.832031 15.675781-.714844 20.683594-.886719 60.605469-.886719s44.929688.171875 60.605469.890625c15.648437.710937 26.332031 3.195313 35.683593 6.824219 9.808594 3.691406 18.695313 9.480468 26.039063 16.960937 7.476563 7.34375 13.265625 16.226563 16.953125 26.035157 3.636719 9.351562 6.121094 20.035156 6.835938 35.683593.714843 15.675781.882812 20.683594.882812 60.605469s-.167969 44.929688-.886719 60.605469zm0 0" data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/></g> </svg>
                            </li>
                        </a>
                        <a href="#">
                            <li class="text-white mb-2 list-inline-item mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 49.652 49.652" style="enable-background:new 0 0 49.652 49.652;" xml:space="preserve" class=""><g><g>
                                    <g>
                                        <path d="M24.826,0C11.137,0,0,11.137,0,24.826c0,13.688,11.137,24.826,24.826,24.826c13.688,0,24.826-11.138,24.826-24.826    C49.652,11.137,38.516,0,24.826,0z M31,25.7h-4.039c0,6.453,0,14.396,0,14.396h-5.985c0,0,0-7.866,0-14.396h-2.845v-5.088h2.845    v-3.291c0-2.357,1.12-6.04,6.04-6.04l4.435,0.017v4.939c0,0-2.695,0-3.219,0c-0.524,0-1.269,0.262-1.269,1.386v2.99h4.56L31,25.7z    " data-original="#000000" class="active-path" data-old_color="#ffffff" fill="#ffffff"/>
                                    </g>
                                </g></g> 
                                </svg>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>

            <hr style="border-color:rgba(255,255,255,0.4);">

            <div class="row">
                <div class="col-10">
                    <div class="copyright text-left">
                       <span class="text-white foot-menu">© {{ date('Y') }} TortasYa.com Todos los derechos Reservados.</span>
                    </div>
                </div>
                <div class="col-2">
                    <img src="{{ asset('images/logotipo-blanco.svg') }}" class="img-fluid">
                    
                </div>
            </div>
        </div>
    </footer>
    <!--//END FOOTER -->

     <div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document"> 
            <div class="modal-content">
              <div class="modal-header">
    
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a class="tab-btn nav-link registra-btn active" data-target=".alta" href="#">Tengo negocio</a>
                  </li>

                  <li class="nav-item">
                    <a class="tab-btn nav-link sugerir-btn" data-target=".sugerir" href="#">Sugerir negocio</a>
                  </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body mt-4 mb-4 alta">

              <form method="POST" action="{{ route('alta') }}">
                        @csrf
                        <input type="hidden" value="" id="lat_alta" name="latitud">
                        <input type="hidden" value="" id="long_alta" name="longitud">
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
                                <input id="direccion_alta" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <!--<input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>-->
                                <select name="ciudad" class="form-control select-ciudad" required>
                                            
                                    @foreach(App\Region::regiones() as $key => $region)
                                        <option value="{{ $key }}" data-regiones="{{ json_encode($region) }}" {{ $key == "Metropolitana de Santiago"? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                   
                                </select>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <!--<input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>-->
                                <select name="region" class="form-control select-region" required>
                                            @foreach( App\Region::regiones()['Metropolitana de Santiago'] as $region )
                                           <option value="{{ str_slug($region) }}">{{ $region }}</option>
                                           @endforeach
                                            
                                            
                                           
                                        </select>

                                @error('region')
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
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" value="{{ old('apellido') }}" placeholder="Apellido" required autocomplete="apellido" autofocus>

                                @error('apellido')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input type="text" class="form-control @error('nombre_negocio') is-invalid @enderror" name="nombre_negocio" value="{{ old('nombre_negocio') }}" placeholder="Nombre de su Negocio" required autocomplete="nombre_negocio" autofocus>

                                @error('nombre_negocio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Dirección de su Negocio" required autocomplete="direccion" autofocus>

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <!--<input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>-->
                                <select name="ciudad" class="form-control select-ciudad" required>
                                            
                                    @foreach(App\Region::regiones() as $key => $region)
                                        <option value="{{ $key }}" data-regiones="{{ json_encode($region) }}" {{ $key == "Metropolitana de Santiago"? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                   
                                </select>

                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                           

                            <div class="col-md-10">
                                <!--<input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ old('ciudad') }}" placeholder="Ciudad" required autocomplete="ciudad" autofocus>-->
                                <select name="region" class="form-control select-region" required>
                                            @foreach( App\Region::regiones()['Metropolitana de Santiago'] as $region )
                                           <option value="{{ str_slug($region) }}">{{ $region }}</option>
                                           @endforeach
                                    
                                           
                                        </select>

                                @error('region')
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
    <script src="{{ asset('maps/leaflet.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    @yield('scripts')
    
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

    <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
    <script>

        // AOS
        AOS.init();

      var placesAutocomplete = places({
        appId: 'plGXL4THWSWQ',
        apiKey: '50d89247afd701d5c502b3b060c7f82a',
        container: document.querySelector('#direccion')
      });

      placesAutocomplete.on('change', 
        //e => console.log(e.suggestion)
        function (e){
            lat = e.suggestion.latlng.lat;
            long = e.suggestion.latlng.lng;

            $('#lat').val(lat);
            $('#long').val(long);
        }
        );

      var placesAutocompleteAlta = places({
        appId: 'plGXL4THWSWQ',
        apiKey: '50d89247afd701d5c502b3b060c7f82a',
        container: document.querySelector('#direccion_alta')
      });

      placesAutocompleteAlta.on('change', 
        //e => console.log(e.suggestion)
        function (e){
            lat = e.suggestion.latlng.lat;
            long = e.suggestion.latlng.lng;

            $('#lat_alta').val(lat);
            $('#long_alta').val(long);
        }
        );
    </script>
    
    <script>
        $(document).ready(function(){
            $('.sugiere').click(function(){

                $('#registro-modal .alta').hide();
                $('#registro-modal .sugerir').show();

                $('#registro-modal .tab-btn').removeClass('active');
                $('.sugerir-btn').addClass('active');

            });

            $('.registra').click(function(){

                $('#registro-modal .sugerir').hide();
                $('#registro-modal .alta').show();

                $('#registro-modal .tab-btn').removeClass('active');
                $('.registra-btn').addClass('active');

            });

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


            @guest
            @else
            $('.select-ciudad').each(function(){

                select = $(this).parents('.modal-body').find('.select-region');

            if($(this).val() == 0)
            {
                select.prop('disabled' , true);
            }else{

                select.prop('disabled' , false);

                regiones = $(this).find('option:selected').data('regiones');
         
                select.empty();
                
                @if(isset($direccion) && json_decode($direccion->direccion) != null)
                actual = '{{ str_slug(json_decode($direccion->direccion)->comuna) }}';
                @else
                actual = '{{ Auth::user()->region }}';
                @endif

                regiones.forEach(function(region , index) {
                    
                    regionCompare = convertToSlug(region);

                    // console.log(regionCompare);
                    
                    if(regionCompare == actual)
                    {
                         select.append(new Option(region, region , true , true));  
                    }else{
                        select.append(new Option(region, region));
                    }
                });
            }
            
            
        });
            @endguest
            
            $('.select-ciudad').change(function(){

                select = $(this).parents('.modal-body').find('.select-region');

            if($(this).val() == 0)
            {
                select.prop('disabled' , true);
            }else{

                select.prop('disabled' , false);

                regiones = $(this).find('option:selected').data('regiones');
         
                select.empty();
                
                regiones.forEach(function(region , index) {
                    select.append(new Option(region, region));
                });
            }
            
            
        });


            function convertToSlug(str) {
                  str = str.replace(/^\s+|\s+$/g, ''); // trim
                  str = str.toLowerCase();

                  // remove accents, swap ñ for n, etc
                  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
                  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
                  for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                  }

                  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                  return str;
                }
        })
    </script>
</body>

</html>
