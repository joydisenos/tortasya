@extends('master.front')
@section('header')
<style>
    .imagen-tienda{
        height: 200px;
        background-size: cover;
        background-position: center center;
    }
    .app{
        background: url('{{asset('images/ciudad.jpg')}}');
        background-size: cover;
        background-position: center center;
    }
    .img-cont{
        position:relative;
    }
    .img-cont #mobile-img{
        position: absolute;
        bottom:-90px;
        right: 100px;
        max-width: 220px;
        transform: rotate(20deg);
    }
</style>
@endsection
@section('content')
<!-- SLIDER -->
    <section class="slider d-flex align-items-center">
        <!-- <img src="{{ asset('images/slider.jpg')}}" class="img-fluid" alt="#"> -->
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="slider-title_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="slider-content_wrap">
                                    <h3 class="text-white"><strong>Postres y Tortas a domicilio o retiro en tienda</strong></h3>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10">
                                <form class="form-wrap mt-4" method="post" action="{{ route('buscar.negocios.ciudad') }}">
                                    @csrf
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <select name="ciudad" class="form-control" id="select-ciudad" required>
                                            
                                            <option value="0" >Seleccione una Región</option>
                                            @foreach($regiones as $key => $region)
                                            <option value="{{ $key }}" data-regiones="{{ json_encode($region) }}" {{ $key == "Metropolitana de Santiago"? 'selected' : '' }}>{{ $key }}</option>
                                            @endforeach
                                           
                                        </select>
                                        <!--<input type="text" placeholder="Distrito / Barrio" class="btn-group2">-->
                                        <select name="region" class="form-control" id="select-region" required>
                                           @foreach( $regiones['Metropolitana de Santiago'] as $region )
                                           <option value="{{ str_slug($region) }}">{{ $region }}</option>
                                           @endforeach
                                           
                                        </select>
                                        <button type="submit" class="btn btn-danger"><span class="icon-magnifier search-icon"></span>Buscar<i class="pe-7s-angle-right"></i></button>
                                    </div>
                                    <h6 class="text-white mt-3">Indicanos tu dirección</h6>
                                </form>
                                <div class="slider-link text-white text-left d-none d-md-block">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="{{ asset('images/cake.png') }}" class="img-fluid" alt="">
                                                </div>
                                                <div class="col">
                                                    <p style="font-size: 10px"><strong>1 Elige tu Torta,</strong></p>
                                                    <p style="font-size: 10px">postre o delicia favorita, muchas tiendas , emprededoras , locales con delivery online.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="{{ asset('images/debit-card.png') }}" class="img-fluid" alt="">
                                                </div>
                                                <div class="col">
                                                    <p style="font-size: 10px"><strong>2 Haz tu pedido</strong></p>
                                                    <p style="font-size: 10px">Es fácil y rápido.</p>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="col">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img src="{{ asset('images/gift.png') }}" class="img-fluid" alt="">
                                                </div>
                                                <div class="col">
                                                    <p style="font-size: 10px"><strong>3 Recibe tu pedido</strong></p>
                                                    <p style="font-size: 10px">Puedes contactar al negocio o emprededor y acordar la mejor manera de entregar el producto.</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--// SLIDER -->
    <!--//END HEADER -->
    <!--============================= FIND PLACES =============================-->
    
    <!--//END FIND PLACES -->
    <!--============================= FEATURED PLACES =============================-->
    <section class="main-block light-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="styled-heading">
                        <h3>Destacados</h3>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($tiendas as $tienda)
                <div class="col-md-3 mb-4 featured-responsive">
                    <div class="featured-place-wrap">
                        <a href="{{ route('tienda' , [$tienda->slug]) }}">
                            
                            <div class="imagen-tienda" style="background-image:url('{{ $tienda->negocio != null && $tienda->negocio->foto_local != null ? asset('storage/archivos/' . $tienda->id . '/' . $tienda->negocio->foto_local) : asset('images/cake.jpg')}}')"></div>
                            <span class="featured-rating-orange">{{ number_format($tienda->puntaje($tienda->id) , 1) }}</span>
                            <div class="featured-title-box">
                                <h6>{{ title_case($tienda->nombre_negocio) }}</h6>
                                <!--<p>Restaurant </p> <span>• </span>
                                <p> Comentarios</p> <span> • </span>-->
                                <!--<p><span>$$$</span>$$</p>-->
                                <ul>
                                    <li><span class="icon-location-pin"></span>
                                        <p>{{ $tienda->direccion }}</p>
                                    </li>
                                    <li><span class="icon-screen-smartphone"></span>
                                        <p>{{ $tienda->telefono }}</p>
                                    </li>

                                </ul>
                                <div class="bottom-icons">

                                    <div class="{{ $tienda->horarioDisponible() == 'Abierto'? 'open' : 'closed'}}-now">{{ $tienda->horarioDisponible() }}</div>
                                    @guest
                                    @else
                                        @if( Auth::user()->favoritos->where('negocio_id' , $tienda->id)->count() > 0 )

                                        <a href="{{ route('marcar.favorito' , $tienda->id) }}">
                                            <span class="fa fa-heart text-danger"></span>
                                        </a>
                                        @else
                                        <a href="{{ route('marcar.favorito' , $tienda->id) }}">
                                            <span class="ti-heart"></span>
                                        </a>
                                        @endif
                                    @endguest
                                   
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
               
            </div>
            
        </div>
    </section>
   @guest

   <section class="main-block">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="styled-heading">
                        <h3>Los mejores Negocios</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($logoRestaurant as $rest)
                <div class="col-2">
                    <a href="{{ route('tienda' , [$rest->slug]) }}">
                        <img src="{{ asset('storage/archivos/' . $rest->id . '/' . $rest->negocio->logo_local) }}" class="img-fluid" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            </div>
            
        </div>
    </section>
@endguest
    <section class="main-block light-bg">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="styled-heading">
                        <h3>Nuestra Comunidad</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($comentarios as $comentario)

                <div class="col-md-2 text-center">

                    <img src="{{ $comentario->user->foto_perfil == null ? asset('images/perfil.png') : asset('storage/archivos/' . $comentario->user->id . '/' . $comentario->user->foto_perfil) }}" alt="" class="img-fluid rounded-circle mb-2">
                    <p class="mb-2">"{{ $comentario->comentario }}"</p>
                    <div class="text-center mb-2">
                                    @if($comentario->puntos == 1)
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif($comentario->puntos == 2)
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif($comentario->puntos == 3)
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif($comentario->puntos == 4)
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    @elseif($comentario->puntos == 5)
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    <i class="fa fa-star text-warning"></i>
                                    @endif

                                </div>

                                <p>{{ title_case($comentario->user->nombre) }} {{ title_case($comentario->user->apellido) }}</p>

                            
                            
                </div>
                            
                        @endforeach
            </div>
            </div>
            
        </div>
    </section>

    <section class="main-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/pastelero.png') }}" alt="">
                </div>
                <div class="col-md-6">
                    <div class="add-listing-wrap">
                        <h2>¿Quieres publicar con nosotros?</h2>
                        <p>Nuestra plataforma le abrirá la puerta a tu negocio a exponerte a miles de clientes</p>
                        <div class="featured-btn-wrap">
                        <a href="#" class="btn btn-danger registra" data-toggle="modal" data-target="#registro-modal">¡Sugiérelo aquí!</a>
                    </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

    <section class="app align-items-center d-flex d-sm-none d-md-flex img-cont">
        <div class="container">
            <div class="row align-items-center d-flex">
                <div class="col-md-8">
                    <h4 class="text-white">Muy pronto TortasYa en tu celular</h4>
                    <img src="{{ asset('images/android-badge.png') }}" class="img-fluid mr-4" style="max-width: 150px;" alt="">
                    <img src="{{ asset('images/disponible-app-store.png') }}" class="img-fluid" style="max-width: 150px;" alt="">
                </div>
                
                    <div class="col-md-4"></div>
                    <img src="{{ asset('images/movil.png') }}" id="mobile-img" alt="">
            </div>
        </div>
    </section>
 
    
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#select-ciudad').change(function(){
            if($(this).val() == 0)
            {
                $('#select-region').prop('disabled' , true);
            }else{

                $('#select-region').prop('disabled' , false);

                regiones = $(this).find('option:selected').data('regiones');
         
                $("#select-region").empty();
                
                regiones.forEach(function(region , index) {
                    $("#select-region").append(new Option(region, region));
                });
            }
            
            
        });
    });
</script>
@endsection